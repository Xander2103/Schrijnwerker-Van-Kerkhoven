<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiry;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact', [
            // Encrypted render-time signal used to reject unnaturally fast submissions.
            // Opaque and tamper-evident: a bot cannot forge an "older" timestamp without the app key.
            'formToken' => Crypt::encryptString((string) now()->timestamp),
        ]);
    }

    public function store(string $locale, Request $request): RedirectResponse
    {
        $requestId = (string) Str::uuid();

        // Honeypot — a filled hidden field means a bot. Fake success, no explanation, no mail.
        if (filled($request->input('website_url'))) {
            $this->logOutcome($request, $requestId, 'honeypot');

            return $this->fakeSuccess($locale);
        }

        // Timing trap — real visitors need at least a couple of seconds to fill the form.
        if (!$this->passesTimingCheck($request)) {
            $this->logOutcome($request, $requestId, 'too_fast');

            return $this->fakeSuccess($locale);
        }

        $allowedTypes = config('contact.form_request_types', []);

        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:100'],
            'email'        => ['required', 'string', 'email', 'max:150'],
            'phone'        => ['nullable', 'string', 'max:30'],
            'request_type' => ['required', 'string', 'in:' . implode(',', $allowedTypes)],
            'message'      => ['required', 'string', 'min:5', 'max:2000'],
            'privacy'      => ['accepted'],
        ], [
            'name.required'         => trans('contact.validation.name_required'),
            'email.required'        => trans('contact.validation.email_required'),
            'email.email'           => trans('contact.validation.email_invalid'),
            'phone.max'             => trans('contact.validation.phone_max'),
            'request_type.required' => trans('contact.validation.type_required'),
            'request_type.in'       => trans('contact.validation.type_invalid'),
            'message.required'      => trans('contact.validation.message_required'),
            'message.min'           => trans('contact.validation.message_min', ['min' => 5]),
            'message.max'           => trans('contact.validation.message_max'),
            'privacy.accepted'      => trans('contact.validation.privacy_accepted'),
        ]);

        // Short-lived duplicate guard: the exact same sender + message resubmitted
        // within the window (double-click, refresh-resubmit) is treated as one request.
        $dedupKey = 'contact:dedup:' . sha1(Str::lower(trim($validated['email'])) . '|' . $validated['message']);

        if (Cache::has($dedupKey)) {
            $this->logOutcome($request, $requestId, 'duplicate_suppressed');

            return $this->fakeSuccess($locale);
        }

        Cache::put($dedupKey, true, now()->addSeconds((int) config('contact.duplicate_window_seconds', 60)));

        try {
            Mail::to(config('contact.email'))->send(new ContactInquiry(
                data: [
                    'name'         => $validated['name'],
                    'email'        => $validated['email'],
                    'phone'        => $validated['phone'] ?? '',
                    'request_type' => $validated['request_type'],
                    'message'      => $validated['message'],
                    'submitted_at' => now()->format('d/m/Y H:i'),
                    'source_url'   => $request->headers->get('referer', ''),
                ],
                submissionLocale: $locale,
            ));
        } catch (Throwable) {
            $this->logOutcome($request, $requestId, 'mail_failed', 'error');

            return redirect()->route('contact', ['locale' => $locale])
                ->withInput($request->except(['website_url', 'form_token']))
                ->with('contact_error', trans('contact.send_error'));
        }

        $this->logOutcome($request, $requestId, 'sent');

        return redirect()->route('contact', ['locale' => $locale])
            ->with('contact_success', trans('contact.success'));
    }

    private function passesTimingCheck(Request $request): bool
    {
        $token = $request->input('form_token');

        if (!is_string($token) || $token === '') {
            return false;
        }

        try {
            $renderedAt = (int) Crypt::decryptString($token);
        } catch (DecryptException) {
            return false;
        }

        $elapsed = now()->timestamp - $renderedAt;
        $minSeconds = (int) config('contact.min_seconds_to_submit', 2);

        // Also reject absurdly stale tokens (e.g. a page left open for days) as a sanity bound.
        return $elapsed >= $minSeconds && $elapsed < 86400;
    }

    private function fakeSuccess(string $locale): RedirectResponse
    {
        return redirect()->route('contact', ['locale' => $locale])
            ->with('contact_success', trans('contact.success'));
    }

    /**
     * Log only technical, non-personal data: no name, e-mail, phone or message content.
     */
    private function logOutcome(Request $request, string $requestId, string $result, string $level = 'info'): void
    {
        Log::log($level, 'contact_form.' . $result, [
            'request_id' => $requestId,
            'ip_hash'    => hash('sha256', (string) $request->ip()),
        ]);
    }
}

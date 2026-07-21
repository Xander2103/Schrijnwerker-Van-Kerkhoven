<?php

namespace Tests\Feature;

use App\Mail\ContactConfirmation;
use App\Mail\ContactInquiry;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        Mail::fake();
    }

    private function freshFormToken(int $secondsAgo = 5): string
    {
        return Crypt::encryptString((string) now()->subSeconds($secondsAgo)->timestamp);
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'name'         => 'Jan Janssen',
            'email'        => 'jan@example.be',
            'phone'        => '0474 12 34 56',
            'request_type' => 'ramen_op_maat',
            'message'      => 'Ik wil graag een offerte voor nieuwe ramen.',
            'privacy'      => '1',
            'website_url'  => '',
            'form_token'   => $this->freshFormToken(),
        ], $overrides);
    }

    // ── GET pages render in correct locale ───────────────────────────────
    public function test_nl_contact_page_loads(): void
    {
        $this->get('/nl/contact')->assertStatus(200)->assertSee('Wij helpen u graag');
    }

    public function test_fr_contact_page_loads(): void
    {
        $this->get('/fr/contact')->assertStatus(200)->assertSee('Nous vous aidons volontiers');
    }

    public function test_en_contact_page_loads(): void
    {
        $this->get('/en/contact')->assertStatus(200)->assertSee("We're happy to help");
    }

    // ── Form labels per locale ───────────────────────────────────────────
    public function test_nl_contact_form_has_dutch_labels(): void
    {
        $this->get('/nl/contact')
            ->assertSee('Naam')
            ->assertSee('Telefoonnummer')
            ->assertSee('Verstuur aanvraag');
    }

    public function test_fr_contact_form_has_french_labels(): void
    {
        $this->get('/fr/contact')
            ->assertSee('Nom')
            ->assertSee('Numéro de téléphone')
            ->assertSee('Envoyer la demande');
    }

    public function test_en_contact_form_has_english_labels(): void
    {
        $this->get('/en/contact')
            ->assertSee('Name')
            ->assertSee('Phone number')
            ->assertSee('Submit request');
    }

    // ── Request types render in locale ───────────────────────────────────
    public function test_nl_request_types_render_in_dutch(): void
    {
        $this->get('/nl/contact')->assertSee('Ramen op maat');
    }

    public function test_fr_request_types_render_in_french(): void
    {
        $this->get('/fr/contact')->assertSee('Fenêtres sur mesure');
    }

    public function test_en_request_types_render_in_english(): void
    {
        $this->get('/en/contact')->assertSee('Custom windows');
    }

    // ── CSRF protection ────────────────────────────────────────────────────
    public function test_csrf_token_is_rendered_in_the_form(): void
    {
        // Laravel's VerifyCsrfToken middleware intentionally bypasses
        // verification while running unit tests (by framework design), so a
        // live 419 rejection cannot be exercised through a feature test.
        // What we *can* and must verify is that @csrf is actually emitted,
        // proving the protection is wired into this specific form.
        $this->get('/nl/contact')->assertSee('name="_token"', false);
    }

    // ── Successful submission ─────────────────────────────────────────────
    public function test_valid_contact_form_redirects_with_success(): void
    {
        $this->post('/nl/contact', $this->validPayload())
            ->assertRedirect()
            ->assertSessionHas('contact_success');
    }

    public function test_valid_submission_sends_mail(): void
    {
        $this->post('/nl/contact', $this->validPayload());
        Mail::assertSent(ContactInquiry::class);
    }

    public function test_mail_sent_with_correct_locale(): void
    {
        $this->post('/fr/contact', $this->validPayload());
        Mail::assertSent(ContactInquiry::class, function (ContactInquiry $mail) {
            return $mail->submissionLocale === 'fr';
        });
    }

    // ── Validation with machine-stable keys ──────────────────────────────
    public function test_contact_form_accepts_machine_key_request_type(): void
    {
        $this->post('/nl/contact', $this->validPayload(['request_type' => 'ramen_op_maat']))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
    }

    public function test_contact_form_rejects_invalid_request_type(): void
    {
        $this->post('/nl/contact', $this->validPayload(['request_type' => 'Ramen op maat']))
            ->assertSessionHasErrors('request_type');
    }

    public function test_contact_form_rejects_unknown_request_type(): void
    {
        $this->post('/nl/contact', $this->validPayload(['request_type' => 'unknown_type']))
            ->assertSessionHasErrors('request_type');
    }

    // ── Required-field validation ─────────────────────────────────────────
    public function test_contact_form_requires_name(): void
    {
        $this->post('/nl/contact', $this->validPayload(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    public function test_contact_form_requires_email(): void
    {
        $this->post('/nl/contact', $this->validPayload(['email' => '']))
            ->assertSessionHasErrors('email');
    }

    public function test_contact_form_phone_is_optional(): void
    {
        $this->post('/nl/contact', $this->validPayload(['phone' => '']))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
    }

    public function test_contact_form_requires_message(): void
    {
        $this->post('/nl/contact', $this->validPayload(['message' => '']))
            ->assertSessionHasErrors('message');
    }

    public function test_contact_form_requires_request_type(): void
    {
        $this->post('/nl/contact', $this->validPayload(['request_type' => '']))
            ->assertSessionHasErrors('request_type');
    }

    public function test_contact_form_requires_privacy_accepted(): void
    {
        $this->post('/nl/contact', $this->validPayload(['privacy' => '']))
            ->assertSessionHasErrors('privacy');
    }

    public function test_contact_form_email_must_be_valid(): void
    {
        $this->post('/nl/contact', $this->validPayload(['email' => 'not-an-email']))
            ->assertSessionHasErrors('email');
    }

    public function test_contact_form_preserves_input_on_validation_error(): void
    {
        $this->post('/nl/contact', $this->validPayload(['email' => 'not-an-email']))
            ->assertSessionHasErrors('email')
            ->assertSessionHas('_old_input.name', 'Jan Janssen');
    }

    // ── Too-long values ────────────────────────────────────────────────────
    public function test_contact_form_rejects_name_over_100_chars(): void
    {
        $this->post('/nl/contact', $this->validPayload(['name' => str_repeat('a', 101)]))
            ->assertSessionHasErrors('name');
    }

    public function test_contact_form_rejects_email_over_150_chars(): void
    {
        $overlong = str_repeat('a', 148) . '@x.be'; // 153 chars total, over the max:150 limit
        $this->post('/nl/contact', $this->validPayload(['email' => $overlong]))
            ->assertSessionHasErrors('email');
    }

    public function test_contact_form_rejects_phone_over_30_chars(): void
    {
        $this->post('/nl/contact', $this->validPayload(['phone' => str_repeat('1', 31)]))
            ->assertSessionHasErrors('phone');
    }

    public function test_contact_form_rejects_message_over_2000_chars(): void
    {
        $this->post('/nl/contact', $this->validPayload(['message' => str_repeat('a', 2001)]))
            ->assertSessionHasErrors('message');
    }

    public function test_contact_form_rejects_too_short_message(): void
    {
        $this->post('/nl/contact', $this->validPayload(['message' => 'Hi']))
            ->assertSessionHasErrors('message');
    }

    // ── Honeypot ───────────────────────────────────────────────────────────
    public function test_honeypot_silently_rejects_bots(): void
    {
        $response = $this->post('/nl/contact', $this->validPayload(['website_url' => 'http://spam.example.com']));
        $response->assertRedirect();
        Mail::assertNotSent(ContactInquiry::class);
        Mail::assertNotSent(ContactConfirmation::class);
        $response->assertSessionHas('contact_success'); // fakes success so bots cannot detect the trap
        $response->assertSessionHasNoErrors();
    }

    // ── Timing trap ────────────────────────────────────────────────────────
    public function test_unnaturally_fast_submission_is_silently_rejected(): void
    {
        $response = $this->post('/nl/contact', $this->validPayload([
            'form_token' => $this->freshFormToken(0), // "just rendered"
        ]));

        $response->assertRedirect();
        Mail::assertNotSent(ContactInquiry::class);
        Mail::assertNotSent(ContactConfirmation::class);
        $response->assertSessionHas('contact_success'); // same fake-success behaviour as the honeypot
    }

    public function test_missing_form_token_is_silently_rejected(): void
    {
        $payload = $this->validPayload();
        unset($payload['form_token']);

        $response = $this->post('/nl/contact', $payload);

        $response->assertRedirect();
        Mail::assertNotSent(ContactInquiry::class);
        $response->assertSessionHas('contact_success');
    }

    public function test_submission_after_natural_delay_is_accepted(): void
    {
        $this->post('/nl/contact', $this->validPayload(['form_token' => $this->freshFormToken(3)]))
            ->assertSessionHas('contact_success');
        Mail::assertSent(ContactInquiry::class);
    }

    // ── Rate limiting ──────────────────────────────────────────────────────
    public function test_rate_limit_blocks_after_three_submissions_per_minute(): void
    {
        // 3 allowed per minute per IP — a different sender per attempt, so the
        // duplicate guard and the IP+email combo limiter never interfere and
        // only the per-minute limiter can be at play.
        foreach (['a', 'b', 'c'] as $i) {
            $this->post('/nl/contact', $this->validPayload(['email' => "visitor-{$i}@example.be"]))
                ->assertSessionHas('contact_success');
        }

        $this->post('/nl/contact', $this->validPayload(['email' => 'visitor-d@example.be']))
            ->assertStatus(429);

        Mail::assertSent(ContactInquiry::class, 3);
    }

    public function test_rate_limit_blocks_after_ten_submissions_per_24_hours(): void
    {
        // Space requests 61s apart so the per-minute(3) bucket always resets,
        // and use a different e-mail each time so the combo limiter never
        // fires — isolating the pure per-IP per-day(10) limiter.
        for ($i = 0; $i < 10; $i++) {
            $this->travel(61)->seconds();

            $this->post('/nl/contact', $this->validPayload([
                'email'      => "visitor{$i}@example.be",
                'form_token' => $this->freshFormToken(),
            ]))->assertSessionHas('contact_success');
        }

        $this->travel(61)->seconds();
        $this->post('/nl/contact', $this->validPayload([
            'email'      => 'visitor-overflow@example.be',
            'form_token' => $this->freshFormToken(),
        ]))->assertStatus(429);

        Mail::assertSent(ContactInquiry::class, 10);

        $this->travelBack();
    }

    public function test_rate_limit_resets_automatically_after_minute_decay(): void
    {
        foreach (['a', 'b', 'c'] as $i) {
            $this->post('/nl/contact', $this->validPayload(['email' => "visitor-{$i}@example.be"]))
                ->assertSessionHas('contact_success');
        }

        $this->post('/nl/contact', $this->validPayload(['email' => 'visitor-d@example.be']))
            ->assertStatus(429);

        // After the decay window the visitor can simply submit again — no
        // manual unblock, the cache entry just expires.
        $this->travel(2)->minutes();

        $this->post('/nl/contact', $this->validPayload([
            'email'      => 'visitor-d@example.be',
            'form_token' => $this->freshFormToken(),
        ]))->assertSessionHas('contact_success');

        $this->travelBack();
    }

    public function test_rate_limit_still_blocks_within_the_24_hour_window(): void
    {
        // Distinguishes the per-24h limiter from a per-hour limiter: after the
        // daily quota is used up, even 3 hours later a new attempt must still
        // be refused, because the 24-hour window has not expired yet.
        for ($i = 0; $i < 10; $i++) {
            $this->travel(61)->seconds();

            $this->post('/nl/contact', $this->validPayload([
                'email'      => "visitor{$i}@example.be",
                'form_token' => $this->freshFormToken(),
            ]))->assertSessionHas('contact_success');
        }

        $this->travel(3)->hours();

        $this->post('/nl/contact', $this->validPayload([
            'email'      => 'visitor-later@example.be',
            'form_token' => $this->freshFormToken(),
        ]))->assertStatus(429);

        $this->travelBack();
    }

    public function test_rate_limit_resets_automatically_after_24_hour_decay(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $this->travel(61)->seconds();

            $this->post('/nl/contact', $this->validPayload([
                'email'      => "visitor{$i}@example.be",
                'form_token' => $this->freshFormToken(),
            ]))->assertSessionHas('contact_success');
        }

        $this->travel(61)->seconds();
        $this->post('/nl/contact', $this->validPayload([
            'email'      => 'visitor-overflow@example.be',
            'form_token' => $this->freshFormToken(),
        ]))->assertStatus(429);

        $this->travel(25)->hours();

        $this->post('/nl/contact', $this->validPayload([
            'email'      => 'visitor-returns@example.be',
            'form_token' => $this->freshFormToken(),
        ]))->assertSessionHas('contact_success');

        $this->travelBack();
    }

    public function test_no_mail_sent_for_rate_limited_request(): void
    {
        foreach (['a', 'b', 'c'] as $i) {
            $this->post('/nl/contact', $this->validPayload(['email' => "visitor-{$i}@example.be"]))
                ->assertSessionHas('contact_success');
        }

        $this->post('/nl/contact', $this->validPayload(['email' => 'visitor-d@example.be']))
            ->assertStatus(429);

        Mail::assertSent(ContactInquiry::class, 3);
        Mail::assertSent(ContactConfirmation::class, 3);
        Mail::assertNotSent(ContactInquiry::class, fn (ContactInquiry $m) => $m->hasReplyTo('visitor-d@example.be'));
    }

    // ── Duplicate submission ───────────────────────────────────────────────
    public function test_duplicate_submission_does_not_send_a_second_mail(): void
    {
        $payload = $this->validPayload();

        $this->post('/nl/contact', $payload)->assertSessionHas('contact_success');
        $this->post('/nl/contact', $payload)->assertSessionHas('contact_success'); // fake success, silently ignored

        Mail::assertSent(ContactInquiry::class, 1);
        Mail::assertSent(ContactConfirmation::class, 1);
    }

    // ── Legacy /contact redirect ──────────────────────────────────────────
    public function test_legacy_contact_redirects_to_nl(): void
    {
        $this->get('/contact')->assertRedirect('/nl/contact');
    }

    // ── Locale-specific validation error messages ─────────────────────────
    public function test_fr_form_returns_french_validation_error_message(): void
    {
        $response = $this->post('/fr/contact', $this->validPayload(['name' => '']));
        $response->assertSessionHasErrors('name');
        $this->assertStringContainsString(
            'Veuillez indiquer votre nom',
            session('errors')->first('name')
        );
    }

    public function test_en_form_returns_english_validation_error_message(): void
    {
        $response = $this->post('/en/contact', $this->validPayload(['name' => '']));
        $response->assertSessionHasErrors('name');
        $this->assertStringContainsString(
            'Please enter your name',
            session('errors')->first('name')
        );
    }

    // ── Email subject reflects submission locale ───────────────────────────
    public function test_email_subject_uses_submission_locale(): void
    {
        $this->post('/en/contact', $this->validPayload());
        Mail::assertSent(ContactInquiry::class, function (ContactInquiry $mail) {
            return $mail->envelope()->subject === 'New enquiry via the website';
        });
    }

    // ── Mail safety: From / Reply-To / recipient ────────────────────────────
    public function test_mail_from_uses_configured_noreply_address(): void
    {
        $this->post('/nl/contact', $this->validPayload());

        Mail::assertSent(ContactInquiry::class, function (ContactInquiry $mail) {
            return $mail->envelope()->from->address === config('mail.from.address');
        });
    }

    public function test_mail_reply_to_uses_visitor_email(): void
    {
        $this->post('/nl/contact', $this->validPayload(['email' => 'visitor-reply@example.be']));

        Mail::assertSent(ContactInquiry::class, function (ContactInquiry $mail) {
            return $mail->envelope()->replyTo[0]->address === 'visitor-reply@example.be';
        });
    }

    public function test_mail_is_sent_to_central_contact_address(): void
    {
        $this->post('/nl/contact', $this->validPayload());

        Mail::assertSent(ContactInquiry::class, function (ContactInquiry $mail) {
            return $mail->hasTo(config('contact.email'));
        });
    }

    // ── Confirmation mail to the visitor ───────────────────────────────────
    public function test_valid_submission_sends_confirmation_mail_to_visitor(): void
    {
        $this->post('/nl/contact', $this->validPayload(['email' => 'jan@example.be']));

        Mail::assertSent(ContactConfirmation::class, function (ContactConfirmation $mail) {
            return $mail->hasTo('jan@example.be');
        });
    }

    public function test_confirmation_mail_uses_configured_noreply_from_address(): void
    {
        $this->post('/nl/contact', $this->validPayload());

        Mail::assertSent(ContactConfirmation::class, function (ContactConfirmation $mail) {
            return $mail->envelope()->from->address === config('mail.from.address');
        });
    }

    public function test_confirmation_mail_subject_is_dutch_for_nl_submission(): void
    {
        $this->post('/nl/contact', $this->validPayload());

        Mail::assertSent(ContactConfirmation::class, function (ContactConfirmation $mail) {
            return $mail->envelope()->subject === 'We hebben uw aanvraag goed ontvangen – Van Kerkhoven';
        });
    }

    public function test_confirmation_mail_subject_is_french_for_fr_submission(): void
    {
        $this->post('/fr/contact', $this->validPayload());

        Mail::assertSent(ContactConfirmation::class, function (ContactConfirmation $mail) {
            return $mail->submissionLocale === 'fr'
                && $mail->envelope()->subject === 'Nous avons bien reçu votre demande – Van Kerkhoven';
        });
    }

    public function test_confirmation_mail_subject_is_english_for_en_submission(): void
    {
        $this->post('/en/contact', $this->validPayload());

        Mail::assertSent(ContactConfirmation::class, function (ContactConfirmation $mail) {
            return $mail->submissionLocale === 'en'
                && $mail->envelope()->subject === 'We have received your request – Van Kerkhoven';
        });
    }

    public function test_confirmation_mail_contains_name_type_and_message_summary(): void
    {
        $this->post('/nl/contact', $this->validPayload());

        Mail::assertSent(ContactConfirmation::class, function (ContactConfirmation $mail) {
            $html = $mail->render();

            return str_contains($html, 'Jan Janssen')
                && str_contains($html, 'Ramen op maat')
                && str_contains($html, 'Ik wil graag een offerte voor nieuwe ramen.')
                && str_contains($html, 'automatisch');
        });
    }

    public function test_no_confirmation_mail_on_validation_error(): void
    {
        $this->post('/nl/contact', $this->validPayload(['email' => 'not-an-email']))
            ->assertSessionHasErrors('email');

        Mail::assertNotSent(ContactInquiry::class);
        Mail::assertNotSent(ContactConfirmation::class);
    }

    public function test_duplicate_submission_sends_only_one_confirmation(): void
    {
        $payload = $this->validPayload();

        $this->post('/nl/contact', $payload);
        $this->post('/nl/contact', $payload);

        Mail::assertSent(ContactConfirmation::class, 1);
    }

    // ── Success feedback on the contact page ───────────────────────────────
    public function test_success_message_is_shown_as_accessible_live_region(): void
    {
        $response = $this->followingRedirects()->post('/nl/contact', $this->validPayload());

        $response->assertSee('Bedankt, uw aanvraag werd goed ontvangen.');
        $response->assertSee('bevestiging per e-mail');
        $response->assertSee('role="status"', false);
    }

    public function test_form_input_is_cleared_after_success(): void
    {
        $this->post('/nl/contact', $this->validPayload())
            ->assertSessionHas('contact_success')
            ->assertSessionMissing('_old_input');
    }

    // ── Mail failure ───────────────────────────────────────────────────────
    public function test_mail_failure_shows_error_and_no_success_message(): void
    {
        Mail::shouldReceive('to')->once()->andThrow(new \RuntimeException('smtp unavailable'));

        $response = $this->post('/nl/contact', $this->validPayload());

        $response->assertRedirect()
            ->assertSessionHas('contact_error')
            ->assertSessionMissing('contact_success')
            ->assertSessionHas('_old_input.name', 'Jan Janssen');
    }
}

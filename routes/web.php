<?php

use App\Http\Middleware\SetLocale;
use App\Mail\ContactInquiry;
use App\Support\GalleryScanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Root → default locale redirect
|--------------------------------------------------------------------------
*/
Route::redirect('/', '/nl', 302);

/*
|--------------------------------------------------------------------------
| Legacy non-locale paths → permanent redirect to /nl/...
|--------------------------------------------------------------------------
*/
Route::redirect('/contact',     '/nl/contact',         301);
Route::redirect('/privacy',     '/nl/privacy-policy',  301);
Route::redirect('/ramen',       '/nl/ramen',           301);
Route::redirect('/deuren',      '/nl/deuren',          301);
Route::redirect('/trappen',     '/nl/trappen',         301);
Route::redirect('/werkplaats',  '/nl/werkplaats',      301);
Route::redirect('/houtsoorten', '/nl/werkplaats',      301);
Route::redirect('/werkhuis',    '/nl/werkplaats',      301);

/*
|--------------------------------------------------------------------------
| Localized routes  /{locale}/...
|--------------------------------------------------------------------------
*/
Route::prefix('{locale}')
    ->where(['locale' => 'nl|fr|en'])
    ->middleware(SetLocale::class)
    ->group(function (): void {

        // ── Homepage ────────────────────────────────────────────────────────
        Route::get('/', function (string $locale): mixed {
            return view('pages.home', [
                'galleryImages'    => GalleryScanner::scan(),
                'atelierImages'    => GalleryScanner::scan('atelier'),
                'historischImages' => GalleryScanner::scan('historisch'),
            ]);
        })->name('home');

        // ── Ramen ───────────────────────────────────────────────────────────
        Route::get('/ramen', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('ramen'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.ramen', compact('galleryImages'));
        })->name('ramen');

        // ── Deuren ──────────────────────────────────────────────────────────
        Route::get('/deuren', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('deuren'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.deuren', compact('galleryImages'));
        })->name('deuren');

        // ── Trappen ─────────────────────────────────────────────────────────
        Route::get('/trappen', function (string $locale): mixed {
            $galleryImages = GalleryScanner::scan('trap');
            return view('pages.trappen', compact('galleryImages'));
        })->name('trappen');

        // ── Poorten (NL slug) ───────────────────────────────────────────────
        Route::get('/poorten', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('poorten'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.poorten', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/' . $locale . '/poorten',
                    'fr' => '/fr/portails',
                    'en' => '/en/gates',
                ],
            ]);
        })->name('poorten');

        // ── Portails (FR slug) ──────────────────────────────────────────────
        Route::get('/portails', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('poorten'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.poorten', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/nl/poorten',
                    'fr' => '/' . $locale . '/portails',
                    'en' => '/en/gates',
                ],
            ]);
        })->name('portails');

        // ── Gates (EN slug) ─────────────────────────────────────────────────
        Route::get('/gates', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('poorten'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.poorten', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/nl/poorten',
                    'fr' => '/fr/portails',
                    'en' => '/' . $locale . '/gates',
                ],
            ]);
        })->name('gates');

        // ── Schuiframen (NL slug) ───────────────────────────────────────────
        Route::get('/schuiframen', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('schuiframen'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.schuiframen', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/' . $locale . '/schuiframen',
                    'fr' => '/fr/coulissants',
                    'en' => '/en/sliding-windows',
                ],
            ]);
        })->name('schuiframen');

        // ── Coulissants (FR slug) ───────────────────────────────────────────
        Route::get('/coulissants', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('schuiframen'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.schuiframen', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/nl/schuiframen',
                    'fr' => '/' . $locale . '/coulissants',
                    'en' => '/en/sliding-windows',
                ],
            ]);
        })->name('coulissants');

        // ── Sliding windows (EN slug) ───────────────────────────────────────
        Route::get('/sliding-windows', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('schuiframen'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.schuiframen', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/nl/schuiframen',
                    'fr' => '/fr/coulissants',
                    'en' => '/' . $locale . '/sliding-windows',
                ],
            ]);
        })->name('sliding-windows');

        // ── Werkplaats ──────────────────────────────────────────────────────
        Route::get('/werkplaats', function (string $locale): mixed {
            return view('pages.werkplaats', [
                'atelierImages' => GalleryScanner::scan('atelier'),
            ]);
        })->name('werkplaats');

        // ── Privacy policy ──────────────────────────────────────────────────
        Route::get('/privacy-policy', function (string $locale): mixed {
            return view('pages.privacy');
        })->name('privacy');

        // ── Contact GET ─────────────────────────────────────────────────────
        Route::get('/contact', function (string $locale): mixed {
            return view('pages.contact');
        })->name('contact');

        // ── Contact POST ────────────────────────────────────────────────────
        Route::post('/contact', function (string $locale, Request $request): mixed {

            // Honeypot — fake success so bots cannot distinguish from a real submission
            if (!empty($request->input('website_url'))) {
                return redirect()->route('contact', ['locale' => $locale])
                    ->with('contact_success', trans('contact.success'));
            }

            // Daily rate limit: 2 submissions per IP per day
            $ip       = $request->ip();
            $cacheKey = 'contact:daily:' . sha1($ip . ':' . today()->toDateString());
            $count    = (int) Cache::get($cacheKey, 0);

            if ($count >= 2) {
                return redirect()->route('contact', ['locale' => $locale])
                    ->withInput()
                    ->with('contact_rate_error',
                        trans('contact.rate_error', ['phone' => config('site.phone')]));
            }

            $allowedTypes = config('contact.form_request_types', []);

            $request->validate([
                'name'         => ['required', 'string', 'max:100'],
                'phone'        => ['required', 'string', 'max:30'],
                'email'        => ['nullable', 'email', 'max:150'],
                'request_type' => ['required', 'string', 'in:' . implode(',', $allowedTypes)],
                'message'      => ['required', 'string', 'min:5', 'max:2000'],
                'privacy'      => ['accepted'],
            ], [
                'name.required'         => trans('contact.validation.name_required'),
                'phone.required'        => trans('contact.validation.phone_required'),
                'email.email'           => trans('contact.validation.email_invalid'),
                'request_type.required' => trans('contact.validation.type_required'),
                'request_type.in'       => trans('contact.validation.type_invalid'),
                'message.required'      => trans('contact.validation.message_required'),
                'message.min'           => trans('contact.validation.message_min', ['min' => 5]),
                'message.max'           => trans('contact.validation.message_max'),
                'privacy.accepted'      => trans('contact.validation.privacy_accepted'),
            ]);

            // Increment rate-limit counter after successful validation
            Cache::put($cacheKey, $count + 1, now()->endOfDay());

            // Send notification email to site owner
            try {
                Mail::to(config('contact.email'))->send(new ContactInquiry(
                    data: [
                        'name'         => $request->input('name'),
                        'email'        => $request->input('email'),
                        'phone'        => $request->input('phone'),
                        'request_type' => $request->input('request_type'),
                        'message'      => $request->input('message'),
                        'submitted_at' => now()->format('d/m/Y H:i'),
                        'source_url'   => $request->headers->get('referer', ''),
                    ],
                    submissionLocale: $locale,
                ));
            } catch (\Throwable) {
                // Mail failure must not block the user confirmation
            }

            return redirect()->route('contact', ['locale' => $locale])
                ->with('contact_success', trans('contact.success'));
        })->middleware('throttle:5,1')->name('contact.submit');
    });

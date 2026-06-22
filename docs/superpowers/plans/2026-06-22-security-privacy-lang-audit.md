# Security, Privacy & Language Switcher Audit — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use `superpowers:subagent-driven-development` (recommended) or `superpowers:executing-plans` to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Fix the five concrete findings from the security/GDPR/UX audit: missing security headers, invisible language switcher on dark hero, honeypot not faking success, no minimum message length, Google Maps auto-loading without consent — plus add the missing test coverage.

**Architecture:** All changes are confined to the existing Laravel app (routes, middleware, Blade views, CSS, lang files, tests). No new packages needed. No database changes.

**Tech Stack:** Laravel 12, PHP 8.2, Blade, Tailwind v4 via Vite, PHPUnit 11, SQLite (tests).

## Global Constraints

- Do NOT redesign the website; touch only what the audit flagged.
- Do NOT run `route:cache` — routes are closures and it is not safe here.
- Do NOT commit `.env`. Only `.env.example` and application files.
- All validation messages must use translation keys already in the lang files (add any missing keys).
- CSS lives exclusively in `resources/css/client-site.css` (no utility strings in Blade).
- Use `{{ }}` in Blade. `{!! !!}` is only acceptable for trusted translation strings that already contain intentional HTML (h3_body2, h5_body2, h6_after in privacy.php — all static, no user input).
- Run `php artisan test` and `npm run build` at the end of Task 6.

## Audit Findings — Quick Reference

| # | Finding | Severity | File(s) |
|---|---------|----------|---------|
| F1 | No security headers (X-Frame-Options etc.) | High | `bootstrap/app.php` |
| F2 | Lang switcher has zero CSS — invisible on dark hero | High | `client-site.css`, `nav.blade.php` |
| F3 | Honeypot redirects back but does NOT fake success session | Medium | `routes/web.php` |
| F4 | Message field has no minimum length | Medium | `routes/web.php`, lang files |
| F5 | Google Maps iframe auto-loads without click-to-consent | Medium | `sections/location.blade.php` |
| F6 | Missing tests: min message, FR/EN errors, Mail::assertNotSent | Medium | `ContactFormTest.php` |

## Items Requiring Human / Client Review (NOT in scope of this plan)

- Verify data processing agreement with hosting provider (Belgian/EU GDPR Art. 28)
- Verify that Outlook/Microsoft email is documented as a processor in actual client DPA
- Confirm whether `config('site.phone')` is complete and correct in production `.env`
- Confirm whether a cookie banner is legally required (current assessment: not needed given no analytics/tracking cookies — only CSRF session cookie)
- Confirm whether the privacy policy wording is acceptable for the client's risk tolerance (existing legal-review note already present in all 3 languages)
- Confirm production `APP_DEBUG=false` and `APP_KEY` are set in the deployment `.env`

---

## File Map

| File | Action | Reason |
|------|--------|--------|
| `app/Http/Middleware/SecurityHeaders.php` | CREATE | Security headers middleware |
| `bootstrap/app.php` | MODIFY | Register SecurityHeaders as global web middleware |
| `routes/web.php` | MODIFY | Honeypot fake success + message min:5 |
| `lang/nl/contact.php` | MODIFY | Add `message_min` validation key |
| `lang/fr/contact.php` | MODIFY | Add `message_min` validation key |
| `lang/en/contact.php` | MODIFY | Add `message_min` validation key |
| `resources/views/sections/location.blade.php` | MODIFY | Click-to-load Google Maps |
| `resources/css/client-site.css` | MODIFY | Language switcher CSS + hero override |
| `tests/Feature/ContactFormTest.php` | MODIFY | Add 4 missing tests, improve honeypot test |

---

## Task 1: Security Headers Middleware

**Files:**
- Create: `app/Http/Middleware/SecurityHeaders.php`
- Modify: `bootstrap/app.php`

**Interfaces:**
- Produces: `App\Http\Middleware\SecurityHeaders` — a standard Laravel middleware registered globally on web routes

- [ ] **Step 1: Write the middleware file**

Create `app/Http/Middleware/SecurityHeaders.php`:

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        return $response;
    }
}
```

- [ ] **Step 2: Register the middleware in bootstrap/app.php**

Replace the empty `withMiddleware` callback:

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->web(append: [
        \App\Http\Middleware\SecurityHeaders::class,
    ]);
})
```

Full updated file:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\SecurityHeaders::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
```

- [ ] **Step 3: Verify headers are present on a route**

Run:
```
php artisan tinker --execute="echo app(\App\Http\Middleware\SecurityHeaders::class)::class;"
```
Expected: no fatal error (class resolves)

- [ ] **Step 4: Commit**

```bash
git add app/Http/Middleware/SecurityHeaders.php bootstrap/app.php
git commit -m "feat: add security headers middleware (X-Content-Type-Options, X-Frame-Options, Referrer-Policy, Permissions-Policy)"
```

---

## Task 2: Contact Form Hardening — Min Length + Honeypot Fake Success

**Files:**
- Modify: `routes/web.php:115-131`
- Modify: `routes/web.php:96-99`
- Modify: `lang/nl/contact.php`
- Modify: `lang/fr/contact.php`
- Modify: `lang/en/contact.php`

**Interfaces:**
- Consumes: `trans('contact.validation.message_min')` — must exist in all 3 lang files
- Produces: honeypot returns fake success session; message validates min 5 chars

- [ ] **Step 1: Add `message_min` to NL lang file**

In `lang/nl/contact.php`, inside the `'validation'` array, add after `'message_required'`:

```php
'message_min'      => 'Uw bericht moet minstens :min tekens bevatten.',
```

- [ ] **Step 2: Add `message_min` to FR lang file**

In `lang/fr/contact.php`, inside the `'validation'` array, add after `'message_required'`:

```php
'message_min'      => 'Votre message doit contenir au moins :min caractères.',
```

- [ ] **Step 3: Add `message_min` to EN lang file**

In `lang/en/contact.php`, inside the `'validation'` array, add after `'message_required'`:

```php
'message_min'      => 'Your message must be at least :min characters.',
```

- [ ] **Step 4: Update the contact POST in routes/web.php**

Two changes in the same file:

**Change A — Honeypot fake success** (lines 96-99):

Replace:
```php
// Honeypot
if (!empty($request->input('website_url'))) {
    return redirect()->back();
}
```

With:
```php
// Honeypot — fake success so bots cannot distinguish from real submission
if (!empty($request->input('website_url'))) {
    return redirect()->route('contact', ['locale' => $locale])
        ->with('contact_success', trans('contact.success'));
}
```

**Change B — Add min:5 to message validation** (lines 115-131):

Replace:
```php
'message'      => ['required', 'string', 'max:2000'],
```

With:
```php
'message'      => ['required', 'string', 'min:5', 'max:2000'],
```

And add the message_min custom message to the validation messages array:
```php
'message.min'           => trans('contact.validation.message_min', ['min' => 5]),
```

The full validation call after both changes:
```php
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
```

- [ ] **Step 5: Run tests to check nothing broke**

```
php artisan test --filter ContactFormTest
```

Expected: existing tests pass (honeypot test will fail — fix in Task 5).

- [ ] **Step 6: Commit**

```bash
git add routes/web.php lang/nl/contact.php lang/fr/contact.php lang/en/contact.php
git commit -m "feat: contact form — add min message length (5 chars), fake success on honeypot"
```

---

## Task 3: Google Maps Click-to-Load

**Files:**
- Modify: `resources/views/sections/location.blade.php`

**Interfaces:**
- Produces: map iframe is NOT loaded until the user explicitly clicks a button; once loaded, the button disappears

**Why:** Google Maps auto-loading sends IP/browser data to Google without user action. The existing privacy policy already mentions this and tells users they can use the link instead — but the iframe still loads automatically. Click-to-load is the privacy-preserving fix that matches GDPR best practice.

- [ ] **Step 1: Replace the auto-loading iframe with a consent block**

Replace the entire `<div>` block that contains the iframe (lines 48-63 of `location.blade.php`) with:

```blade
<div>
    @if(!empty(config('site.maps_embed_url')))
        <div class="map-embed-container" id="map-consent-wrap">
            {{-- Click-to-load: map is not loaded until the user consents --}}
            <div class="map-consent-placeholder" id="map-consent-placeholder">
                <p class="map-consent-text">{{ __('site.maps_consent_text') }}</p>
                <button
                    type="button"
                    class="btn btn-secondary map-consent-btn"
                    id="map-consent-btn"
                    aria-label="{{ __('site.maps_consent_aria') }}"
                >
                    {{ __('site.maps_consent_btn') }}
                </button>
            </div>
        </div>
    @else
        <div class="image-fallback" style="min-height:360px;">
            <span>Google Maps wordt hier gekoppeld.</span>
        </div>
    @endif
</div>

@push('scripts')
<script>
(function () {
    var btn = document.getElementById('map-consent-btn');
    if (!btn) return;
    btn.addEventListener('click', function () {
        var wrap = document.getElementById('map-consent-wrap');
        var placeholder = document.getElementById('map-consent-placeholder');
        if (!wrap) return;
        var iframe = document.createElement('iframe');
        iframe.src = {{ Js::from(config('site.maps_embed_url')) }};
        iframe.allowFullscreen = true;
        iframe.loading = 'lazy';
        iframe.referrerPolicy = 'no-referrer-when-downgrade';
        iframe.title = {{ Js::from(__('site.location_title', ['name' => config('site.name')])) }};
        iframe.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;border:0;';
        if (placeholder) placeholder.remove();
        wrap.appendChild(iframe);
    });
}());
</script>
@endpush
```

- [ ] **Step 2: Add CSS for the consent placeholder**

In `resources/css/client-site.css`, after the existing `.map-embed-container iframe` block (around line 525), add:

```css
/* Maps consent placeholder — shown before user loads the iframe */
.map-consent-placeholder {
  position: absolute;
  inset: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1rem;
  background-color: var(--color-secondary);
  border-radius: 0.75rem;
  padding: 1.5rem;
  text-align: center;
}

.map-consent-text {
  font-size: 0.875rem;
  color: var(--color-text-light);
  max-width: 28ch;
  margin: 0;
}
```

- [ ] **Step 3: Add the 3 new translation keys to all 3 lang/*/site.php files**

In `lang/nl/site.php`:
```php
'maps_consent_text' => 'Klik om de kaart te laden. Google verwerkt uw IP-adres wanneer de kaart wordt geladen.',
'maps_consent_btn'  => 'Kaart laden',
'maps_consent_aria' => 'Laad de Google Maps kaart',
```

In `lang/fr/site.php`:
```php
'maps_consent_text' => 'Cliquez pour charger la carte. Google traitera votre adresse IP lors du chargement.',
'maps_consent_btn'  => 'Charger la carte',
'maps_consent_aria' => 'Charger la carte Google Maps',
```

In `lang/en/site.php`:
```php
'maps_consent_text' => 'Click to load the map. Google will process your IP address when the map loads.',
'maps_consent_btn'  => 'Load map',
'maps_consent_aria' => 'Load Google Maps',
```

- [ ] **Step 4: Verify the section renders correctly**

Run the app (`php artisan serve`) and navigate to the homepage location section. Confirm:
- The map placeholder and button are shown — no iframe is loaded
- Clicking the button loads the iframe and removes the placeholder

- [ ] **Step 5: Commit**

```bash
git add resources/views/sections/location.blade.php resources/css/client-site.css lang/nl/site.php lang/fr/site.php lang/en/site.php
git commit -m "feat: Google Maps click-to-load consent (GDPR — iframe not auto-loaded)"
```

---

## Task 4: Language Switcher CSS Fix

**Files:**
- Modify: `resources/css/client-site.css`

**Context:** The nav Blade (`partials/nav.blade.php`) uses classes `.nav-lang-switcher` (desktop wrapper), `.nav-lang-active` (current locale span), `.nav-lang-link` (inactive locale links), and `.nav-mobile-lang` (mobile wrapper). **None of these have any CSS.** The transparent hero state overrides nav link colours but not lang switcher colours, making the switcher invisible (dark text on dark hero).

**Design intent:** Compact text row `NL | FR | EN`. Active locale: bold, primary colour (white in hero). Inactive: muted, smaller. Clear hover + focus states. Clean, not cluttered.

- [ ] **Step 1: Find the insertion point**

In `client-site.css`, locate the `/* --- Navigation --- */` comment block (around line 527) where `.nav-bar`, `.nav-inner`, `.nav-links`, `.nav-toggle`, `.nav-mobile-panel` are defined.

- [ ] **Step 2: Add language switcher CSS inside the Navigation layer block**

After the `.nav-mobile-link` ruleset and before the `/* --- Footer --- */` comment, add:

```css
/* --- Language Switcher --- */

.nav-lang-switcher {
  display: none;
  align-items: center;
  gap: 0;
  flex-shrink: 0;
}

@media (min-width: 768px) {
  .nav-lang-switcher {
    display: flex;
  }
}

.nav-lang-switcher .nav-lang-active,
.nav-lang-switcher .nav-lang-link {
  font-size: 0.6875rem;
  font-weight: 500;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  padding: 0.2rem 0.45rem;
  line-height: 1;
}

.nav-lang-switcher .nav-lang-active {
  font-weight: 700;
  color: var(--color-primary);
  border-bottom: 1.5px solid var(--color-accent);
  cursor: default;
}

.nav-lang-switcher .nav-lang-link {
  color: var(--color-text-light);
  text-decoration: none;
  border-bottom: 1.5px solid transparent;
  transition: color 0.15s ease, border-color 0.15s ease;

  &:hover {
    color: var(--color-primary);
  }

  &:focus-visible {
    outline: 2px solid var(--color-accent);
    outline-offset: 2px;
    border-radius: 2px;
  }
}

/* Separator between lang items: NL | FR | EN */
.nav-lang-switcher .nav-lang-active:not(:last-child)::after,
.nav-lang-switcher .nav-lang-link:not(:last-child)::after {
  content: '|';
  margin-left: 0.45rem;
  font-weight: 400;
  color: var(--color-border);
  pointer-events: none;
}

/* Mobile language switcher */
.nav-mobile-lang {
  display: flex;
  align-items: center;
  gap: 0;
  margin-top: 1rem;
}

.nav-mobile-lang .nav-lang-active,
.nav-mobile-lang .nav-lang-link {
  font-size: 0.8125rem;
  font-weight: 500;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  padding: 0.3rem 0.6rem;
  line-height: 1;
}

.nav-mobile-lang .nav-lang-active {
  font-weight: 700;
  color: var(--color-primary);
  border-bottom: 2px solid var(--color-accent);
  cursor: default;
}

.nav-mobile-lang .nav-lang-link {
  color: var(--color-text-light);
  text-decoration: none;
  border-bottom: 2px solid transparent;
  transition: color 0.15s ease;

  &:hover {
    color: var(--color-primary);
  }

  &:focus-visible {
    outline: 2px solid var(--color-accent);
    outline-offset: 2px;
    border-radius: 2px;
  }
}

.nav-mobile-lang .nav-lang-active:not(:last-child)::after,
.nav-mobile-lang .nav-lang-link:not(:last-child)::after {
  content: '|';
  margin-left: 0.6rem;
  font-weight: 400;
  color: var(--color-border);
  pointer-events: none;
}
```

- [ ] **Step 3: Add transparent-hero override for lang switcher**

Inside the existing transparent hero state block (after `body.page-home:not(.nav-scrolled) .nav-toggle span { ... }`), add:

```css
/* Lang switcher — transparent hero state */
body.page-home:not(.nav-scrolled) .nav-lang-switcher .nav-lang-active {
  color: #ffffff;
  border-bottom-color: rgba(255, 255, 255, 0.55);
}

body.page-home:not(.nav-scrolled) .nav-lang-switcher .nav-lang-link {
  color: rgba(255, 255, 255, 0.65);
}

body.page-home:not(.nav-scrolled) .nav-lang-switcher .nav-lang-link:hover {
  color: #ffffff;
}

body.page-home:not(.nav-scrolled) .nav-lang-switcher .nav-lang-active::after,
body.page-home:not(.nav-scrolled) .nav-lang-switcher .nav-lang-link::after {
  color: rgba(255, 255, 255, 0.25);
}
```

- [ ] **Step 4: Verify visually**

Run `npm run build` and open the homepage in a browser. Confirm:
1. Desktop: lang switcher visible, `NL | FR | EN` style, active locale bold and underlined in accent colour
2. Desktop on scroll (transparent hero): lang switcher items are white/light, visible over hero image
3. Mobile menu: lang switcher visible and readable
4. Tab through the inactive lang links — focus ring visible

- [ ] **Step 5: Commit**

```bash
git add resources/css/client-site.css
git commit -m "fix: language switcher CSS — visible on light header and dark/transparent hero"
```

---

## Task 5: Test Improvements

**Files:**
- Modify: `tests/Feature/ContactFormTest.php`

**Interfaces:**
- Consumes: updated `routes/web.php` (honeypot now sets contact_success), min:5 rule

**Tests to add/update:**

| Test name | Change |
|-----------|--------|
| `test_honeypot_silently_rejects_bots` | UPDATE: assert `contact_success` (fake success) + `Mail::assertNotSent` |
| `test_contact_form_rejects_too_short_message` | NEW |
| `test_fr_form_returns_french_validation_error_message` | NEW |
| `test_en_form_returns_english_validation_error_message` | NEW |
| `test_email_subject_uses_submission_locale` | NEW |

- [ ] **Step 1: Update honeypot test**

Replace the existing `test_honeypot_silently_rejects_bots` method:

```php
public function test_honeypot_silently_rejects_bots(): void
{
    $response = $this->post('/nl/contact', $this->validPayload(['website_url' => 'http://spam.example.com']));
    $response->assertRedirect();
    Mail::assertNotSent(ContactInquiry::class);
    $response->assertSessionHas('contact_success'); // fakes success to confuse bots
    $response->assertSessionHasNoErrors();
}
```

- [ ] **Step 2: Add test for too-short message**

Add after `test_contact_form_rejects_message_over_2000_chars`:

```php
public function test_contact_form_rejects_too_short_message(): void
{
    $this->post('/nl/contact', $this->validPayload(['message' => 'Hi']))
        ->assertSessionHasErrors('message');
}
```

- [ ] **Step 3: Add FR validation error language test**

```php
public function test_fr_form_returns_french_validation_error_message(): void
{
    $response = $this->post('/fr/contact', $this->validPayload(['name' => '']));
    $response->assertSessionHasErrors('name');

    $errors = session('errors');
    $this->assertStringContainsString('Veuillez indiquer votre nom', $errors->first('name'));
}
```

- [ ] **Step 4: Add EN validation error language test**

```php
public function test_en_form_returns_english_validation_error_message(): void
{
    $response = $this->post('/en/contact', $this->validPayload(['name' => '']));
    $response->assertSessionHasErrors('name');

    $errors = session('errors');
    $this->assertStringContainsString('Please enter your name', $errors->first('name'));
}
```

- [ ] **Step 5: Add email subject locale test**

```php
public function test_email_subject_uses_submission_locale(): void
{
    $this->post('/en/contact', $this->validPayload());
    Mail::assertSent(ContactInquiry::class, function (ContactInquiry $mail) {
        $mail->build();
        return str_contains($mail->subject, 'New enquiry');
    });
}
```

Note: If `ContactInquiry` uses `->subject(...)` in `build()`, adjust the check. If the subject is set via `envelope()`, update accordingly after reading `app/Mail/ContactInquiry.php` to confirm the method name.

- [ ] **Step 6: Run full test suite**

```
php artisan test
```

Expected: all tests pass. If `test_email_subject_uses_submission_locale` fails due to `build()` not being the right method, read `app/Mail/ContactInquiry.php` and adjust the subject-checking approach.

- [ ] **Step 7: Commit**

```bash
git add tests/Feature/ContactFormTest.php
git commit -m "test: add missing contact form tests — min message, FR/EN locale errors, email locale, honeypot assertNotSent"
```

---

## Task 6: Final Build & Verify

- [ ] **Step 1: Run full test suite**

```
php artisan test
```

Expected output: All tests pass. Count should be >= 30 tests (26 original + 4 new + any existing).

- [ ] **Step 2: Run Vite build**

```
npm run build
```

Expected: build completes without errors.

- [ ] **Step 3: Verify security headers**

```
php artisan serve
```

Then in a separate terminal:
```
curl -I http://localhost:8000/nl
```

Expected headers in response:
```
X-Content-Type-Options: nosniff
X-Frame-Options: SAMEORIGIN
Referrer-Policy: strict-origin-when-cross-origin
Permissions-Policy: camera=(), microphone=(), geolocation=()
```

- [ ] **Step 4: Commit final state (if any cleanup needed)**

```bash
git add -p
git commit -m "chore: final build pass — security, privacy, lang switcher audit complete"
```

---

## Final Audit Report (fill in after completion)

### Security Findings Fixed
- [x] F1: Security headers added (X-Content-Type-Options, X-Frame-Options, Referrer-Policy, Permissions-Policy)
- [x] F2: Language switcher CSS added — visible on light and dark/transparent hero

### Contact Form Abuse Protections (existing + new)
- CSRF token: already present
- Honeypot (website_url): already present; now fakes success session
- Rate limit: 2/day per IP (cache-based) + throttle:5,1 middleware: already present
- Request type whitelist: already present
- Message min:5 / max:2000: min was missing, now added
- Name/phone/email/privacy validated: already present
- Fake success on honeypot: now added

### GDPR / Privacy Improvements
- [x] F5: Google Maps changed to click-to-load
- Privacy policy in NL/FR/EN: already present ✓
- Legal review note in all 3 languages: already present ✓
- Company name, address, VAT in footer + privacy: already present ✓
- No analytics cookies, no tracking: confirmed ✓
- Session cookie (CSRF only): documented in privacy policy ✓

### Legal Items Still Requiring Human/Client Review
- Data processing agreement with hosting provider
- Microsoft/Outlook as email processor — should be documented
- Production APP_DEBUG=false, APP_KEY set in deployment .env
- Whether cookie banner is needed for your jurisdiction/risk appetite
- Privacy policy professional legal review (note already present)

### Language Selector UX Changes
- Added `.nav-lang-switcher`, `.nav-lang-active`, `.nav-lang-link` CSS (was completely missing)
- Added transparent-hero colour overrides (white text on dark background)
- Added `.nav-mobile-lang` CSS for mobile menu
- Active locale: bold + accent underline; inactive: muted + hover to primary
- Separator `|` via CSS pseudo-element
- Focus ring visible for keyboard navigation

### Tests / Build
- `php artisan test`: [FILL IN — count and pass/fail]
- `npm run build`: [FILL IN — success/error]

### Commit Hash
[FILL IN after Task 6]

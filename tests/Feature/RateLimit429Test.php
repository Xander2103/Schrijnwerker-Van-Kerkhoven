<?php

namespace Tests\Feature;

use App\Mail\ContactConfirmation;
use App\Mail\ContactInquiry;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class RateLimit429Test extends TestCase
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

    /**
     * Exhaust the per-minute limiter (3/min per IP) and return the throttled
     * (4th) response for the given locale.
     */
    private function throttledResponse(string $locale = 'nl'): TestResponse
    {
        foreach (['a', 'b', 'c'] as $i) {
            $this->post("/{$locale}/contact", $this->validPayload([
                'email' => "visitor-{$i}@example.be",
            ]));
        }

        return $this->post("/{$locale}/contact", $this->validPayload([
            'email' => 'visitor-d@example.be',
        ]));
    }

    // ── Real 429 status with custom page ──────────────────────────────────
    public function test_rate_limited_request_returns_real_429_status(): void
    {
        $this->throttledResponse()->assertStatus(429);
    }

    public function test_429_page_is_the_custom_branded_page_not_the_laravel_default(): void
    {
        $response = $this->throttledResponse();

        $response->assertStatus(429)
            // Custom page markers: client layout + branded content.
            ->assertSee('client-page', false)
            ->assertSee('<h1', false)
            // The default Laravel error page title/text must not appear.
            ->assertDontSee('Too Many Requests');
    }

    public function test_429_page_has_noindex_nofollow(): void
    {
        $this->throttledResponse()
            ->assertSee('noindex, nofollow', false);
    }

    public function test_429_response_has_retry_after_header(): void
    {
        $response = $this->throttledResponse();

        $response->assertStatus(429);
        $this->assertTrue($response->headers->has('Retry-After'));
        $this->assertIsNumeric($response->headers->get('Retry-After'));
    }

    public function test_429_page_does_not_leak_limits_or_technical_details(): void
    {
        $response = $this->throttledResponse();

        $content = $response->getContent();
        $this->assertStringNotContainsString('per minuut', $content);
        $this->assertStringNotContainsString('per uur', $content);
        $this->assertStringNotContainsString('Exception', $content);
        $this->assertStringNotContainsString('vendor/', $content);
    }

    // ── Localised texts ────────────────────────────────────────────────────
    public function test_429_page_shows_dutch_text_for_nl(): void
    {
        $this->throttledResponse('nl')
            ->assertSee('Even te veel aanvragen')
            ->assertSee('U hebt kort na elkaar meerdere aanvragen verstuurd.')
            ->assertSee('Terug naar contact')
            ->assertSee('/nl/contact', false);
    }

    public function test_429_page_shows_french_text_for_fr(): void
    {
        $this->throttledResponse('fr')
            ->assertSee('Trop de demandes')
            ->assertSee('Vous avez envoyé plusieurs demandes en peu de temps.')
            ->assertSee('Retour au contact')
            ->assertSee('/fr/contact', false);
    }

    public function test_429_page_shows_english_text_for_en(): void
    {
        $this->throttledResponse('en')
            ->assertSee('Too many requests')
            ->assertSee('You submitted several requests in a short period of time.')
            ->assertSee('Back to contact')
            ->assertSee('/en/contact', false);
    }

    public function test_429_page_links_back_to_homepage(): void
    {
        $this->throttledResponse('nl')
            ->assertSee('href="/nl"', false);
    }

    // ── No mails on a throttled request ───────────────────────────────────
    public function test_no_mails_are_sent_for_the_throttled_request(): void
    {
        $this->throttledResponse()->assertStatus(429);

        // The 3 allowed submissions each produce one business + one
        // confirmation mail; the throttled 4th produces nothing.
        Mail::assertSent(ContactInquiry::class, 3);
        Mail::assertSent(ContactConfirmation::class, 3);
        Mail::assertNotSent(ContactConfirmation::class, fn (ContactConfirmation $m) => $m->hasTo('visitor-d@example.be'));
    }

    // ── Automatic reset via cache expiry ──────────────────────────────────
    public function test_form_works_again_after_decay_period_expires(): void
    {
        $this->throttledResponse()->assertStatus(429);

        $this->travel(2)->minutes();

        $this->post('/nl/contact', $this->validPayload([
            'email'      => 'visitor-d@example.be',
            'form_token' => $this->freshFormToken(),
        ]))->assertSessionHas('contact_success');

        $this->travelBack();
    }
}

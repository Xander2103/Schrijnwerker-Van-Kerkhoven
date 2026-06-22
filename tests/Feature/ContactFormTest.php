<?php

namespace Tests\Feature;

use App\Mail\ContactInquiry;
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

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'name'         => 'Jan Janssen',
            'phone'        => '0474 12 34 56',
            'email'        => 'jan@example.be',
            'request_type' => 'ramen_op_maat',
            'message'      => 'Ik wil graag een offerte voor nieuwe ramen.',
            'privacy'      => '1',
            'website_url'  => '',
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

    // ── Validation errors ─────────────────────────────────────────────────
    public function test_contact_form_requires_name(): void
    {
        $this->post('/nl/contact', $this->validPayload(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    public function test_contact_form_requires_phone(): void
    {
        $this->post('/nl/contact', $this->validPayload(['phone' => '']))
            ->assertSessionHasErrors('phone');
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

    public function test_contact_form_email_must_be_valid_when_provided(): void
    {
        $this->post('/nl/contact', $this->validPayload(['email' => 'not-an-email']))
            ->assertSessionHasErrors('email');
    }

    public function test_contact_form_email_is_optional(): void
    {
        $this->post('/nl/contact', $this->validPayload(['email' => '']))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
    }

    public function test_honeypot_silently_rejects_bots(): void
    {
        $response = $this->post('/nl/contact', $this->validPayload(['website_url' => 'http://spam.example.com']));
        $response->assertRedirect();
        $this->assertNull(session('contact_success'));
        $this->assertEmpty(session('errors'));
    }

    public function test_contact_form_rejects_message_over_2000_chars(): void
    {
        $this->post('/nl/contact', $this->validPayload(['message' => str_repeat('a', 2001)]))
            ->assertSessionHasErrors('message');
    }

    public function test_rate_limit_blocks_after_two_successful_submissions(): void
    {
        $this->post('/nl/contact', $this->validPayload())->assertSessionHas('contact_success');
        $this->post('/nl/contact', $this->validPayload())->assertSessionHas('contact_success');
        $this->post('/nl/contact', $this->validPayload())->assertSessionHas('contact_rate_error');
    }

    // ── Legacy /contact redirect ──────────────────────────────────────────
    public function test_legacy_contact_redirects_to_nl(): void
    {
        $this->get('/contact')->assertRedirect('/nl/contact');
    }
}

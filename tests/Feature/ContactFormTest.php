<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContactFormTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'name'         => 'Jan Janssen',
            'phone'        => '0474 12 34 56',
            'email'        => 'jan@example.be',
            'request_type' => 'Ramen en deuren',
            'message'      => 'Ik wil graag een offerte voor nieuwe ramen.',
            'privacy'      => '1',
            'website_url'  => '',
        ], $overrides);
    }

    public function test_valid_contact_form_redirects_with_success(): void
    {
        $this->post('/contact', $this->validPayload())
            ->assertRedirect()
            ->assertSessionHas('contact_success');
    }

    public function test_contact_form_requires_name(): void
    {
        $this->post('/contact', $this->validPayload(['name' => '']))
            ->assertSessionHasErrors('name');
    }

    public function test_contact_form_requires_phone(): void
    {
        $this->post('/contact', $this->validPayload(['phone' => '']))
            ->assertSessionHasErrors('phone');
    }

    public function test_contact_form_requires_message(): void
    {
        $this->post('/contact', $this->validPayload(['message' => '']))
            ->assertSessionHasErrors('message');
    }

    public function test_contact_form_requires_request_type(): void
    {
        $this->post('/contact', $this->validPayload(['request_type' => '']))
            ->assertSessionHasErrors('request_type');
    }

    public function test_contact_form_requires_privacy_accepted(): void
    {
        $this->post('/contact', $this->validPayload(['privacy' => '']))
            ->assertSessionHasErrors('privacy');
    }

    public function test_contact_form_email_must_be_valid_when_provided(): void
    {
        $this->post('/contact', $this->validPayload(['email' => 'not-an-email']))
            ->assertSessionHasErrors('email');
    }

    public function test_contact_form_email_is_optional(): void
    {
        $this->post('/contact', $this->validPayload(['email' => '']))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
    }

    public function test_honeypot_silently_rejects_bots(): void
    {
        $response = $this->post('/contact', $this->validPayload(['website_url' => 'http://spam.example.com']));

        // Honeypot triggers a redirect without a success flash or validation errors
        $response->assertRedirect();
        $this->assertNull(session('contact_success'));
        $this->assertEmpty(session('errors'));
    }

    public function test_contact_form_rejects_message_over_2000_chars(): void
    {
        $this->post('/contact', $this->validPayload(['message' => str_repeat('a', 2001)]))
            ->assertSessionHasErrors('message');
    }

    public function test_rate_limit_blocks_after_two_successful_submissions(): void
    {
        // First two valid submissions should succeed (cache count: 0→1, 1→2)
        $this->post('/contact', $this->validPayload())->assertSessionHas('contact_success');
        $this->post('/contact', $this->validPayload())->assertSessionHas('contact_success');

        // Third submission: cache count is 2 (>= 2), should be rate-limited
        $this->post('/contact', $this->validPayload())->assertSessionHas('contact_rate_error');
    }
}

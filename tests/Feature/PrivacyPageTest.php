<?php

namespace Tests\Feature;

use Tests\TestCase;

class PrivacyPageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_privacy_page_loads_successfully(): void
    {
        $this->get('/privacy')->assertStatus(200);
    }

    public function test_privacy_page_contains_heading(): void
    {
        $this->get('/privacy')->assertSee('Privacybeleid');
    }

    public function test_privacy_page_contains_business_name(): void
    {
        $this->get('/privacy')->assertSee(config('site.name'));
    }

    public function test_privacy_page_contains_contact_email(): void
    {
        $this->get('/privacy')->assertSee(config('contact.email'));
    }

    public function test_privacy_page_contains_gdpr_rights(): void
    {
        $this->get('/privacy')->assertSee('Uw rechten');
    }

    public function test_privacy_page_has_back_to_home_link(): void
    {
        $this->get('/privacy')->assertSee('href="/"', false);
    }
}

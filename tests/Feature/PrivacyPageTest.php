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
        $this->get('/nl/privacy-policy')->assertStatus(200);
    }

    public function test_privacy_page_contains_nl_heading(): void
    {
        $this->get('/nl/privacy-policy')->assertSee('Privacybeleid');
    }

    public function test_privacy_page_contains_business_name(): void
    {
        $this->get('/nl/privacy-policy')->assertSee(config('site.name'));
    }

    public function test_privacy_page_contains_contact_email(): void
    {
        $this->get('/nl/privacy-policy')->assertSee(config('contact.email'));
    }

    public function test_privacy_page_contains_gdpr_rights(): void
    {
        $this->get('/nl/privacy-policy')->assertSee('Uw rechten');
    }

    public function test_privacy_page_has_back_to_home_link(): void
    {
        $this->get('/nl/privacy-policy')->assertSee('href="/nl"', false);
    }

    public function test_fr_privacy_page_loads(): void
    {
        $this->get('/fr/privacy-policy')->assertStatus(200);
    }

    public function test_en_privacy_page_loads(): void
    {
        $this->get('/en/privacy-policy')->assertStatus(200);
    }

    public function test_fr_privacy_page_contains_french_heading(): void
    {
        $this->get('/fr/privacy-policy')->assertSee('Politique de confidentialité');
    }

    public function test_en_privacy_page_contains_english_heading(): void
    {
        $this->get('/en/privacy-policy')->assertSee('Privacy Policy');
    }

    public function test_legacy_privacy_redirects_to_nl(): void
    {
        $this->get('/privacy')->assertRedirect('/nl/privacy-policy');
    }
}

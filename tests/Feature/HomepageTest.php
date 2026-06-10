<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomepageTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_homepage_loads_successfully(): void
    {
        $this->get('/')->assertStatus(200);
    }

    public function test_homepage_contains_business_name(): void
    {
        $this->get('/')->assertSee(config('site.name'));
    }

    public function test_homepage_contains_phone_number(): void
    {
        $this->get('/')->assertSee(config('site.phone'));
    }

    public function test_noindex_meta_rendered_when_enabled(): void
    {
        config(['seo.noindex' => true]);
        $this->get('/')->assertSee('<meta name="robots" content="noindex">', false);
    }

    public function test_gallery_section_hidden_when_disabled(): void
    {
        config(['site.sections.gallery' => false]);
        $this->get('/')->assertDontSee('id="gallery"', false);
    }

    public function test_homepage_contains_tagline(): void
    {
        $this->get('/')->assertSee(config('site.tagline'));
    }

    public function test_homepage_contains_nav_brand(): void
    {
        // Business name appears at minimum in the logo alt text or nav text
        $this->get('/')->assertSee(config('site.name'));
    }

    public function test_homepage_shows_logo_image_when_configured(): void
    {
        config(['images.logo' => 'assets/client/images/logo.png']);
        $this->get('/')->assertSee('logo.png', false);
    }

    public function test_homepage_shows_text_brand_when_logo_not_configured(): void
    {
        config(['images.logo' => null]);
        $this->get('/')->assertSee(config('site.nav_brand'));
    }

    public function test_reviews_section_visible_when_enabled(): void
    {
        config(['site.sections.reviews' => true, 'reviews.enabled' => true]);
        $this->get('/')->assertSee('id="reviews"', false);
    }

    public function test_reviews_section_hidden_when_disabled(): void
    {
        config(['site.sections.reviews' => false]);
        $this->get('/')->assertDontSee('id="reviews"', false);
    }

    public function test_wood_teaser_section_visible_when_enabled(): void
    {
        config(['site.sections.wood_teaser' => true]);
        $this->get('/')->assertSee('id="houtsoorten-teaser"', false);
    }

    public function test_wood_teaser_section_hidden_when_disabled(): void
    {
        config(['site.sections.wood_teaser' => false]);
        $this->get('/')->assertDontSee('id="houtsoorten-teaser"', false);
    }

    public function test_contact_cta_rendered_when_enabled(): void
    {
        config(['site.sections.contact_cta' => true]);
        $this->get('/')->assertSee('id="contact-cta"', false);
    }

    public function test_contact_cta_hidden_when_disabled(): void
    {
        config(['site.sections.contact_cta' => false]);
        $this->get('/')->assertDontSee('id="contact-cta"', false);
    }
}

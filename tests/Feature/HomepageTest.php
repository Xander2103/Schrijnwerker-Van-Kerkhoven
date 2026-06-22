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

    // ── Root redirect ────────────────────────────────────────────────────
    public function test_root_redirects_to_nl(): void
    {
        $this->get('/')->assertRedirect('/nl');
    }

    // ── Locale homepages ─────────────────────────────────────────────────
    public function test_nl_homepage_loads_successfully(): void
    {
        $this->get('/nl')->assertStatus(200);
    }

    public function test_fr_homepage_loads_successfully(): void
    {
        $this->get('/fr')->assertStatus(200);
    }

    public function test_en_homepage_loads_successfully(): void
    {
        $this->get('/en')->assertStatus(200);
    }

    public function test_homepage_contains_business_name(): void
    {
        $this->get('/nl')->assertSee(config('site.name'));
    }

    public function test_homepage_contains_nl_tagline(): void
    {
        $this->get('/nl')->assertSee('Schrijnwerk op maat');
    }

    public function test_homepage_contains_fr_tagline(): void
    {
        $this->get('/fr')->assertSee('Menuiserie sur mesure');
    }

    public function test_homepage_contains_en_tagline(): void
    {
        $this->get('/en')->assertSee('Custom joinery');
    }

    public function test_noindex_meta_rendered_when_enabled(): void
    {
        config(['seo.noindex' => true]);
        $this->get('/nl')->assertSee('<meta name="robots" content="noindex">', false);
    }

    public function test_gallery_section_hidden_when_disabled(): void
    {
        config(['site.sections.gallery' => false]);
        $this->get('/nl')->assertDontSee('id="gallery"', false);
    }

    public function test_homepage_contains_nav_brand(): void
    {
        $this->get('/nl')->assertSee(config('site.name'));
    }

    public function test_homepage_loads_with_logo_configured(): void
    {
        config(['images.logo' => 'assets/client/images/logo.png']);
        $this->get('/nl')->assertOk();
    }

    public function test_homepage_shows_nav_logo_when_header_logo_configured(): void
    {
        config(['images.logo_header' => 'assets/client/images/logo-header.png']);
        $this->get('/nl')->assertSee('logo-header.png', false);
    }

    public function test_homepage_shows_text_brand_when_logo_not_configured(): void
    {
        config(['images.logo' => null]);
        $this->get('/nl')->assertSee(config('site.nav_brand'));
    }

    public function test_reviews_section_visible_when_enabled(): void
    {
        config(['site.sections.reviews' => true, 'reviews.enabled' => true]);
        $this->get('/nl')->assertSee('id="reviews"', false);
    }

    public function test_reviews_section_hidden_when_disabled(): void
    {
        config(['site.sections.reviews' => false]);
        $this->get('/nl')->assertDontSee('id="reviews"', false);
    }

    public function test_wood_teaser_section_visible_when_enabled(): void
    {
        config(['site.sections.wood_teaser' => true]);
        $this->get('/nl')->assertSee('id="houtsoorten-teaser"', false);
    }

    public function test_wood_teaser_section_hidden_when_disabled(): void
    {
        config(['site.sections.wood_teaser' => false]);
        $this->get('/nl')->assertDontSee('id="houtsoorten-teaser"', false);
    }

    public function test_historisch_section_visible_when_enabled(): void
    {
        config(['site.sections.historisch' => true]);
        $this->get('/nl')->assertSee('id="historisch"', false);
    }

    public function test_historisch_section_hidden_when_disabled(): void
    {
        config(['site.sections.historisch' => false]);
        $this->get('/nl')->assertDontSee('id="historisch"', false);
    }

    public function test_contact_cta_rendered_when_enabled(): void
    {
        config(['site.sections.contact_cta' => true]);
        $this->get('/nl')->assertSee('id="contact-cta"', false);
    }

    public function test_contact_cta_hidden_when_disabled(): void
    {
        config(['site.sections.contact_cta' => false]);
        $this->get('/nl')->assertDontSee('id="contact-cta"', false);
    }

    public function test_footer_contains_vanmalderstudio_credit(): void
    {
        $this->get('/nl')
            ->assertSee('VanMalderStudio', false)
            ->assertSee('vanmalderstudio.be', false);
    }

    public function test_footer_credit_has_noopener_noreferrer(): void
    {
        $this->get('/nl')->assertSee('rel="noopener noreferrer"', false);
    }

    // ── Language switcher ────────────────────────────────────────────────
    public function test_nl_homepage_contains_language_switcher(): void
    {
        $this->get('/nl')
            ->assertSee('href="/fr"', false)
            ->assertSee('href="/en"', false);
    }

    public function test_fr_homepage_contains_language_switcher(): void
    {
        $this->get('/fr')
            ->assertSee('href="/nl"', false)
            ->assertSee('href="/en"', false);
    }

    // ── hreflang tags ────────────────────────────────────────────────────
    public function test_hreflang_tags_present_on_homepage(): void
    {
        $this->get('/nl')
            ->assertSee('hreflang="nl-BE"', false)
            ->assertSee('hreflang="fr-BE"', false)
            ->assertSee('hreflang="en"', false)
            ->assertSee('hreflang="x-default"', false);
    }

    // ── lang attribute ───────────────────────────────────────────────────
    public function test_html_lang_attribute_matches_locale(): void
    {
        $this->get('/nl')->assertSee('lang="nl"', false);
        $this->get('/fr')->assertSee('lang="fr"', false);
        $this->get('/en')->assertSee('lang="en"', false);
    }
}

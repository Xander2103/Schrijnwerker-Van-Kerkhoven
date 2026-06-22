<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LocaleRoutingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    // ── Root & locale homepages ──────────────────────────────────────────
    public function test_root_redirects_to_nl(): void
    {
        $this->get('/')->assertRedirect('/nl');
    }

    #[DataProvider('localeProvider')]
    public function test_locale_homepage_loads(string $locale): void
    {
        $this->get("/{$locale}")->assertStatus(200);
    }

    // ── Product pages per locale ─────────────────────────────────────────
    #[DataProvider('localeProvider')]
    public function test_locale_ramen_page_loads(string $locale): void
    {
        $this->get("/{$locale}/ramen")->assertStatus(200);
    }

    #[DataProvider('localeProvider')]
    public function test_locale_deuren_page_loads(string $locale): void
    {
        $this->get("/{$locale}/deuren")->assertStatus(200);
    }

    #[DataProvider('localeProvider')]
    public function test_locale_trappen_page_loads(string $locale): void
    {
        $this->get("/{$locale}/trappen")->assertStatus(200);
    }

    #[DataProvider('localeProvider')]
    public function test_locale_werkplaats_page_loads(string $locale): void
    {
        $this->get("/{$locale}/werkplaats")->assertStatus(200);
    }

    #[DataProvider('localeProvider')]
    public function test_locale_contact_page_loads(string $locale): void
    {
        $this->get("/{$locale}/contact")->assertStatus(200);
    }

    #[DataProvider('localeProvider')]
    public function test_locale_privacy_page_loads(string $locale): void
    {
        $this->get("/{$locale}/privacy-policy")->assertStatus(200);
    }

    // ── Invalid locale returns 404 ────────────────────────────────────────
    public function test_invalid_locale_returns_404(): void
    {
        $this->get('/de')->assertStatus(404);
    }

    public function test_invalid_locale_page_returns_404(): void
    {
        $this->get('/de/ramen')->assertStatus(404);
    }

    // ── Legacy redirects ─────────────────────────────────────────────────
    public function test_legacy_contact_redirects_permanently(): void
    {
        $this->get('/contact')->assertRedirect('/nl/contact')->assertStatus(301);
    }

    public function test_legacy_privacy_redirects_permanently(): void
    {
        $this->get('/privacy')->assertRedirect('/nl/privacy-policy')->assertStatus(301);
    }

    public function test_legacy_ramen_redirects_permanently(): void
    {
        $this->get('/ramen')->assertRedirect('/nl/ramen')->assertStatus(301);
    }

    public function test_legacy_deuren_redirects_permanently(): void
    {
        $this->get('/deuren')->assertRedirect('/nl/deuren')->assertStatus(301);
    }

    public function test_legacy_trappen_redirects_permanently(): void
    {
        $this->get('/trappen')->assertRedirect('/nl/trappen')->assertStatus(301);
    }

    public function test_legacy_werkplaats_redirects_permanently(): void
    {
        $this->get('/werkplaats')->assertRedirect('/nl/werkplaats')->assertStatus(301);
    }

    public function test_legacy_houtsoorten_redirects_permanently(): void
    {
        $this->get('/houtsoorten')->assertRedirect('/nl/werkplaats')->assertStatus(301);
    }

    public function test_legacy_werkhuis_redirects_permanently(): void
    {
        $this->get('/werkhuis')->assertRedirect('/nl/werkplaats')->assertStatus(301);
    }

    // ── Language switcher links per locale ───────────────────────────────
    public function test_nl_ramen_page_has_fr_switcher_link(): void
    {
        $this->get('/nl/ramen')->assertSee('href="/fr/ramen"', false);
    }

    public function test_nl_ramen_page_has_en_switcher_link(): void
    {
        $this->get('/nl/ramen')->assertSee('href="/en/ramen"', false);
    }

    public function test_fr_werkplaats_page_has_nl_switcher_link(): void
    {
        $this->get('/fr/werkplaats')->assertSee('href="/nl/werkplaats"', false);
    }

    public function test_en_contact_page_has_nl_switcher_link(): void
    {
        $this->get('/en/contact')->assertSee('href="/nl/contact"', false);
    }

    // ── hreflang tags on product pages ───────────────────────────────────
    public function test_ramen_page_has_hreflang_tags(): void
    {
        $this->get('/nl/ramen')
            ->assertSee('hreflang="nl-BE"', false)
            ->assertSee('hreflang="fr-BE"', false)
            ->assertSee('hreflang="en"', false)
            ->assertSee('hreflang="x-default"', false);
    }

    // ── lang HTML attribute ──────────────────────────────────────────────
    #[DataProvider('localeProvider')]
    public function test_html_lang_attribute_correct_on_locale_pages(string $locale): void
    {
        $this->get("/{$locale}/ramen")->assertSee("lang=\"{$locale}\"", false);
    }

    // ── Data provider ────────────────────────────────────────────────────
    public static function localeProvider(): array
    {
        return [
            'nl' => ['nl'],
            'fr' => ['fr'],
            'en' => ['en'],
        ];
    }
}

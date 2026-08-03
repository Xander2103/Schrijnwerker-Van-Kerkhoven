<?php

namespace Tests\Feature;

use DOMDocument;
use DOMXPath;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    private const DOMAIN = 'https://schrijnwerkerijvankerkhoven.be';

    protected function setUp(): void
    {
        parent::setUp();
        config(['app.url' => self::DOMAIN]);
    }

    private function sitemapContent(): string
    {
        return $this->get('/sitemap.xml')->getContent();
    }

    private function dom(): DOMDocument
    {
        $dom = new DOMDocument();
        $this->assertTrue(
            $dom->loadXML($this->sitemapContent()),
            'Sitemap response is not well-formed XML.'
        );

        return $dom;
    }

    private function xpath(): DOMXPath
    {
        $xpath = new DOMXPath($this->dom());
        $xpath->registerNamespace('sm', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xpath->registerNamespace('xhtml', 'http://www.w3.org/1999/xhtml');

        return $xpath;
    }

    /** @return array<int, string> */
    private function locs(): array
    {
        $locs = [];

        foreach ($this->xpath()->query('/sm:urlset/sm:url/sm:loc') as $loc) {
            $locs[] = $loc->textContent;
        }

        return $locs;
    }

    // ── Response basics ────────────────────────────────────────────────────
    public function test_sitemap_returns_200_with_xml_content_type(): void
    {
        $this->get('/sitemap.xml')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function test_sitemap_starts_with_exact_xml_declaration_without_bom_or_leading_output(): void
    {
        $content = $this->sitemapContent();

        $this->assertStringStartsWith('<?xml version="1.0" encoding="UTF-8"?>', $content);
        $this->assertStringNotContainsString("\xEF\xBB\xBF", $content);
    }

    // ── Structure ──────────────────────────────────────────────────────────
    public function test_sitemap_is_valid_xml_with_urlset_root_and_namespaces(): void
    {
        $root = $this->dom()->documentElement;

        $this->assertSame('urlset', $root->localName);
        $this->assertSame('http://www.sitemaps.org/schemas/sitemap/0.9', $root->namespaceURI);
        $this->assertSame('http://www.w3.org/1999/xhtml', $root->getAttribute('xmlns:xhtml'));
    }

    /**
     * The count is derived, not hard-coded, because projects are added and
     * removed through config alone: 9 static + 6 regions + 7 services + the
     * realisation index + one entry per published project, each in nl/fr/en.
     */
    public function test_url_count_matches_the_configured_pages(): void
    {
        $expected = (
            9
            + count(config('regions.items'))
            + count(config('service-pages.items'))
            + 1
            + count(\App\Support\Projects::published())
        ) * 3;

        $this->assertCount($expected, $this->xpath()->query('/sm:urlset/sm:url'));
        $this->assertCount($expected, $this->xpath()->query('/sm:urlset/sm:url/sm:loc'));
    }

    public function test_every_url_uses_the_production_domain(): void
    {
        foreach ($this->xpath()->query('/sm:urlset/sm:url/sm:loc') as $loc) {
            $this->assertStringStartsWith(self::DOMAIN . '/', $loc->textContent);
        }

        $content = $this->sitemapContent();
        $this->assertStringNotContainsString('localhost', $content);
        $this->assertStringNotContainsString('127.0.0.1', $content);
    }

    public function test_every_url_has_hreflang_alternates_for_all_locales_and_x_default(): void
    {
        $xpath = $this->xpath();

        foreach ($xpath->query('/sm:urlset/sm:url') as $url) {
            $links = $xpath->query('xhtml:link[@rel="alternate"]', $url);
            $this->assertSame(4, $links->count());

            $hreflangs = [];
            foreach ($links as $link) {
                $hreflangs[] = $link->getAttribute('hreflang');
                $this->assertStringStartsWith(self::DOMAIN . '/', $link->getAttribute('href'));
            }

            sort($hreflangs);
            $this->assertSame(['en', 'fr-BE', 'nl-BE', 'x-default'], $hreflangs);
        }
    }

    public function test_locale_specific_slugs_are_preserved(): void
    {
        $locs = [];
        foreach ($this->xpath()->query('/sm:urlset/sm:url/sm:loc') as $loc) {
            $locs[] = $loc->textContent;
        }

        $this->assertContains(self::DOMAIN . '/nl/poorten', $locs);
        $this->assertContains(self::DOMAIN . '/fr/portails', $locs);
        $this->assertContains(self::DOMAIN . '/en/gates', $locs);
        $this->assertContains(self::DOMAIN . '/nl/schuiframen', $locs);
        $this->assertContains(self::DOMAIN . '/fr/coulissants', $locs);
        $this->assertContains(self::DOMAIN . '/en/sliding-windows', $locs);

        // Cross-locale slug mixups must not appear.
        $this->assertNotContains(self::DOMAIN . '/fr/poorten', $locs);
        $this->assertNotContains(self::DOMAIN . '/en/portails', $locs);
    }

    public function test_every_region_page_is_listed_in_every_locale(): void
    {
        $locs = $this->locs();

        foreach (config('regions.items') as $key => $region) {
            foreach (['nl', 'fr', 'en'] as $locale) {
                $this->assertContains(
                    self::DOMAIN . '/' . $locale . '/' . $region['slugs'][$locale],
                    $locs,
                    "Missing {$locale} sitemap entry for {$key}."
                );
            }
        }
    }

    public function test_every_service_page_is_listed_in_every_locale(): void
    {
        $locs = $this->locs();

        foreach (config('service-pages.items') as $key => $service) {
            foreach (['nl', 'fr', 'en'] as $locale) {
                $this->assertContains(
                    self::DOMAIN . '/' . $locale . '/' . $service['slugs'][$locale],
                    $locs,
                    "Missing {$locale} sitemap entry for {$key}."
                );
            }
        }
    }

    public function test_service_slugs_never_appear_under_the_wrong_locale(): void
    {
        $locs = $this->locs();

        foreach (config('service-pages.items') as $service) {
            foreach (['nl', 'fr', 'en'] as $urlLocale) {
                foreach (['nl', 'fr', 'en'] as $slugLocale) {
                    if ($urlLocale === $slugLocale || $service['slugs'][$urlLocale] === $service['slugs'][$slugLocale]) {
                        continue;
                    }

                    $this->assertNotContains(
                        self::DOMAIN . '/' . $urlLocale . '/' . $service['slugs'][$slugLocale],
                        $locs
                    );
                }
            }
        }
    }

    public function test_region_slugs_never_appear_under_the_wrong_locale(): void
    {
        $locs = $this->locs();

        foreach (config('regions.items') as $region) {
            foreach (['nl', 'fr', 'en'] as $urlLocale) {
                foreach (['nl', 'fr', 'en'] as $slugLocale) {
                    if ($urlLocale === $slugLocale) {
                        continue;
                    }

                    $this->assertNotContains(
                        self::DOMAIN . '/' . $urlLocale . '/' . $region['slugs'][$slugLocale],
                        $locs
                    );
                }
            }
        }
    }

    public function test_every_sitemap_url_actually_resolves(): void
    {
        $this->withoutVite();

        foreach ($this->locs() as $loc) {
            $path = parse_url($loc, PHP_URL_PATH);
            $this->get($path)->assertStatus(200);
        }
    }

    public function test_realisation_index_is_listed_in_every_locale(): void
    {
        $locs = $this->locs();

        foreach (['nl' => 'realisaties', 'fr' => 'realisations', 'en' => 'projects'] as $locale => $slug) {
            $this->assertContains(self::DOMAIN . '/' . $locale . '/' . $slug, $locs);
        }
    }

    public function test_only_published_projects_are_listed(): void
    {
        $locs = $this->locs();

        foreach (config('projects.items') as $key => $project) {
            $published = ($project['status'] ?? 'draft') === 'published';

            foreach (['nl', 'fr', 'en'] as $locale) {
                $url = self::DOMAIN . '/' . $locale . '/'
                    . config("projects.index_slugs.{$locale}") . '/' . $project['slugs'][$locale];

                $published
                    ? $this->assertContains($url, $locs, "Published project {$key} missing from the sitemap.")
                    : $this->assertNotContains($url, $locs, "Draft project {$key} must not reach the sitemap.");
            }
        }
    }

    public function test_no_draft_slug_appears_anywhere_in_the_sitemap(): void
    {
        $content = $this->sitemapContent();

        foreach (config('projects.items') as $project) {
            if (($project['status'] ?? 'draft') === 'published') {
                continue;
            }

            foreach ($project['slugs'] as $slug) {
                $this->assertStringNotContainsString($slug, $content);
            }
        }
    }

    public function test_sitemap_contains_no_technical_or_form_routes(): void
    {
        $content = $this->sitemapContent();

        $this->assertStringNotContainsString('sitemap.xml</loc>', $content);
        $this->assertStringNotContainsString('/admin', $content);
        $this->assertStringNotContainsString('/login', $content);
    }

    public function test_all_sitemap_urls_are_unique(): void
    {
        $locs = [];
        foreach ($this->xpath()->query('/sm:urlset/sm:url/sm:loc') as $loc) {
            $locs[] = $loc->textContent;
        }

        $this->assertSame($locs, array_values(array_unique($locs)));
    }
}

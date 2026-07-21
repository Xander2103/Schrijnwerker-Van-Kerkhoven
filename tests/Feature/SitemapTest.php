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

    public function test_sitemap_contains_exactly_27_urls_each_with_a_loc(): void
    {
        $xpath = $this->xpath();

        $this->assertCount(27, $xpath->query('/sm:urlset/sm:url'));
        $this->assertCount(27, $xpath->query('/sm:urlset/sm:url/sm:loc'));
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

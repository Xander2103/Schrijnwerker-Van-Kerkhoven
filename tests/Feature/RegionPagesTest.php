<?php

namespace Tests\Feature;

use App\Support\Regions;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class RegionPagesTest extends TestCase
{
    private const DOMAIN = 'https://schrijnwerkerijvankerkhoven.be';

    private const EXPECTED_KEYS = [
        'huldenberg', 'overijse', 'hoeilaart', 'tervuren', 'bertem', 'leuven',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        config(['app.url' => self::DOMAIN]);
    }

    private function url(string $key, string $locale): string
    {
        return '/' . $locale . '/' . config("regions.items.{$key}.slugs.{$locale}");
    }

    private function html(string $key, string $locale): string
    {
        return $this->get($this->url($key, $locale))->getContent();
    }

    /** Pull every <script type="application/ld+json"> payload off a page. */
    private function jsonLdBlocks(string $html): array
    {
        preg_match_all(
            '#<script type="application/ld\+json">(.*?)</script>#s',
            $html,
            $matches
        );

        return array_map('trim', $matches[1]);
    }

    // ── Config sanity ─────────────────────────────────────────────────────
    public function test_all_six_regions_are_configured(): void
    {
        $this->assertSame(self::EXPECTED_KEYS, array_keys(Regions::all()));
    }

    public function test_every_region_has_a_distinct_slug_in_every_locale(): void
    {
        $slugs = Regions::allSlugs();

        $this->assertCount(18, $slugs, 'Expected 6 regions × 3 locales = 18 distinct slugs.');
        $this->assertSame($slugs, array_values(array_unique($slugs)));
    }

    // ── Routes ────────────────────────────────────────────────────────────
    #[DataProvider('regionLocaleProvider')]
    public function test_region_page_returns_200(string $key, string $locale): void
    {
        $this->get($this->url($key, $locale))->assertStatus(200);
    }

    public function test_nl_slugs_match_the_agreed_urls(): void
    {
        foreach (self::EXPECTED_KEYS as $key) {
            $this->assertSame(
                '/nl/schrijnwerker-' . $key,
                $this->url($key, 'nl')
            );
        }
    }

    public function test_unknown_region_returns_404(): void
    {
        $this->get('/nl/schrijnwerker-brussel')->assertStatus(404);
    }

    public function test_slug_from_another_locale_returns_404(): void
    {
        // /nl/menuisier-leuven and /en/schrijnwerker-leuven must not resolve —
        // otherwise the same page would be indexable under three URLs per language.
        $this->get('/nl/menuisier-leuven')->assertStatus(404);
        $this->get('/en/schrijnwerker-leuven')->assertStatus(404);
        $this->get('/fr/carpenter-bertem')->assertStatus(404);
    }

    public function test_invalid_locale_on_region_route_returns_404(): void
    {
        $this->get('/de/schrijnwerker-leuven')->assertStatus(404);
    }

    public function test_existing_routes_still_resolve(): void
    {
        $this->get('/nl/ramen')->assertStatus(200);
        $this->get('/fr/portails')->assertStatus(200);
        $this->get('/en/sliding-windows')->assertStatus(200);
        $this->get('/nl/werkplaats')->assertStatus(200);
        $this->get('/nl/contact')->assertStatus(200);
    }

    // ── Locale switching ──────────────────────────────────────────────────
    #[DataProvider('regionProvider')]
    public function test_locale_switcher_points_at_the_translated_slug(string $key): void
    {
        $html = $this->html($key, 'nl');

        $this->assertStringContainsString('href="' . $this->url($key, 'fr') . '"', $html);
        $this->assertStringContainsString('href="' . $this->url($key, 'en') . '"', $html);
    }

    #[DataProvider('regionLocaleProvider')]
    public function test_html_lang_attribute_matches_the_locale(string $key, string $locale): void
    {
        $this->assertStringContainsString(
            'lang="' . $locale . '"',
            $this->html($key, $locale)
        );
    }

    // ── SEO ───────────────────────────────────────────────────────────────
    #[DataProvider('localeProvider')]
    public function test_titles_are_unique_per_region(string $locale): void
    {
        $titles = [];

        foreach (self::EXPECTED_KEYS as $key) {
            preg_match('#<title>(.*?)</title>#s', $this->html($key, $locale), $m);
            $this->assertNotEmpty($m[1] ?? '', "No <title> on the {$key} page ({$locale}).");
            $titles[] = trim($m[1]);
        }

        $this->assertSame($titles, array_values(array_unique($titles)));
    }

    #[DataProvider('localeProvider')]
    public function test_meta_descriptions_are_unique_per_region(string $locale): void
    {
        $descriptions = [];

        foreach (self::EXPECTED_KEYS as $key) {
            preg_match('#<meta name="description" content="(.*?)">#s', $this->html($key, $locale), $m);
            $this->assertNotEmpty($m[1] ?? '', "No meta description on the {$key} page ({$locale}).");
            $descriptions[] = trim($m[1]);
        }

        $this->assertSame($descriptions, array_values(array_unique($descriptions)));
    }

    public function test_titles_and_descriptions_do_not_collide_with_the_homepage(): void
    {
        preg_match('#<title>(.*?)</title>#s', $this->get('/nl')->getContent(), $home);

        foreach (self::EXPECTED_KEYS as $key) {
            preg_match('#<title>(.*?)</title>#s', $this->html($key, 'nl'), $region);
            $this->assertNotSame(trim($home[1]), trim($region[1]));
        }
    }

    #[DataProvider('regionLocaleProvider')]
    public function test_canonical_points_at_the_current_locale_version(string $key, string $locale): void
    {
        $this->assertStringContainsString(
            '<link rel="canonical" href="' . self::DOMAIN . $this->url($key, $locale) . '">',
            $this->html($key, $locale)
        );
    }

    #[DataProvider('regionProvider')]
    public function test_hreflang_alternates_are_reciprocal(string $key): void
    {
        $map = ['nl' => 'nl-BE', 'fr' => 'fr-BE', 'en' => 'en'];

        foreach (array_keys($map) as $locale) {
            $html = $this->html($key, $locale);

            foreach ($map as $altLocale => $hreflang) {
                $this->assertStringContainsString(
                    '<link rel="alternate" hreflang="' . $hreflang . '" href="'
                        . self::DOMAIN . $this->url($key, $altLocale) . '">',
                    $html,
                    "Missing {$hreflang} alternate on the {$locale} {$key} page."
                );
            }

            $this->assertStringContainsString(
                '<link rel="alternate" hreflang="x-default" href="'
                    . self::DOMAIN . $this->url($key, 'nl') . '">',
                $html
            );
        }
    }

    #[DataProvider('regionLocaleProvider')]
    public function test_no_preview_or_local_domain_leaks_into_the_page(string $key, string $locale): void
    {
        $html = $this->html($key, $locale);

        $this->assertStringNotContainsString('localhost', $html);
        $this->assertStringNotContainsString('127.0.0.1', $html);
        $this->assertStringNotContainsString('<meta name="robots" content="noindex">', $html);
    }

    #[DataProvider('regionLocaleProvider')]
    public function test_page_has_exactly_one_h1(string $key, string $locale): void
    {
        $this->assertSame(
            1,
            preg_match_all('#<h1[\s>]#', $this->html($key, $locale)),
            "Expected exactly one <h1> on the {$key} page ({$locale})."
        );
    }

    #[DataProvider('regionLocaleProvider')]
    public function test_h1_names_the_municipality(string $key, string $locale): void
    {
        preg_match('#<h1[^>]*>(.*?)</h1>#s', $this->html($key, $locale), $m);

        $this->assertStringContainsString(
            Regions::name($key, $locale),
            $m[1] ?? '',
            "The <h1> on the {$key} page ({$locale}) does not name the municipality."
        );
    }

    #[DataProvider('regionLocaleProvider')]
    public function test_open_graph_and_twitter_metadata_are_present(string $key, string $locale): void
    {
        $html = $this->html($key, $locale);
        $url  = self::DOMAIN . $this->url($key, $locale);

        $this->assertStringContainsString('<meta property="og:title" content="', $html);
        $this->assertStringContainsString('<meta property="og:description" content="', $html);
        $this->assertStringContainsString('<meta property="og:url" content="' . $url . '">', $html);
        $this->assertStringContainsString('<meta property="og:image" content="', $html);
        $this->assertStringContainsString('<meta name="twitter:card" content="summary_large_image">', $html);
        $this->assertStringContainsString('<meta name="twitter:image" content="', $html);
    }

    public function test_regions_do_not_all_share_the_same_og_image(): void
    {
        $images = [];

        foreach (self::EXPECTED_KEYS as $key) {
            preg_match('#<meta property="og:image" content="(.*?)">#', $this->html($key, 'nl'), $m);
            $images[] = $m[1] ?? '';
        }

        $this->assertCount(6, array_unique($images), 'Each region should get its own hero image.');
    }

    // ── Structured data ───────────────────────────────────────────────────
    #[DataProvider('regionLocaleProvider')]
    public function test_all_json_ld_blocks_parse_as_valid_json(string $key, string $locale): void
    {
        $blocks = $this->jsonLdBlocks($this->html($key, $locale));

        $this->assertGreaterThanOrEqual(2, count($blocks), 'Expected the sitewide Carpenter block plus the page graph.');

        foreach ($blocks as $block) {
            $decoded = json_decode($block, true);
            $this->assertSame(
                JSON_ERROR_NONE,
                json_last_error(),
                "Invalid JSON-LD on the {$key} page ({$locale}): " . json_last_error_msg()
            );
            $this->assertIsArray($decoded);
        }
    }

    #[DataProvider('regionLocaleProvider')]
    public function test_breadcrumb_list_is_present_and_well_formed(string $key, string $locale): void
    {
        $graph = $this->pageGraph($key, $locale);
        $node  = $this->graphNode($graph, 'BreadcrumbList');

        $this->assertNotNull($node, "No BreadcrumbList on the {$key} page ({$locale}).");
        $this->assertCount(3, $node['itemListElement']);

        foreach ($node['itemListElement'] as $i => $item) {
            $this->assertSame('ListItem', $item['@type']);
            $this->assertSame($i + 1, $item['position']);
            $this->assertNotEmpty($item['name']);
        }

        // The trail ends on the page itself, which carries no link.
        $this->assertArrayNotHasKey('item', $node['itemListElement'][2]);
        $this->assertSame(self::DOMAIN . '/' . $locale, $node['itemListElement'][0]['item']);
    }

    #[DataProvider('regionLocaleProvider')]
    public function test_faq_page_schema_matches_the_visible_faq(string $key, string $locale): void
    {
        $node = $this->graphNode($this->pageGraph($key, $locale), 'FAQPage');

        $this->assertNotNull($node, "No FAQPage on the {$key} page ({$locale}).");
        $this->assertGreaterThanOrEqual(4, count($node['mainEntity']));
        $this->assertLessThanOrEqual(6, count($node['mainEntity']));

        $html = $this->html($key, $locale);

        foreach ($node['mainEntity'] as $question) {
            $this->assertSame('Question', $question['@type']);
            $this->assertSame('Answer', $question['acceptedAnswer']['@type']);
            $this->assertNotEmpty($question['acceptedAnswer']['text']);
            $this->assertStringContainsString(e($question['name']), $html);
        }
    }

    #[DataProvider('regionLocaleProvider')]
    public function test_webpage_node_matches_the_canonical_url(string $key, string $locale): void
    {
        $node = $this->graphNode($this->pageGraph($key, $locale), 'WebPage');
        $url  = self::DOMAIN . $this->url($key, $locale);

        $this->assertNotNull($node);
        $this->assertSame($url, $node['@id']);
        $this->assertSame($url, $node['url']);
        $this->assertNotEmpty($node['description']);
    }

    public function test_no_second_local_business_node_is_emitted(): void
    {
        $graph = $this->pageGraph('leuven', 'nl');
        $types = array_column($graph['@graph'], '@type');

        $this->assertNotContains('LocalBusiness', $types);
        $this->assertNotContains('Carpenter', $types);
        $this->assertStringNotContainsString('aggregateRating', json_encode($graph));
        $this->assertStringNotContainsString('openingHours', json_encode($graph));
    }

    // ── Visible breadcrumbs ───────────────────────────────────────────────
    #[DataProvider('regionLocaleProvider')]
    public function test_visible_breadcrumbs_are_rendered_and_labelled(string $key, string $locale): void
    {
        $html = $this->html($key, $locale);

        $this->assertStringContainsString('class="breadcrumbs"', $html);
        $this->assertStringContainsString('aria-current="page"', $html);
        $this->assertStringContainsString('href="/' . $locale . '"', $html);
        $this->assertStringContainsString('href="/' . $locale . '#werkregio"', $html);
    }

    // ── Internal links ────────────────────────────────────────────────────
    #[DataProvider('regionLocaleProvider')]
    public function test_page_links_to_contact_and_every_service(string $key, string $locale): void
    {
        $html = $this->html($key, $locale);

        $this->assertStringContainsString('href="/' . $locale . '/contact"', $html);

        foreach (config('service-pages.core') as $service) {
            $this->assertStringContainsString(
                'href="/' . $locale . '/' . $service['slugs'][$locale] . '"',
                $html,
                "The {$key} page ({$locale}) does not link to {$service['key']}."
            );
        }
    }

    #[DataProvider('regionProvider')]
    public function test_page_links_to_the_other_five_regions(string $key): void
    {
        $html = $this->html($key, 'nl');

        foreach (self::EXPECTED_KEYS as $other) {
            if ($other === $key) {
                continue;
            }

            $this->assertStringContainsString('href="' . $this->url($other, 'nl') . '"', $html);
        }
    }

    #[DataProvider('localeProvider')]
    public function test_regions_are_reachable_from_the_homepage(string $locale): void
    {
        $html = $this->get('/' . $locale)->getContent();

        $this->assertStringContainsString('id="werkregio"', $html);

        foreach (self::EXPECTED_KEYS as $key) {
            $this->assertStringContainsString('href="' . $this->url($key, $locale) . '"', $html);
        }
    }

    #[DataProvider('localeProvider')]
    public function test_regions_are_reachable_from_the_contact_page(string $locale): void
    {
        $html = $this->get('/' . $locale . '/contact')->getContent();

        foreach (self::EXPECTED_KEYS as $key) {
            $this->assertStringContainsString('href="' . $this->url($key, $locale) . '"', $html);
        }
    }

    // ── Content ───────────────────────────────────────────────────────────
    #[DataProvider('regionLocaleProvider')]
    public function test_page_carries_a_substantial_amount_of_copy(string $key, string $locale): void
    {
        $words = str_word_count($this->visibleText($key, $locale), 0, 'áàâäéèêëíìîïóòôöúùûüçñÁÉÍÓÚäöüÄÖÜ');

        $this->assertGreaterThan(
            700,
            $words,
            "The {$key} page ({$locale}) only has {$words} words of visible copy."
        );
    }

    #[DataProvider('localeProvider')]
    public function test_region_copy_is_not_duplicated_across_regions(string $locale): void
    {
        $texts = [];

        foreach (self::EXPECTED_KEYS as $key) {
            $texts[$key] = $this->visibleText($key, $locale);
        }

        foreach (self::EXPECTED_KEYS as $a) {
            foreach (self::EXPECTED_KEYS as $b) {
                if ($a >= $b) {
                    continue;
                }

                $this->assertNotSame($texts[$a], $texts[$b], "{$a} and {$b} ({$locale}) render identical copy.");
            }
        }
    }

    #[DataProvider('regionLocaleProvider')]
    public function test_intro_and_faq_copy_is_translated_for_every_locale(string $key, string $locale): void
    {
        // A missing key would render as "regions.items.x.intro" instead of text.
        $this->assertStringNotContainsString('regions.items.', $this->html($key, $locale));
        $this->assertStringNotContainsString('regions.common.', $this->html($key, $locale));
    }

    #[DataProvider('regionProvider')]
    public function test_each_locale_carries_comparable_content_volume(string $key): void
    {
        $counts = [];

        foreach (['nl', 'fr', 'en'] as $locale) {
            $counts[$locale] = str_word_count($this->visibleText($key, $locale));
        }

        // No language may be a stub relative to the others.
        $this->assertGreaterThan(
            0.7 * max($counts),
            min($counts),
            "Content volume for {$key} differs too much between languages: " . json_encode($counts)
        );
    }

    // ── Images ────────────────────────────────────────────────────────────
    #[DataProvider('regionProvider')]
    public function test_gallery_images_are_lazy_loaded_and_have_alt_text(string $key): void
    {
        preg_match_all('#<img[^>]*>#', $this->html($key, 'nl'), $m);

        $galleryTags = array_values(array_filter(
            $m[0],
            static fn (string $tag): bool => str_contains($tag, 'loading="lazy"')
        ));

        $this->assertNotEmpty($galleryTags, "No lazy-loaded gallery images on the {$key} page.");

        foreach ($galleryTags as $tag) {
            $this->assertMatchesRegularExpression('#alt="[^"]+"#', $tag);
        }
    }

    public function test_hero_image_is_not_lazy_loaded(): void
    {
        // The hero is a CSS background on .page-hero--image, so it can never be
        // lazy-loaded — assert the element is actually rendered that way.
        $this->assertStringContainsString(
            'class="page-hero page-hero--image region-hero"',
            $this->html('huldenberg', 'nl')
        );
    }

    public function test_every_configured_hero_image_exists_on_disk(): void
    {
        foreach (Regions::all() as $key => $region) {
            $this->assertFileExists(
                public_path($region['hero']),
                "Hero image for {$key} is missing."
            );
        }
    }

    // ── Helpers ───────────────────────────────────────────────────────────
    private function visibleText(string $key, string $locale): string
    {
        $html = $this->html($key, $locale);
        $html = preg_replace('#<(script|style)\b[^>]*>.*?</\1>#s', ' ', $html);

        return trim(preg_replace('#\s+#u', ' ', strip_tags($html)));
    }

    /** The @graph published by pages/regio.blade.php (not the sitewide block). */
    private function pageGraph(string $key, string $locale): array
    {
        foreach ($this->jsonLdBlocks($this->html($key, $locale)) as $block) {
            $decoded = json_decode($block, true);

            if (isset($decoded['@graph'])) {
                return $decoded;
            }
        }

        $this->fail("No @graph JSON-LD block on the {$key} page ({$locale}).");
    }

    private function graphNode(array $graph, string $type): ?array
    {
        foreach ($graph['@graph'] as $node) {
            if (($node['@type'] ?? null) === $type) {
                return $node;
            }
        }

        return null;
    }

    // ── Data providers ────────────────────────────────────────────────────
    public static function regionProvider(): array
    {
        $cases = [];

        foreach (self::EXPECTED_KEYS as $key) {
            $cases[$key] = [$key];
        }

        return $cases;
    }

    public static function localeProvider(): array
    {
        return ['nl' => ['nl'], 'fr' => ['fr'], 'en' => ['en']];
    }

    public static function regionLocaleProvider(): array
    {
        $cases = [];

        foreach (self::EXPECTED_KEYS as $key) {
            foreach (['nl', 'fr', 'en'] as $locale) {
                $cases["{$key} ({$locale})"] = [$key, $locale];
            }
        }

        return $cases;
    }
}

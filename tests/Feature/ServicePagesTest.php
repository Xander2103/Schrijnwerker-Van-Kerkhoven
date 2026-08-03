<?php

namespace Tests\Feature;

use App\Support\ServicePages;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ServicePagesTest extends TestCase
{
    private const DOMAIN = 'https://schrijnwerkerijvankerkhoven.be';

    private const EXPECTED_KEYS = [
        'binnendeuren', 'buitendeuren', 'houten-ramen', 'aluminium-ramen',
        'garagepoorten', 'maatkasten', 'gevelbekleding',
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        config(['app.url' => self::DOMAIN]);
    }

    private function url(string $key, string $locale): string
    {
        return '/' . $locale . '/' . config("service-pages.items.{$key}.slugs.{$locale}");
    }

    private function html(string $key, string $locale): string
    {
        return $this->get($this->url($key, $locale))->getContent();
    }

    private function jsonLdBlocks(string $html): array
    {
        preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $html, $matches);

        return array_map('trim', $matches[1]);
    }

    // ── Config sanity ─────────────────────────────────────────────────────
    public function test_all_seven_services_are_configured(): void
    {
        $this->assertSame(self::EXPECTED_KEYS, array_keys(ServicePages::all()));
    }

    public function test_every_service_has_a_distinct_slug_in_every_locale(): void
    {
        $slugs = ServicePages::allSlugs();

        $this->assertCount(21, $slugs, 'Expected 7 services × 3 locales = 21 distinct slugs.');
        $this->assertSame($slugs, array_values(array_unique($slugs)));
    }

    public function test_service_slugs_do_not_collide_with_region_slugs(): void
    {
        $this->assertSame(
            [],
            array_intersect(ServicePages::allSlugs(), \App\Support\Regions::allSlugs())
        );
    }

    public function test_service_slugs_do_not_collide_with_existing_page_slugs(): void
    {
        $existing = [];

        foreach (config('service-pages.core') as $page) {
            $existing = [...$existing, ...array_values($page['slugs'])];
        }

        $existing = [...$existing, 'contact', 'privacy-policy'];

        $this->assertSame([], array_intersect(ServicePages::allSlugs(), $existing));
    }

    // ── Routes ────────────────────────────────────────────────────────────
    #[DataProvider('serviceLocaleProvider')]
    public function test_service_page_returns_200(string $key, string $locale): void
    {
        $this->get($this->url($key, $locale))->assertStatus(200);
    }

    public function test_nl_slugs_match_the_agreed_urls(): void
    {
        $expected = [
            'binnendeuren'    => '/nl/binnendeuren',
            'buitendeuren'    => '/nl/buitendeuren',
            'houten-ramen'    => '/nl/houten-ramen',
            'aluminium-ramen' => '/nl/aluminium-ramen',
            'garagepoorten'   => '/nl/garagepoorten',
            'maatkasten'      => '/nl/maatkasten',
            'gevelbekleding'  => '/nl/gevelbekleding',
        ];

        foreach ($expected as $key => $url) {
            $this->assertSame($url, $this->url($key, 'nl'));
        }
    }

    public function test_unknown_service_returns_404(): void
    {
        $this->get('/nl/rolluiken')->assertStatus(404);
        $this->get('/nl/dakramen')->assertStatus(404);
    }

    public function test_slug_from_another_locale_returns_404(): void
    {
        $this->get('/nl/interior-doors')->assertStatus(404);
        $this->get('/en/binnendeuren')->assertStatus(404);
        $this->get('/fr/garagepoorten')->assertStatus(404);
        $this->get('/nl/bardage-de-facade')->assertStatus(404);
    }

    public function test_invalid_locale_on_service_route_returns_404(): void
    {
        $this->get('/de/binnendeuren')->assertStatus(404);
    }

    public function test_no_route_conflicts_with_existing_or_region_pages(): void
    {
        $this->get('/nl/ramen')->assertStatus(200);
        $this->get('/nl/deuren')->assertStatus(200);
        $this->get('/nl/poorten')->assertStatus(200);
        $this->get('/fr/portails')->assertStatus(200);
        $this->get('/en/sliding-windows')->assertStatus(200);
        $this->get('/nl/werkplaats')->assertStatus(200);
        $this->get('/nl/contact')->assertStatus(200);
        $this->get('/nl/schrijnwerker-leuven')->assertStatus(200);
        $this->get('/fr/menuisier-huldenberg')->assertStatus(200);
    }

    // ── Locale switching ──────────────────────────────────────────────────
    #[DataProvider('serviceProvider')]
    public function test_locale_switcher_points_at_the_translated_slug(string $key): void
    {
        $html = $this->html($key, 'nl');

        $this->assertStringContainsString('href="' . $this->url($key, 'fr') . '"', $html);
        $this->assertStringContainsString('href="' . $this->url($key, 'en') . '"', $html);
    }

    #[DataProvider('serviceLocaleProvider')]
    public function test_html_lang_attribute_matches_the_locale(string $key, string $locale): void
    {
        $this->assertStringContainsString('lang="' . $locale . '"', $this->html($key, $locale));
    }

    // ── SEO ───────────────────────────────────────────────────────────────
    #[DataProvider('localeProvider')]
    public function test_titles_are_unique_per_service(string $locale): void
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
    public function test_meta_descriptions_are_unique_per_service(string $locale): void
    {
        $descriptions = [];

        foreach (self::EXPECTED_KEYS as $key) {
            preg_match('#<meta name="description" content="(.*?)">#s', $this->html($key, $locale), $m);
            $this->assertNotEmpty($m[1] ?? '', "No meta description on the {$key} page ({$locale}).");
            $descriptions[] = trim($m[1]);
        }

        $this->assertSame($descriptions, array_values(array_unique($descriptions)));
    }

    /**
     * The deeper pages must not compete with the main pages they sit under —
     * see the anti-cannibalisation note in lang/{locale}/pages.php.
     */
    #[DataProvider('localeProvider')]
    public function test_no_title_or_h1_collides_with_an_existing_page(string $locale): void
    {
        $existing = [];

        foreach (['', '/ramen', '/deuren', '/trappen', '/werkplaats', '/contact'] as $path) {
            $html = $this->get('/' . $locale . $path)->getContent();
            preg_match('#<title>(.*?)</title>#s', $html, $t);
            preg_match('#<h1[^>]*>(.*?)</h1>#s', $html, $h);
            $existing['title'][] = trim($t[1] ?? '');
            $existing['h1'][]    = trim(strip_tags($h[1] ?? ''));
        }

        foreach (self::EXPECTED_KEYS as $key) {
            $html = $this->html($key, $locale);
            preg_match('#<title>(.*?)</title>#s', $html, $t);
            preg_match('#<h1[^>]*>(.*?)</h1>#s', $html, $h);

            $this->assertNotContains(trim($t[1]), $existing['title'], "Title of {$key} ({$locale}) duplicates an existing page.");
            $this->assertNotContains(trim(strip_tags($h[1])), $existing['h1'], "H1 of {$key} ({$locale}) duplicates an existing page.");
        }
    }

    #[DataProvider('serviceLocaleProvider')]
    public function test_canonical_points_at_the_current_locale_version(string $key, string $locale): void
    {
        $this->assertStringContainsString(
            '<link rel="canonical" href="' . self::DOMAIN . $this->url($key, $locale) . '">',
            $this->html($key, $locale)
        );
    }

    #[DataProvider('serviceProvider')]
    public function test_hreflang_alternates_are_reciprocal_with_x_default_to_nl(string $key): void
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

    #[DataProvider('serviceLocaleProvider')]
    public function test_page_has_exactly_one_h1(string $key, string $locale): void
    {
        $this->assertSame(
            1,
            preg_match_all('#<h1[\s>]#', $this->html($key, $locale)),
            "Expected exactly one <h1> on the {$key} page ({$locale})."
        );
    }

    #[DataProvider('serviceLocaleProvider')]
    public function test_h1_names_the_service(string $key, string $locale): void
    {
        preg_match('#<h1[^>]*>(.*?)</h1>#s', $this->html($key, $locale), $m);

        $this->assertSame(
            trans("service-pages.items.{$key}.h1", [], $locale),
            trim($m[1] ?? ''),
            "The <h1> on the {$key} page ({$locale}) does not carry the service name."
        );
    }

    #[DataProvider('serviceLocaleProvider')]
    public function test_heading_structure_is_logical(string $key, string $locale): void
    {
        preg_match_all('#<(h[1-3])[\s>]#', $this->html($key, $locale), $m);
        $levels = $m[1];

        $this->assertSame('h1', $levels[0], 'The first heading must be the h1.');
        $this->assertNotContains('h3', array_slice($levels, 0, 2), 'An h3 must not precede the first h2.');
    }

    #[DataProvider('serviceLocaleProvider')]
    public function test_open_graph_and_twitter_metadata_are_present(string $key, string $locale): void
    {
        $html = $this->html($key, $locale);
        $url  = self::DOMAIN . $this->url($key, $locale);

        $this->assertStringContainsString('<meta property="og:title" content="', $html);
        $this->assertStringContainsString('<meta property="og:description" content="', $html);
        $this->assertStringContainsString('<meta property="og:url" content="' . $url . '">', $html);
        $this->assertStringContainsString('<meta property="og:image" content="', $html);
        $this->assertStringContainsString('<meta name="twitter:card" content="summary_large_image">', $html);
        $this->assertStringContainsString('<meta name="twitter:title" content="', $html);
        $this->assertStringContainsString('<meta name="twitter:image" content="', $html);
    }

    #[DataProvider('serviceLocaleProvider')]
    public function test_no_preview_or_local_domain_leaks_into_the_page(string $key, string $locale): void
    {
        $html = $this->html($key, $locale);

        $this->assertStringNotContainsString('localhost', $html);
        $this->assertStringNotContainsString('127.0.0.1', $html);
        $this->assertStringNotContainsString('<meta name="robots" content="noindex">', $html);
    }

    // ── Structured data ───────────────────────────────────────────────────
    #[DataProvider('serviceLocaleProvider')]
    public function test_all_json_ld_blocks_parse_as_valid_json(string $key, string $locale): void
    {
        $blocks = $this->jsonLdBlocks($this->html($key, $locale));

        $this->assertGreaterThanOrEqual(2, count($blocks));

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

    #[DataProvider('serviceLocaleProvider')]
    public function test_webpage_node_matches_the_canonical_url(string $key, string $locale): void
    {
        $node = $this->graphNode($this->pageGraph($key, $locale), 'WebPage');
        $url  = self::DOMAIN . $this->url($key, $locale);

        $this->assertNotNull($node);
        $this->assertSame($url, $node['@id']);
        $this->assertSame($url, $node['url']);
        $this->assertNotEmpty($node['description']);
    }

    #[DataProvider('serviceLocaleProvider')]
    public function test_service_node_is_present_and_references_the_sitewide_business(string $key, string $locale): void
    {
        $node = $this->graphNode($this->pageGraph($key, $locale), 'Service');

        $this->assertNotNull($node, "No Service node on the {$key} page ({$locale}).");
        $this->assertNotEmpty($node['name']);
        $this->assertNotEmpty($node['serviceType']);
        $this->assertNotEmpty($node['description']);
        $this->assertSame(self::DOMAIN . $this->url($key, $locale), $node['url']);

        // provider must be a reference, not a duplicated business description.
        $this->assertSame(['@id'], array_keys($node['provider']));
        $this->assertStringEndsWith('#business', $node['provider']['@id']);
    }

    #[DataProvider('serviceLocaleProvider')]
    public function test_breadcrumb_list_is_present_and_well_formed(string $key, string $locale): void
    {
        $node       = $this->graphNode($this->pageGraph($key, $locale), 'BreadcrumbList');
        $hasParent  = config("service-pages.items.{$key}.parent") !== null;

        $this->assertNotNull($node, "No BreadcrumbList on the {$key} page ({$locale}).");
        $this->assertCount($hasParent ? 3 : 2, $node['itemListElement']);

        foreach ($node['itemListElement'] as $i => $item) {
            $this->assertSame('ListItem', $item['@type']);
            $this->assertSame($i + 1, $item['position']);
            $this->assertNotEmpty($item['name']);
        }

        $this->assertSame(self::DOMAIN . '/' . $locale, $node['itemListElement'][0]['item']);
        $this->assertArrayNotHasKey('item', $node['itemListElement'][count($node['itemListElement']) - 1]);
    }

    #[DataProvider('serviceProvider')]
    public function test_breadcrumb_never_links_to_a_non_existing_page(string $key): void
    {
        foreach (['nl', 'fr', 'en'] as $locale) {
            $node = $this->graphNode($this->pageGraph($key, $locale), 'BreadcrumbList');

            foreach ($node['itemListElement'] as $item) {
                if (isset($item['item'])) {
                    $this->get(parse_url($item['item'], PHP_URL_PATH))->assertStatus(200);
                }
            }
        }
    }

    #[DataProvider('serviceLocaleProvider')]
    public function test_faq_page_schema_matches_the_visible_faq(string $key, string $locale): void
    {
        $node = $this->graphNode($this->pageGraph($key, $locale), 'FAQPage');

        $this->assertNotNull($node, "No FAQPage on the {$key} page ({$locale}).");
        $this->assertGreaterThanOrEqual(5, count($node['mainEntity']));
        $this->assertLessThanOrEqual(7, count($node['mainEntity']));

        $html = $this->html($key, $locale);

        foreach ($node['mainEntity'] as $question) {
            $this->assertSame('Question', $question['@type']);
            $this->assertSame('Answer', $question['acceptedAnswer']['@type']);
            $this->assertNotEmpty($question['acceptedAnswer']['text']);
            $this->assertStringContainsString(e($question['name']), $html);
        }
    }

    public function test_graph_carries_no_second_business_no_rating_and_no_offers(): void
    {
        foreach (self::EXPECTED_KEYS as $key) {
            $graph = $this->pageGraph($key, 'nl');
            $types = array_column($graph['@graph'], '@type');

            $this->assertNotContains('LocalBusiness', $types);
            $this->assertNotContains('Carpenter', $types);

            $encoded = json_encode($graph);
            foreach (['aggregateRating', 'ratingValue', 'offers', 'priceRange', 'areaServed'] as $forbidden) {
                $this->assertStringNotContainsString($forbidden, $encoded, "{$forbidden} must not appear on {$key}.");
            }
        }
    }

    // ── Breadcrumbs (visible) ─────────────────────────────────────────────
    #[DataProvider('serviceLocaleProvider')]
    public function test_visible_breadcrumbs_are_rendered_and_accessible(string $key, string $locale): void
    {
        $html = $this->html($key, $locale);

        $this->assertStringContainsString('class="breadcrumbs"', $html);
        $this->assertStringContainsString('aria-current="page"', $html);
        $this->assertStringContainsString('href="/' . $locale . '"', $html);
    }

    // ── Internal links ────────────────────────────────────────────────────
    #[DataProvider('serviceLocaleProvider')]
    public function test_page_links_to_contact(string $key, string $locale): void
    {
        $this->assertStringContainsString(
            'href="/' . $locale . '/contact"',
            $this->html($key, $locale)
        );
    }

    #[DataProvider('serviceLocaleProvider')]
    public function test_page_links_to_every_configured_related_service(string $key, string $locale): void
    {
        $html = $this->html($key, $locale);
        $related = config("service-pages.items.{$key}.related");

        $this->assertGreaterThanOrEqual(3, count($related), 'Expected a main service plus at least two related ones.');

        foreach ($related as $relatedKey) {
            $url = ServicePages::url($relatedKey, $locale);

            $this->assertNotNull($url, "Unknown related key '{$relatedKey}' on {$key}.");
            $this->assertStringContainsString(
                'href="' . $url . '"',
                $html,
                "The {$key} page ({$locale}) does not link to {$relatedKey}."
            );
        }
    }

    #[DataProvider('serviceProvider')]
    public function test_every_related_link_resolves(string $key): void
    {
        foreach (config("service-pages.items.{$key}.related") as $relatedKey) {
            $this->get(ServicePages::url($relatedKey, 'nl'))->assertStatus(200);
        }
    }

    #[DataProvider('localeProvider')]
    public function test_every_service_is_reachable_from_an_existing_public_page(string $locale): void
    {
        $reachable = [];

        foreach (config('service-pages.on_core_pages') as $coreKey => $keys) {
            $html = $this->get(ServicePages::url($coreKey, $locale))->getContent();

            foreach ($keys as $serviceKey) {
                $url = ServicePages::url($serviceKey, $locale);

                $this->assertStringContainsString(
                    'href="' . $url . '"',
                    $html,
                    "{$serviceKey} is not linked from the {$coreKey} page ({$locale})."
                );

                $reachable[] = $serviceKey;
            }
        }

        $this->assertSame(
            [],
            array_diff(self::EXPECTED_KEYS, $reachable),
            'Every service must be reachable from at least one existing public page.'
        );
    }

    #[DataProvider('localeProvider')]
    public function test_main_navigation_was_not_enlarged(string $locale): void
    {
        // The seven pages are discoverable through their parent pages, not by
        // stuffing the header menu.
        $this->assertCount(8, trans('pages.nav_items', [], $locale));
    }

    // ── Content ───────────────────────────────────────────────────────────
    #[DataProvider('serviceLocaleProvider')]
    public function test_page_carries_a_substantial_amount_of_copy(string $key, string $locale): void
    {
        $words = str_word_count($this->visibleText($key, $locale), 0, 'áàâäéèêëíìîïóòôöúùûüçñÁÉÍÓÚäöüÄÖÜ');

        $this->assertGreaterThan(
            850,
            $words,
            "The {$key} page ({$locale}) only has {$words} words of visible copy."
        );
    }

    #[DataProvider('localeProvider')]
    public function test_service_copy_is_not_duplicated_across_services(string $locale): void
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

    #[DataProvider('serviceLocaleProvider')]
    public function test_no_missing_translation_keys(string $key, string $locale): void
    {
        $html = $this->html($key, $locale);

        $this->assertStringNotContainsString('service-pages.', $html);
        $this->assertStringNotContainsString('werkwijze.', $html);
        $this->assertStringNotContainsString('regions.common.', $html);
    }

    #[DataProvider('serviceProvider')]
    public function test_each_locale_carries_comparable_content_volume(string $key): void
    {
        $counts = [];

        foreach (['nl', 'fr', 'en'] as $locale) {
            $counts[$locale] = str_word_count($this->visibleText($key, $locale));
        }

        $this->assertGreaterThan(
            0.7 * max($counts),
            min($counts),
            "Content volume for {$key} differs too much between languages: " . json_encode($counts)
        );
    }

    #[DataProvider('serviceLocaleProvider')]
    public function test_page_shows_the_real_working_method(string $key, string $locale): void
    {
        $html  = $this->html($key, $locale);
        $steps = trans('werkwijze.steps', [], $locale);

        $this->assertCount(7, $steps);

        foreach ($steps as $step) {
            $this->assertStringContainsString(e($step['title']), $html);
        }
    }

    // ── Images ────────────────────────────────────────────────────────────
    public function test_every_configured_hero_image_exists_on_disk(): void
    {
        foreach (ServicePages::all() as $key => $service) {
            $this->assertFileExists(public_path($service['hero']), "Hero image for {$key} is missing.");
        }
    }

    public function test_heroes_are_not_all_the_same_image(): void
    {
        $heroes = array_column(ServicePages::all(), 'hero');

        $this->assertCount(7, array_unique($heroes), 'Each service should get its own hero image.');
    }

    #[DataProvider('serviceProvider')]
    public function test_hero_is_a_css_background_and_never_lazy_loaded(string $key): void
    {
        $html = $this->html($key, 'nl');

        $this->assertStringContainsString('class="page-hero page-hero--image service-hero"', $html);
        $this->assertMatchesRegularExpression("~--page-hero-image: url\('\S+\.webp'\)~", $html);
        $this->assertStringNotContainsString('hero.webp" loading="lazy"', $html);
    }

    #[DataProvider('serviceProvider')]
    public function test_gallery_images_are_lazy_loaded_and_have_alt_text(string $key): void
    {
        $html = $this->html($key, 'nl');
        preg_match_all('#<img[^>]*>#', $html, $m);

        $gallery = array_values(array_filter(
            $m[0],
            static fn (string $tag): bool => str_contains($tag, 'loading="lazy"')
        ));

        if (config("service-pages.items.{$key}.gallery") === null) {
            $this->assertSame([], $gallery, "{$key} has no gallery configured, so it should render none.");

            return;
        }

        $this->assertNotEmpty($gallery, "No lazy-loaded gallery images on the {$key} page.");

        foreach ($gallery as $tag) {
            $this->assertMatchesRegularExpression('#alt="[^"]+"#', $tag);
        }
    }

    public function test_door_pages_do_not_show_the_exact_same_photos(): void
    {
        $inner = $this->galleryPaths('binnendeuren');
        $outer = $this->galleryPaths('buitendeuren');

        $this->assertNotEmpty($inner);
        $this->assertNotEmpty($outer);
        $this->assertSame([], array_intersect($inner, $outer));
    }

    // ── Helpers ───────────────────────────────────────────────────────────
    private function galleryPaths(string $key): array
    {
        preg_match_all('#<img[^>]*loading="lazy"[^>]*src="([^"]+)"#', $this->html($key, 'nl'), $m);
        preg_match_all('#<img[^>]*src="([^"]+)"[^>]*loading="lazy"#', $this->html($key, 'nl'), $m2);

        return array_values(array_unique([...$m[1], ...$m2[1]]));
    }

    private function visibleText(string $key, string $locale): string
    {
        $html = $this->html($key, $locale);
        $html = preg_replace('#<(script|style)\b[^>]*>.*?</\1>#s', ' ', $html);

        return trim(preg_replace('#\s+#u', ' ', strip_tags($html)));
    }

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
    public static function serviceProvider(): array
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

    public static function serviceLocaleProvider(): array
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

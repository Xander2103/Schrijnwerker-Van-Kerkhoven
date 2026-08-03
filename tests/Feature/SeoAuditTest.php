<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Sitewide SEO guardrails.
 *
 * Rather than checking one page at a time, this walks every URL in the sitemap
 * and asserts the properties that a professional audit would look at. It exists
 * so the findings of the sprint-4 audit cannot silently come back.
 */
class SeoAuditTest extends TestCase
{
    private const DOMAIN = 'https://schrijnwerkerijvankerkhoven.be';

    /** @var array<string, string>|null */
    private static ?array $pages = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        config(['app.url' => self::DOMAIN]);
    }

    /**
     * Every sitemap path mapped to its rendered HTML, fetched once per test
     * process — 69 pages is too many to re-render per assertion.
     *
     * @return array<string, string>
     */
    private function pages(): array
    {
        if (self::$pages !== null) {
            return self::$pages;
        }

        preg_match_all('#<loc>(.*?)</loc>#', $this->get('/sitemap.xml')->getContent(), $m);

        $pages = [];
        foreach ($m[1] as $url) {
            $path = parse_url($url, PHP_URL_PATH);
            $pages[$path] = $this->get($path)->getContent();
        }

        return self::$pages = $pages;
    }

    private function meta(string $html, string $pattern): string
    {
        preg_match($pattern, $html, $m);

        return html_entity_decode(trim($m[1] ?? ''), ENT_QUOTES);
    }

    // ── Metadata ──────────────────────────────────────────────────────────

    public function test_every_page_has_a_unique_title_of_a_sensible_length(): void
    {
        $titles = [];

        foreach ($this->pages() as $path => $html) {
            $title = $this->meta($html, '#<title>(.*?)</title>#s');

            $this->assertNotSame('', $title, "No <title> on {$path}.");
            $this->assertLessThanOrEqual(62, mb_strlen($title), "Title too long on {$path}: {$title}");
            $this->assertGreaterThanOrEqual(30, mb_strlen($title), "Title too short on {$path}: {$title}");
            $this->assertStringContainsString('Van Kerkhoven', $title, "Brand name missing from the title on {$path}.");

            $this->assertArrayNotHasKey($title, $titles, "Duplicate title on {$path} and " . ($titles[$title] ?? ''));
            $titles[$title] = $path;
        }
    }

    public function test_every_page_has_a_unique_description_of_a_sensible_length(): void
    {
        $descriptions = [];

        foreach ($this->pages() as $path => $html) {
            $desc = $this->meta($html, '#<meta name="description" content="(.*?)">#s');

            $this->assertNotSame('', $desc, "No meta description on {$path}.");
            $this->assertLessThanOrEqual(160, mb_strlen($desc), "Description too long on {$path}.");
            $this->assertGreaterThanOrEqual(120, mb_strlen($desc), "Description too short on {$path}.");

            $this->assertArrayNotHasKey($desc, $descriptions, "Duplicate description on {$path} and " . ($descriptions[$desc] ?? ''));
            $descriptions[$desc] = $path;
        }
    }

    // ── Headings ──────────────────────────────────────────────────────────

    public function test_every_page_has_exactly_one_h1(): void
    {
        foreach ($this->pages() as $path => $html) {
            $this->assertSame(1, preg_match_all('#<h1[\s>]#', $html), "Expected exactly one <h1> on {$path}.");
        }
    }

    public function test_no_page_skips_a_heading_level(): void
    {
        foreach ($this->pages() as $path => $html) {
            preg_match_all('#<(h[1-6])[^>]*>#', $html, $m);

            $previous = 0;
            foreach ($m[1] as $tag) {
                $level = (int) substr($tag, 1);

                if ($previous > 0) {
                    $this->assertLessThanOrEqual(
                        $previous + 1,
                        $level,
                        "Heading level jumps from h{$previous} to h{$level} on {$path}."
                    );
                }

                $previous = $level;
            }
        }
    }

    // ── Canonical / hreflang ──────────────────────────────────────────────

    public function test_canonical_and_hreflang_share_the_production_base_url(): void
    {
        foreach ($this->pages() as $path => $html) {
            preg_match('#<link rel="canonical" href="([^"]+)"#', $html, $c);
            $this->assertNotEmpty($c[1] ?? '', "No canonical on {$path}.");
            $this->assertStringStartsWith(self::DOMAIN . '/', $c[1]);

            preg_match_all('#<link rel="alternate" hreflang="([^"]+)" href="([^"]+)"#', $html, $a, PREG_SET_ORDER);
            $this->assertGreaterThanOrEqual(4, count($a), "Missing hreflang alternates on {$path}.");

            foreach ($a as [, $hreflang, $href]) {
                $this->assertStringStartsWith(
                    self::DOMAIN . '/',
                    $href,
                    "hreflang {$hreflang} on {$path} does not use the canonical base URL."
                );
            }
        }
    }

    public function test_no_page_leaks_a_local_or_preview_host(): void
    {
        foreach ($this->pages() as $path => $html) {
            $this->assertStringNotContainsString('localhost', $html, "localhost leaked into {$path}.");
            $this->assertStringNotContainsString('127.0.0.1', $html, "127.0.0.1 leaked into {$path}.");
            $this->assertStringNotContainsString('<meta name="robots" content="noindex">', $html, "{$path} is noindex.");
        }
    }

    // ── Output hygiene ────────────────────────────────────────────────────

    public function test_no_page_emits_a_byte_order_mark_or_output_before_the_doctype(): void
    {
        foreach ($this->pages() as $path => $html) {
            $this->assertStringStartsWith('<!DOCTYPE html>', $html, "Stray output before the doctype on {$path}.");
        }
    }

    /**
     * A BOM anywhere in a config or translation file leaks into every response.
     */
    public function test_no_php_source_file_starts_with_a_byte_order_mark(): void
    {
        $roots = ['app', 'config', 'lang', 'routes', 'resources/views'];
        $found = [];

        foreach ($roots as $root) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator(base_path($root), \FilesystemIterator::SKIP_DOTS)
            );

            foreach ($files as $file) {
                if (!in_array($file->getExtension(), ['php'], true)) {
                    continue;
                }

                if (str_starts_with((string) file_get_contents($file->getPathname()), "\xEF\xBB\xBF")) {
                    $found[] = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $file->getPathname());
                }
            }
        }

        $this->assertSame([], $found, 'These files start with a UTF-8 BOM: ' . implode(', ', $found));
    }

    // ── Images ────────────────────────────────────────────────────────────

    public function test_every_image_has_an_alt_attribute_and_intrinsic_dimensions(): void
    {
        foreach ($this->pages() as $path => $html) {
            preg_match_all('#<img[^>]*>#s', $html, $m);

            foreach ($m[0] as $tag) {
                $this->assertMatchesRegularExpression('#\salt="#', $tag, "Image without alt on {$path}: {$tag}");

                // The lightbox <img> lives inside a hidden <dialog> and is
                // filled by JavaScript, so it cannot shift the layout.
                if (str_contains($tag, 'lightbox-img')) {
                    continue;
                }

                $this->assertMatchesRegularExpression(
                    '#\swidth="\d+"#',
                    $tag,
                    "Image without width/height (CLS risk) on {$path}: " . preg_replace('#\s+#', ' ', $tag)
                );
            }
        }
    }

    public function test_pages_with_a_hero_image_preload_it(): void
    {
        foreach ($this->pages() as $path => $html) {
            if (!str_contains($html, '--page-hero-image') && !str_contains($html, '--hero-image')) {
                continue;
            }

            $this->assertStringContainsString(
                '<link rel="preload" as="image"',
                $html,
                "The hero on {$path} is a CSS background but is not preloaded."
            );
        }
    }

    // ── Structured data ───────────────────────────────────────────────────

    public function test_all_json_ld_is_valid_and_free_of_duplicate_top_level_types(): void
    {
        foreach ($this->pages() as $path => $html) {
            preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $html, $m);
            $this->assertNotEmpty($m[1], "No JSON-LD on {$path}.");

            $types = [];
            foreach ($m[1] as $block) {
                $decoded = json_decode(trim($block), true);
                $this->assertSame(JSON_ERROR_NONE, json_last_error(), "Invalid JSON-LD on {$path}.");

                foreach ($decoded['@graph'] ?? [$decoded] as $node) {
                    $types[] = $node['@type'] ?? '?';
                }
            }

            $this->assertSame(
                $types,
                array_values(array_unique($types)),
                "Duplicate schema types on {$path}: " . implode(', ', $types)
            );
            $this->assertContains('Carpenter', $types, "The sitewide business schema is missing on {$path}.");
        }
    }

    public function test_no_page_publishes_ratings_prices_or_offers(): void
    {
        foreach ($this->pages() as $path => $html) {
            preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $html, $m);
            $json = implode('', $m[1]);

            foreach (['aggregateRating', 'ratingValue', '"offers"', 'priceRange', '"review"'] as $forbidden) {
                $this->assertStringNotContainsString($forbidden, $json, "{$forbidden} appears on {$path}.");
            }
        }
    }

    // ── Internal linking ──────────────────────────────────────────────────

    public function test_no_region_or_service_page_is_weakly_linked(): void
    {
        $inbound = [];

        foreach ($this->pages() as $path => $html) {
            preg_match_all('~href="(/(?:nl|fr|en)[^"\#]*)"~', $html, $m);

            foreach (array_unique($m[1]) as $target) {
                if ($target !== $path) {
                    $inbound[$target][$path] = true;
                }
            }
        }

        $tracked = [];
        foreach (['nl', 'fr', 'en'] as $locale) {
            foreach (config('regions.items') as $region) {
                $tracked[] = '/' . $locale . '/' . $region['slugs'][$locale];
            }
            foreach (config('service-pages.items') as $service) {
                $tracked[] = '/' . $locale . '/' . $service['slugs'][$locale];
            }
        }

        foreach ($tracked as $path) {
            $this->assertGreaterThanOrEqual(
                5,
                count($inbound[$path] ?? []),
                "{$path} only has " . count($inbound[$path] ?? []) . ' inbound internal links (minimum 5).'
            );
        }
    }

    public function test_every_page_links_to_contact(): void
    {
        foreach ($this->pages() as $path => $html) {
            $locale = explode('/', ltrim($path, '/'))[0];

            $this->assertStringContainsString(
                'href="/' . $locale . '/contact"',
                $html,
                "No contact link on {$path}."
            );
        }
    }

    // ── FAQ ───────────────────────────────────────────────────────────────

    #[DataProvider('localeProvider')]
    public function test_faq_questions_and_answers_are_never_duplicated(string $locale): void
    {
        $questions = $answers = [];

        $sources = [
            'regions.items'       => array_keys(config('regions.items')),
            'service-pages.items' => array_keys(config('service-pages.items')),
        ];

        foreach ($sources as $namespace => $keys) {
            foreach ($keys as $key) {
                foreach (trans("{$namespace}.{$key}.faq", [], $locale) as $item) {
                    $q = mb_strtolower(trim($item['q']));
                    $a = mb_strtolower(trim($item['a']));

                    $this->assertArrayNotHasKey($q, $questions, "Duplicate FAQ question ({$locale}) on {$key} and " . ($questions[$q] ?? ''));
                    $this->assertArrayNotHasKey($a, $answers, "Duplicate FAQ answer ({$locale}) on {$key} and " . ($answers[$a] ?? ''));

                    $this->assertGreaterThanOrEqual(70, mb_strlen($item['a']), "FAQ answer too thin ({$locale}, {$key}): {$item['a']}");

                    $questions[$q] = $key;
                    $answers[$a]   = $key;
                }
            }
        }
    }

    // ── robots.txt ────────────────────────────────────────────────────────

    public function test_robots_txt_is_crawlable_and_points_at_the_sitemap(): void
    {
        $robots = file_get_contents(public_path('robots.txt'));

        $this->assertStringContainsString('User-agent: *', $robots);
        $this->assertStringContainsString('Sitemap: ' . self::DOMAIN . '/sitemap.xml', $robots);
        $this->assertDoesNotMatchRegularExpression('#^\s*Disallow:\s*/\s*$#m', $robots, 'robots.txt blocks the whole site.');
    }

    public static function localeProvider(): array
    {
        return ['nl' => ['nl'], 'fr' => ['fr'], 'en' => ['en']];
    }
}

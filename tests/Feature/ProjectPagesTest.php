<?php

namespace Tests\Feature;

use App\Support\Projects;
use App\Support\ServicePages;
use Illuminate\Support\Facades\Lang;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ProjectPagesTest extends TestCase
{
    private const DOMAIN = 'https://schrijnwerkerijvankerkhoven.be';

    private const INDEX_SLUGS = ['nl' => 'realisaties', 'fr' => 'realisations', 'en' => 'projects'];

    /** Key of the fixture project used to exercise the published path. */
    private const FIXTURE = 'test-fixture-project';

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        config(['app.url' => self::DOMAIN]);
    }

    // ─────────────────────────────────────────────────────────────────────
    //  Configuration — validated against the real config/projects.php
    // ─────────────────────────────────────────────────────────────────────

    public function test_project_keys_are_unique(): void
    {
        $keys = array_keys(config('projects.items'));

        $this->assertSame($keys, array_values(array_unique($keys)));
    }

    public function test_every_project_has_a_slug_for_every_locale(): void
    {
        foreach (config('projects.items') as $key => $project) {
            foreach (['nl', 'fr', 'en'] as $locale) {
                $this->assertNotEmpty($project['slugs'][$locale] ?? null, "{$key} has no {$locale} slug.");
                $this->assertMatchesRegularExpression(
                    '/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                    $project['slugs'][$locale],
                    "{$key} has a malformed {$locale} slug."
                );
            }
        }
    }

    public function test_all_project_slugs_are_unique_within_each_locale(): void
    {
        foreach (['nl', 'fr', 'en'] as $locale) {
            $slugs = array_column(array_column(config('projects.items'), 'slugs'), $locale);

            $this->assertSame($slugs, array_values(array_unique($slugs)), "Duplicate {$locale} project slug.");
        }
    }

    public function test_every_project_has_a_valid_status(): void
    {
        foreach (config('projects.items') as $key => $project) {
            $this->assertContains($project['status'] ?? null, ['draft', 'published'], "{$key} has an invalid status.");
        }
    }

    public function test_every_project_hero_exists_on_disk(): void
    {
        foreach (config('projects.items') as $key => $project) {
            $this->assertNotEmpty($project['hero'] ?? null, "{$key} has no hero.");
            $this->assertFileExists(public_path($project['hero']), "Hero for {$key} is missing.");
        }
    }

    public function test_every_project_gallery_image_exists_on_disk(): void
    {
        foreach (config('projects.items') as $key => $project) {
            foreach ($project['gallery'] ?? [] as $path) {
                $this->assertFileExists(public_path($path), "Gallery image for {$key} is missing: {$path}");
            }
        }
    }

    public function test_every_project_references_an_existing_service(): void
    {
        $core = array_keys(ServicePages::core());
        $sub  = array_keys(ServicePages::all());

        foreach (config('projects.items') as $key => $project) {
            $this->assertContains($project['service'], $core, "{$key} points at an unknown service.");

            if (!empty($project['subservice'])) {
                $this->assertContains($project['subservice'], $sub, "{$key} points at an unknown subservice.");
            }
        }
    }

    public function test_every_configured_region_exists(): void
    {
        $this->assertNotEmpty(config('projects.items'), 'No projects configured at all.');

        foreach (config('projects.items') as $key => $project) {
            if (!empty($project['region'])) {
                $this->assertArrayHasKey(
                    $project['region'],
                    config('regions.items'),
                    "{$key} points at an unknown region."
                );
            }
        }
    }

    public function test_related_projects_reference_known_keys(): void
    {
        $keys = array_keys(config('projects.items'));
        $this->assertNotEmpty($keys, 'No projects configured at all.');

        foreach (config('projects.items') as $key => $project) {
            foreach ($project['related_projects'] ?? [] as $related) {
                $this->assertContains($related, $keys, "{$key} relates to an unknown project.");
                $this->assertNotSame($key, $related, "{$key} relates to itself.");
            }
        }
    }

    /**
     * The publication bar: a project may only go live with a confirmed
     * service, at least three photos, and full copy in all three languages.
     */
    public function test_published_projects_meet_every_publication_criterion(): void
    {
        // Also covers the fixture, so the criteria themselves stay exercised
        // while the real site still has nothing published.
        $this->publishFixture();

        $this->assertNotEmpty(Projects::published());

        foreach (Projects::published() as $key => $project) {
            $this->assertGreaterThanOrEqual(
                Projects::MIN_PHOTOS,
                count($project['gallery'] ?? []),
                "{$key} is published with fewer than " . Projects::MIN_PHOTOS . ' photos.'
            );

            foreach (['nl', 'fr', 'en'] as $locale) {
                foreach (['title', 'intro', 'hero_alt', 'meta_title', 'meta_description'] as $field) {
                    $value = trans("projects.items.{$key}.{$field}", [], $locale);
                    $this->assertIsString($value, "{$key}.{$field} ({$locale}) is not a string.");
                    $this->assertNotSame("projects.items.{$key}.{$field}", $value, "{$key}.{$field} ({$locale}) is missing.");
                    $this->assertNotSame('', trim($value), "{$key}.{$field} ({$locale}) is empty.");
                }

                foreach (['challenge', 'approach', 'result'] as $field) {
                    $value = trans("projects.items.{$key}.{$field}", [], $locale);
                    $this->assertIsArray($value, "{$key}.{$field} ({$locale}) must be an array of paragraphs.");
                    $this->assertNotEmpty($value, "{$key}.{$field} ({$locale}) is empty.");
                }
            }
        }
    }

    public function test_drafts_declare_what_is_still_missing(): void
    {
        foreach (config('projects.items') as $key => $project) {
            if (($project['status'] ?? 'draft') !== 'draft') {
                continue;
            }

            $this->assertNotEmpty($project['missing'] ?? [], "Draft {$key} does not record what is missing.");
            $this->assertNotEmpty($project['evidence'] ?? null, "Draft {$key} does not record its evidence.");
        }
    }

    public function test_unconfirmed_facts_are_left_empty_rather_than_guessed(): void
    {
        foreach (config('projects.items') as $key => $project) {
            $this->assertArrayHasKey('region', $project, "{$key} must declare region (null when unconfirmed).");
            $this->assertArrayHasKey('year', $project, "{$key} must declare year (null when unconfirmed).");
            $this->assertArrayHasKey('materials', $project, "{$key} must declare materials (empty when unconfirmed).");
        }
    }

    // ─────────────────────────────────────────────────────────────────────
    //  Drafts must not exist publicly
    // ─────────────────────────────────────────────────────────────────────

    public function test_draft_projects_have_no_public_route(): void
    {
        foreach (config('projects.items') as $key => $project) {
            if (($project['status'] ?? 'draft') === 'published') {
                continue;
            }

            foreach (['nl', 'fr', 'en'] as $locale) {
                $this->get('/' . $locale . '/' . self::INDEX_SLUGS[$locale] . '/' . $project['slugs'][$locale])
                    ->assertStatus(404);
            }
        }
    }

    public function test_draft_projects_are_absent_from_the_index(): void
    {
        foreach (['nl', 'fr', 'en'] as $locale) {
            $html = $this->get('/' . $locale . '/' . self::INDEX_SLUGS[$locale])->getContent();

            foreach (config('projects.items') as $key => $project) {
                if (($project['status'] ?? 'draft') === 'published') {
                    continue;
                }

                $this->assertStringNotContainsString($project['slugs'][$locale], $html, "Draft {$key} leaked into the index.");
            }
        }
    }

    public function test_draft_slugs_never_resolve_to_a_published_project(): void
    {
        foreach (config('projects.items') as $key => $project) {
            if (($project['status'] ?? 'draft') === 'published') {
                continue;
            }

            foreach (['nl', 'fr', 'en'] as $locale) {
                $this->assertNotContains($project['slugs'][$locale], Projects::publishedSlugs());
                $this->assertNull(Projects::find($locale, $project['slugs'][$locale]), "Draft {$key} resolved.");
            }
        }
    }

    // ─────────────────────────────────────────────────────────────────────
    //  Realisation index
    // ─────────────────────────────────────────────────────────────────────

    #[DataProvider('localeProvider')]
    public function test_index_returns_200(string $locale): void
    {
        $this->get('/' . $locale . '/' . self::INDEX_SLUGS[$locale])->assertStatus(200);
    }

    public function test_index_slug_from_another_locale_returns_404(): void
    {
        $this->get('/nl/realisations')->assertStatus(404);
        $this->get('/nl/projects')->assertStatus(404);
        $this->get('/fr/realisaties')->assertStatus(404);
        $this->get('/en/realisaties')->assertStatus(404);
    }

    public function test_index_does_not_conflict_with_existing_routes(): void
    {
        $this->get('/nl/ramen')->assertStatus(200);
        $this->get('/nl/binnendeuren')->assertStatus(200);
        $this->get('/nl/schrijnwerker-leuven')->assertStatus(200);
        $this->get('/nl/contact')->assertStatus(200);
        $this->get('/fr/portails')->assertStatus(200);
    }

    #[DataProvider('localeProvider')]
    public function test_index_has_one_h1_and_breadcrumbs(string $locale): void
    {
        $html = $this->get('/' . $locale . '/' . self::INDEX_SLUGS[$locale])->getContent();

        $this->assertSame(1, preg_match_all('#<h1[\s>]#', $html));
        $this->assertStringContainsString('class="breadcrumbs"', $html);
        $this->assertStringContainsString('aria-current="page"', $html);
    }

    #[DataProvider('localeProvider')]
    public function test_index_seo_is_complete(string $locale): void
    {
        $html = $this->get('/' . $locale . '/' . self::INDEX_SLUGS[$locale])->getContent();
        $url  = self::DOMAIN . '/' . $locale . '/' . self::INDEX_SLUGS[$locale];

        $this->assertStringContainsString('<link rel="canonical" href="' . $url . '">', $html);
        $this->assertStringContainsString('<meta property="og:url" content="' . $url . '">', $html);

        foreach (['nl' => 'nl-BE', 'fr' => 'fr-BE', 'en' => 'en'] as $alt => $hreflang) {
            $this->assertStringContainsString(
                '<link rel="alternate" hreflang="' . $hreflang . '" href="'
                    . self::DOMAIN . '/' . $alt . '/' . self::INDEX_SLUGS[$alt] . '">',
                $html
            );
        }

        $this->assertStringContainsString(
            '<link rel="alternate" hreflang="x-default" href="' . self::DOMAIN . '/nl/realisaties">',
            $html
        );
    }

    public function test_index_titles_and_descriptions_are_unique_per_locale(): void
    {
        $titles = [];

        foreach (['nl', 'fr', 'en'] as $locale) {
            preg_match('#<title>(.*?)</title>#s', $this->get('/' . $locale . '/' . self::INDEX_SLUGS[$locale])->getContent(), $m);
            $titles[] = trim($m[1]);
        }

        $this->assertSame($titles, array_values(array_unique($titles)));
    }

    #[DataProvider('localeProvider')]
    public function test_index_json_ld_is_valid_and_declares_a_collection_page(string $locale): void
    {
        $graph = $this->pageGraph('/' . $locale . '/' . self::INDEX_SLUGS[$locale]);

        $this->assertNotNull($this->graphNode($graph, 'CollectionPage'));
        $this->assertNotNull($this->graphNode($graph, 'BreadcrumbList'));
    }

    #[DataProvider('localeProvider')]
    public function test_index_shows_an_empty_state_when_nothing_is_published(string $locale): void
    {
        if (Projects::hasPublished()) {
            $this->markTestSkipped('Projects are published, so the empty state does not apply.');
        }

        $html = $this->get('/' . $locale . '/' . self::INDEX_SLUGS[$locale])->getContent();

        $this->assertStringContainsString('class="projects-empty"', $html);
        $this->assertStringContainsString(e(trans('projects.common.index_empty_heading', [], $locale)), $html);
        $this->assertStringContainsString('href="/' . $locale . '/contact"', $html);
        // No ItemList should be emitted for an empty collection.
        $this->assertNull($this->graphNode($this->pageGraph('/' . $locale . '/' . self::INDEX_SLUGS[$locale]), 'ItemList'));
    }

    #[DataProvider('localeProvider')]
    public function test_index_is_reachable_from_the_footer_of_an_existing_page(string $locale): void
    {
        $html = $this->get('/' . $locale)->getContent();

        $this->assertStringContainsString('href="/' . $locale . '/' . self::INDEX_SLUGS[$locale] . '"', $html);
    }

    public function test_no_empty_related_projects_section_is_rendered(): void
    {
        if (Projects::hasPublished()) {
            $this->markTestSkipped('Projects are published, so sections are expected to render.');
        }

        foreach (['/nl/ramen', '/nl/binnendeuren', '/nl/schrijnwerker-leuven', '/nl/werkplaats'] as $path) {
            $this->assertStringNotContainsString(
                'related-projects-section',
                $this->get($path)->getContent(),
                "An empty related-projects section rendered on {$path}."
            );
        }
    }

    // ─────────────────────────────────────────────────────────────────────
    //  Published behaviour, exercised through an injected fixture project
    // ─────────────────────────────────────────────────────────────────────

    public function test_a_published_project_is_fully_routable_and_correct(): void
    {
        $this->publishFixture();

        foreach (['nl', 'fr', 'en'] as $locale) {
            $url = $this->fixtureUrl($locale);
            $this->get($url)->assertStatus(200);

            $html = $this->get($url)->getContent();
            $abs  = self::DOMAIN . $url;

            // One H1, carrying the project title.
            $this->assertSame(1, preg_match_all('#<h1[\s>]#', $html));
            preg_match('#<h1[^>]*>(.*?)</h1>#s', $html, $m);
            $this->assertSame(trans('projects.items.' . self::FIXTURE . '.title', [], $locale), trim($m[1]));

            // Required story sections.
            foreach (['challenge_heading', 'approach_heading', 'result_heading'] as $heading) {
                $this->assertStringContainsString(e(trans('projects.common.' . $heading, [], $locale)), $html);
            }

            // SEO.
            $this->assertStringContainsString('<link rel="canonical" href="' . $abs . '">', $html);
            $this->assertStringContainsString('<meta property="og:url" content="' . $abs . '">', $html);
            $this->assertStringContainsString('<meta property="og:image" content="', $html);
            $this->assertStringContainsString('<meta name="twitter:card" content="summary_large_image">', $html);
            $this->assertStringNotContainsString('localhost', $html);

            // Reciprocal hreflang with x-default on NL.
            foreach (['nl' => 'nl-BE', 'fr' => 'fr-BE', 'en' => 'en'] as $alt => $hreflang) {
                $this->assertStringContainsString(
                    '<link rel="alternate" hreflang="' . $hreflang . '" href="' . self::DOMAIN . $this->fixtureUrl($alt) . '">',
                    $html
                );
            }
            $this->assertStringContainsString(
                '<link rel="alternate" hreflang="x-default" href="' . self::DOMAIN . $this->fixtureUrl('nl') . '">',
                $html
            );

            // Internal links: contact, primary service, index, region.
            $this->assertStringContainsString('href="/' . $locale . '/contact"', $html);
            $this->assertStringContainsString('href="' . ServicePages::url('ramen', $locale) . '"', $html);
            $this->assertStringContainsString('href="' . ServicePages::url('houten-ramen', $locale) . '"', $html);
            $this->assertStringContainsString('href="' . Projects::indexUrl($locale) . '"', $html);
            $this->assertStringContainsString('href="/' . $locale . '/' . config("regions.items.huldenberg.slugs.{$locale}") . '"', $html);
        }
    }

    public function test_published_project_titles_and_descriptions_are_unique_per_locale(): void
    {
        $this->publishFixture();

        $titles = $descriptions = [];

        foreach (Projects::published() as $key => $project) {
            preg_match('#<title>(.*?)</title>#s', $this->get(Projects::url($key, 'nl'))->getContent(), $t);
            preg_match('#<meta name="description" content="(.*?)">#s', $this->get(Projects::url($key, 'nl'))->getContent(), $d);
            $titles[]       = trim($t[1]);
            $descriptions[] = trim($d[1]);
        }

        $this->assertSame($titles, array_values(array_unique($titles)));
        $this->assertSame($descriptions, array_values(array_unique($descriptions)));
    }

    public function test_published_project_slug_from_another_locale_returns_404(): void
    {
        $this->publishFixture();

        $this->get('/nl/realisaties/' . $this->fixtureSlug('en'))->assertStatus(404);
        $this->get('/en/projects/' . $this->fixtureSlug('nl'))->assertStatus(404);
        $this->get('/fr/realisations/' . $this->fixtureSlug('nl'))->assertStatus(404);
    }

    public function test_unknown_project_returns_404(): void
    {
        $this->publishFixture();

        $this->get('/nl/realisaties/dit-bestaat-niet')->assertStatus(404);
        $this->get('/nl/realisaties/' . $this->fixtureSlug('nl') . '/extra')->assertStatus(404);
    }

    public function test_invalid_locale_on_project_route_returns_404(): void
    {
        $this->publishFixture();

        $this->get('/de/realisaties/' . $this->fixtureSlug('nl'))->assertStatus(404);
    }

    public function test_locale_switching_lands_on_the_same_project(): void
    {
        $this->publishFixture();

        $html = $this->get($this->fixtureUrl('nl'))->getContent();

        $this->assertStringContainsString('href="' . $this->fixtureUrl('fr') . '"', $html);
        $this->assertStringContainsString('href="' . $this->fixtureUrl('en') . '"', $html);
    }

    public function test_published_project_json_ld_is_valid_and_carries_no_commercial_markup(): void
    {
        $this->publishFixture();

        foreach (['nl', 'fr', 'en'] as $locale) {
            $graph = $this->pageGraph($this->fixtureUrl($locale));
            $types = array_column($graph['@graph'], '@type');

            $this->assertNotNull($this->graphNode($graph, 'WebPage'));
            $this->assertNotNull($this->graphNode($graph, 'ImageObject'));
            $this->assertNotNull($this->graphNode($graph, 'CreativeWork'));
            $this->assertNotNull($this->graphNode($graph, 'BreadcrumbList'));

            $this->assertNotContains('Product', $types);
            $this->assertNotContains('Offer', $types);
            $this->assertNotContains('Review', $types);
            $this->assertNotContains('LocalBusiness', $types);
            $this->assertNotContains('Carpenter', $types);

            $encoded = json_encode($graph);
            foreach (['aggregateRating', 'ratingValue', 'offers', 'price', 'review'] as $forbidden) {
                $this->assertStringNotContainsString($forbidden, $encoded);
            }

            // The business is referenced, never re-described.
            $this->assertStringEndsWith('#business', $this->graphNode($graph, 'CreativeWork')['creator']['@id']);
        }
    }

    public function test_published_project_omits_unconfirmed_facts_entirely(): void
    {
        $this->publishFixture(['year' => null, 'materials' => [], 'work_type' => null, 'region' => null]);

        $html  = $this->get($this->fixtureUrl('nl'))->getContent();
        $graph = $this->pageGraph($this->fixtureUrl('nl'));

        // No label, no placeholder, no empty row.
        $this->assertStringNotContainsString(e(trans('projects.common.label_year', [], 'nl')), $html);
        $this->assertStringNotContainsString(e(trans('projects.common.label_materials', [], 'nl')), $html);
        $this->assertStringNotContainsString(e(trans('projects.common.label_region', [], 'nl')), $html);
        $this->assertStringNotContainsString(e(trans('projects.common.label_work_type', [], 'nl')), $html);

        // And no link to a region page — the footer address still names
        // Huldenberg, so assert on the region URL rather than on the word.
        $this->assertStringNotContainsString(
            'href="/nl/' . config('regions.items.huldenberg.slugs.nl') . '"',
            $html
        );

        $creativeWork = $this->graphNode($graph, 'CreativeWork');
        $this->assertArrayNotHasKey('dateCreated', $creativeWork);
        $this->assertArrayNotHasKey('material', $creativeWork);
    }

    public function test_published_project_gallery_is_accessible(): void
    {
        $this->publishFixture();

        $html = $this->get($this->fixtureUrl('nl'))->getContent();

        preg_match_all('#<img[^>]*>#', $html, $m);
        $imgs = $m[0];

        $lazy = array_values(array_filter($imgs, static fn (string $t): bool => str_contains($t, 'loading="lazy"')));
        $this->assertNotEmpty($lazy, 'Gallery photos below the fold must be lazy-loaded.');

        foreach ($lazy as $tag) {
            $this->assertMatchesRegularExpression('#alt="[^"]*"#', $tag);
            $this->assertStringContainsString('decoding="async"', $tag);
        }

        // The hero is a CSS background, so it can never be lazy-loaded.
        $this->assertMatchesRegularExpression("~--page-hero-image: url\('[^']+\.webp'\)~", $html);

        // Real alt text is carried through to the gallery images.
        $this->assertStringContainsString('alt="Detailfoto van het raamprofiel"', $html);

        // No autoplay, no rotation, natural aspect ratios via the existing grid.
        $this->assertStringContainsString('class="curated-gallery"', $html);
        $this->assertStringNotContainsString('autoplay', $html);
        $this->assertStringNotContainsString('rotate(', $html);
    }

    public function test_published_project_breadcrumb_links_all_resolve(): void
    {
        $this->publishFixture();

        $node = $this->graphNode($this->pageGraph($this->fixtureUrl('nl')), 'BreadcrumbList');

        $this->assertCount(3, $node['itemListElement']);
        $this->assertArrayNotHasKey('item', $node['itemListElement'][2]);

        foreach ($node['itemListElement'] as $item) {
            if (isset($item['item'])) {
                $this->get(parse_url($item['item'], PHP_URL_PATH))->assertStatus(200);
            }
        }
    }

    public function test_published_project_is_reachable_from_index_service_and_region(): void
    {
        $this->publishFixture();

        foreach (['nl', 'fr', 'en'] as $locale) {
            $url = $this->fixtureUrl($locale);

            $this->assertStringContainsString(
                'href="' . $url . '"',
                $this->get(Projects::indexUrl($locale))->getContent(),
                "Project not linked from the index ({$locale})."
            );

            $this->assertStringContainsString(
                'href="' . $url . '"',
                $this->get(ServicePages::url('ramen', $locale))->getContent(),
                "Project not linked from the ramen page ({$locale})."
            );

            $this->assertStringContainsString(
                'href="' . $url . '"',
                $this->get(ServicePages::url('houten-ramen', $locale))->getContent(),
                "Project not linked from the houten-ramen page ({$locale})."
            );

            $this->assertStringContainsString(
                'href="' . $url . '"',
                $this->get('/' . $locale . '/' . config("regions.items.huldenberg.slugs.{$locale}"))->getContent(),
                "Project not linked from the Huldenberg page ({$locale})."
            );
        }
    }

    public function test_a_project_without_a_confirmed_region_is_not_linked_from_any_region_page(): void
    {
        $this->publishFixture(['region' => null]);

        foreach (array_keys(config('regions.items')) as $regionKey) {
            $html = $this->get('/nl/' . config("regions.items.{$regionKey}.slugs.nl"))->getContent();

            $this->assertStringNotContainsString($this->fixtureSlug('nl'), $html);
        }
    }

    public function test_published_project_appears_in_the_sitemap_and_resolves(): void
    {
        $this->publishFixture();

        $xml = $this->get('/sitemap.xml')->getContent();

        foreach (['nl', 'fr', 'en'] as $locale) {
            $this->assertStringContainsString(self::DOMAIN . $this->fixtureUrl($locale), $xml);
            $this->get($this->fixtureUrl($locale))->assertStatus(200);
        }
    }

    // ─────────────────────────────────────────────────────────────────────
    //  Helpers
    // ─────────────────────────────────────────────────────────────────────

    /**
     * Inject one fully-formed published project and re-register the routes, so
     * the entire published path is exercised even while the real site has
     * nothing published yet.
     *
     * @param  array<string, mixed>  $overrides
     */
    private function publishFixture(array $overrides = []): void
    {
        $image = 'assets/client/images/ramen/WhatsApp Image 2026-07-16 at 20.59.28 (1).webp';

        config(['projects.items.' . self::FIXTURE => array_merge([
            'status'  => 'published',
            'slugs'   => [
                'nl' => 'testproject-houten-ramen',
                'fr' => 'projet-test-fenetres-en-bois',
                'en' => 'test-project-wooden-windows',
            ],
            'service'          => 'ramen',
            'subservice'       => 'houten-ramen',
            'region'           => 'huldenberg',
            'year'             => '2026',
            'materials'        => ['Massief hout'],
            'work_type'        => 'renovation',
            'hero'             => $image,
            'gallery'          => [$image, $image, $image],
            'related_projects' => [],
            'evidence'         => 'Testfixture.',
            'missing'          => [],
        ], $overrides)]);

        foreach (['nl', 'fr', 'en'] as $locale) {
            Lang::addLines([
                'projects.items.' . self::FIXTURE . '.title'            => "Testproject ({$locale})",
                'projects.items.' . self::FIXTURE . '.intro'            => "Korte introductie van het testproject ({$locale}).",
                'projects.items.' . self::FIXTURE . '.hero_alt'         => "Hero van het testproject ({$locale})",
                'projects.items.' . self::FIXTURE . '.meta_title'       => "Testproject | Van Kerkhoven ({$locale})",
                'projects.items.' . self::FIXTURE . '.meta_description' => "Meta description voor het testproject ({$locale}).",
                'projects.items.' . self::FIXTURE . '.challenge'        => ['De uitgangssituatie.'],
                'projects.items.' . self::FIXTURE . '.approach'         => ['De aanpak.'],
                'projects.items.' . self::FIXTURE . '.result'           => ['Het resultaat.'],
                'projects.items.' . self::FIXTURE . '.gallery_alts'     => [
                    'Detailfoto van het raamprofiel',
                    'Tweede foto van het project',
                    'Derde foto van het project',
                ],
            ], $locale);
        }
    }

    private function fixtureSlug(string $locale): string
    {
        return config('projects.items.' . self::FIXTURE . '.slugs.' . $locale);
    }

    private function fixtureUrl(string $locale): string
    {
        return '/' . $locale . '/' . self::INDEX_SLUGS[$locale] . '/' . $this->fixtureSlug($locale);
    }

    private function pageGraph(string $path): array
    {
        preg_match_all(
            '#<script type="application/ld\+json">(.*?)</script>#s',
            $this->get($path)->getContent(),
            $matches
        );

        foreach ($matches[1] as $block) {
            $decoded = json_decode(trim($block), true);
            $this->assertSame(JSON_ERROR_NONE, json_last_error(), "Invalid JSON-LD on {$path}.");

            if (isset($decoded['@graph'])) {
                return $decoded;
            }
        }

        $this->fail("No @graph JSON-LD block on {$path}.");
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

    public static function localeProvider(): array
    {
        return ['nl' => ['nl'], 'fr' => ['fr'], 'en' => ['en']];
    }
}

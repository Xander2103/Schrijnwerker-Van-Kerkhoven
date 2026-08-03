<?php

namespace App\Http\Controllers;

use App\Support\Projects;
use App\Support\Regions;
use App\Support\ServicePages;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    private const LOCALES = ['nl', 'fr', 'en'];

    /**
     * Real, routable pages only (see routes/web.php) — one entry per logical
     * page, with its actual per-locale slug. Poorten/schuiframen use a
     * different slug per language; everything else shares the same slug.
     * The homepage is represented by an empty slug.
     */
    private const PAGES = [
        ['nl' => '',               'fr' => '',               'en' => ''],
        ['nl' => 'ramen',          'fr' => 'ramen',          'en' => 'ramen'],
        ['nl' => 'deuren',         'fr' => 'deuren',         'en' => 'deuren'],
        ['nl' => 'trappen',        'fr' => 'trappen',        'en' => 'trappen'],
        ['nl' => 'poorten',        'fr' => 'portails',       'en' => 'gates'],
        ['nl' => 'schuiframen',    'fr' => 'coulissants',    'en' => 'sliding-windows'],
        ['nl' => 'werkplaats',     'fr' => 'werkplaats',     'en' => 'werkplaats'],
        ['nl' => 'privacy-policy', 'fr' => 'privacy-policy', 'en' => 'privacy-policy'],
        ['nl' => 'contact',        'fr' => 'contact',        'en' => 'contact'],
    ];

    /**
     * The static list above plus one entry per local landing page and per
     * service page, taken straight from config/regions.php and
     * config/service-pages.php so a new page never has to be registered here
     * a second time.
     *
     * @return array<int, array<string, string>>
     */
    private function pages(): array
    {
        $pages = self::PAGES;

        foreach ([...Regions::all(), ...ServicePages::all()] as $entry) {
            $slugs = [];

            foreach (self::LOCALES as $locale) {
                $slugs[$locale] = $entry['slugs'][$locale];
            }

            $pages[] = $slugs;
        }

        // Realisatie-index, plus one entry per published project. Drafts have
        // no route, so they must never reach the sitemap either.
        $pages[] = array_map(
            static fn (string $locale): string => Projects::indexSlug($locale),
            array_combine(self::LOCALES, self::LOCALES)
        );

        foreach (Projects::published() as $project) {
            $slugs = [];

            foreach (self::LOCALES as $locale) {
                $slugs[$locale] = Projects::indexSlug($locale) . '/' . $project['slugs'][$locale];
            }

            $pages[] = $slugs;
        }

        return $pages;
    }

    public function index(): Response
    {
        $appUrl = rtrim((string) config('app.url'), '/');
        $urls = [];

        foreach ($this->pages() as $page) {
            $alternates = [];

            foreach (self::LOCALES as $locale) {
                $slug = $page[$locale];
                $path = $slug === '' ? "/{$locale}" : "/{$locale}/{$slug}";
                $alternates[$locale] = $appUrl . $path;
            }

            foreach (self::LOCALES as $locale) {
                $urls[] = [
                    'loc'        => $alternates[$locale],
                    'alternates' => $alternates,
                ];
            }
        }

        return response(view('sitemap', ['urls' => $urls])->render(), 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}

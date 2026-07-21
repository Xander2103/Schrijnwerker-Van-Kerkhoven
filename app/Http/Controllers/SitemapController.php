<?php

namespace App\Http\Controllers;

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

    public function index(): Response
    {
        $appUrl = rtrim((string) config('app.url'), '/');
        $urls = [];

        foreach (self::PAGES as $page) {
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

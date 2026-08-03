<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use App\Http\Middleware\SetLocale;
use App\Support\GalleryScanner;
use App\Support\Projects;
use App\Support\Regions;
use App\Support\ServicePages;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Sitemap
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Root → default locale redirect
|--------------------------------------------------------------------------
*/
Route::redirect('/', '/nl', 302);

/*
|--------------------------------------------------------------------------
| Legacy non-locale paths → permanent redirect to /nl/...
|--------------------------------------------------------------------------
*/
Route::redirect('/contact',     '/nl/contact',         301);
Route::redirect('/privacy',     '/nl/privacy-policy',  301);
Route::redirect('/ramen',       '/nl/ramen',           301);
Route::redirect('/deuren',      '/nl/deuren',          301);
Route::redirect('/trappen',     '/nl/trappen',         301);
Route::redirect('/werkplaats',  '/nl/werkplaats',      301);
Route::redirect('/houtsoorten', '/nl/werkplaats',      301);
Route::redirect('/werkhuis',    '/nl/werkplaats',      301);

/*
|--------------------------------------------------------------------------
| Localized routes  /{locale}/...
|--------------------------------------------------------------------------
*/
Route::prefix('{locale}')
    ->where(['locale' => 'nl|fr|en'])
    ->middleware(SetLocale::class)
    ->group(function (): void {

        // ── Homepage ────────────────────────────────────────────────────────
        Route::get('/', function (string $locale): mixed {
            return view('pages.home', [
                'galleryImages'    => GalleryScanner::scan(),
                'atelierImages'    => GalleryScanner::scan('atelier'),
                'historischImages' => GalleryScanner::scan('historisch'),
            ]);
        })->name('home');

        // ── Ramen ───────────────────────────────────────────────────────────
        Route::get('/ramen', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('ramen'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.ramen', compact('galleryImages'));
        })->name('ramen');

        // ── Deuren ──────────────────────────────────────────────────────────
        Route::get('/deuren', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('deuren'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.deuren', compact('galleryImages'));
        })->name('deuren');

        // ── Trappen ─────────────────────────────────────────────────────────
        Route::get('/trappen', function (string $locale): mixed {
            $galleryImages = GalleryScanner::scan('trap');
            return view('pages.trappen', compact('galleryImages'));
        })->name('trappen');

        // ── Poorten (NL slug) ───────────────────────────────────────────────
        Route::get('/poorten', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('poorten'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.poorten', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/' . $locale . '/poorten',
                    'fr' => '/fr/portails',
                    'en' => '/en/gates',
                ],
            ]);
        })->name('poorten');

        // ── Portails (FR slug) ──────────────────────────────────────────────
        Route::get('/portails', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('poorten'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.poorten', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/nl/poorten',
                    'fr' => '/' . $locale . '/portails',
                    'en' => '/en/gates',
                ],
            ]);
        })->name('portails');

        // ── Gates (EN slug) ─────────────────────────────────────────────────
        Route::get('/gates', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('poorten'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.poorten', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/nl/poorten',
                    'fr' => '/fr/portails',
                    'en' => '/' . $locale . '/gates',
                ],
            ]);
        })->name('gates');

        // ── Schuiframen (NL slug) ───────────────────────────────────────────
        Route::get('/schuiframen', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('schuiframen'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.schuiframen', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/' . $locale . '/schuiframen',
                    'fr' => '/fr/coulissants',
                    'en' => '/en/sliding-windows',
                ],
            ]);
        })->name('schuiframen');

        // ── Coulissants (FR slug) ───────────────────────────────────────────
        Route::get('/coulissants', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('schuiframen'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.schuiframen', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/nl/schuiframen',
                    'fr' => '/' . $locale . '/coulissants',
                    'en' => '/en/sliding-windows',
                ],
            ]);
        })->name('coulissants');

        // ── Sliding windows (EN slug) ───────────────────────────────────────
        Route::get('/sliding-windows', function (string $locale): mixed {
            $galleryImages = array_values(array_filter(
                GalleryScanner::scan('schuiframen'),
                fn($p) => !str_contains(basename($p), 'hero')
            ));
            return view('pages.schuiframen', [
                'galleryImages' => $galleryImages,
                'localeUrls'    => [
                    'nl' => '/nl/schuiframen',
                    'fr' => '/fr/coulissants',
                    'en' => '/' . $locale . '/sliding-windows',
                ],
            ]);
        })->name('sliding-windows');

        // ── Werkplaats ──────────────────────────────────────────────────────
        Route::get('/werkplaats', function (string $locale): mixed {
            return view('pages.werkplaats', [
                'atelierImages' => GalleryScanner::scan('atelier'),
            ]);
        })->name('werkplaats');

        // ── Privacy policy ──────────────────────────────────────────────────
        Route::get('/privacy-policy', function (string $locale): mixed {
            return view('pages.privacy');
        })->name('privacy');

        // ── Contact GET ─────────────────────────────────────────────────────
        Route::get('/contact', [ContactController::class, 'show'])->name('contact');

        // ── Contact POST ────────────────────────────────────────────────────
        Route::post('/contact', [ContactController::class, 'store'])
            ->middleware('throttle:contact')
            ->name('contact.submit');

        // ── Realisaties ─────────────────────────────────────────────────────
        // Index + projectpagina's. Beide staan vóór de catch-all routes
        // hieronder; de projectroute heeft twee segmenten en kan er dus
        // sowieso niet mee botsen. De constraint bevat uitsluitend
        // gepubliceerde slugs, zodat drafts geen route hebben.
        Route::get('/{index}', [ProjectController::class, 'index'])
            ->where('index', Projects::indexRouteConstraint())
            ->name('projects.index');

        Route::get('/{index}/{project}', [ProjectController::class, 'show'])
            ->where('index', Projects::indexRouteConstraint())
            ->where('project', Projects::routeConstraint())
            ->name('projects.show');

        // ── Lokale regiopagina's ────────────────────────────────────────────
        // Eén route voor alle zes regio's × drie talen. De constraint komt uit
        // config/regions.php, zodat deze route nooit een andere pad opslokt;
        // RegionController geeft 404 wanneer de slug niet bij de taal hoort.
        // Staat bewust als laatste, ná alle statische slugs hierboven.
        Route::get('/{region}', [RegionController::class, 'show'])
            ->where('region', Regions::routeConstraint())
            ->name('region');

        // ── Verdiepende dienstenpagina's ────────────────────────────────────
        // Zelfde patroon als de regiopagina's: één route, constraint uit
        // config/service-pages.php, en 404 wanneer de slug niet bij de taal
        // hoort. De slugverzamelingen van beide routes zijn disjunct.
        Route::get('/{service}', [ServiceController::class, 'show'])
            ->where('service', ServicePages::routeConstraint())
            ->name('service');
    });

<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
use App\Http\Middleware\SetLocale;
use App\Support\GalleryScanner;
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
    });

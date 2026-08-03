<?php

namespace App\Http\Controllers;

use App\Support\GalleryScanner;
use App\Support\Regions;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RegionController extends Controller
{
    /**
     * Render one local landing page.
     *
     * The route constraint already limits {region} to known slugs, but a slug
     * from another language (e.g. /nl/menuisier-leuven) still reaches us — that
     * must 404 so no duplicate ends up in the index.
     */
    public function show(string $locale, string $region): View
    {
        $data = Regions::find($locale, $region);

        if ($data === null) {
            throw new NotFoundHttpException();
        }

        $gallery = array_slice(
            array_values(array_filter(
                GalleryScanner::scan($data['gallery']),
                static fn (string $path): bool => !str_contains(basename($path), 'hero')
            )),
            0,
            (int) config('regions.gallery_limit', 6)
        );

        return view('pages.regio', [
            'region'        => $data,
            'regionKey'     => $data['key'],
            'localeUrls'    => Regions::localeUrls($data),
            'otherRegions'  => array_values(array_filter(
                Regions::links($locale),
                static fn (array $link): bool => $link['key'] !== $data['key']
            )),
            'galleryImages' => $gallery,
            'ogImage'       => '/' . ltrim($data['hero'], '/'),
        ]);
    }
}

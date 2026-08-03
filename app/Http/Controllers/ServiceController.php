<?php

namespace App\Http\Controllers;

use App\Support\GalleryScanner;
use App\Support\ServicePages;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ServiceController extends Controller
{
    /**
     * Render one deeper service page.
     *
     * The route constraint already limits {service} to known slugs, but a slug
     * belonging to another language (e.g. /nl/interior-doors) still lands here
     * and must 404 — otherwise the same page becomes indexable three times per
     * language.
     */
    public function show(string $locale, string $service): View
    {
        $data = ServicePages::find($locale, $service);

        if ($data === null) {
            throw new NotFoundHttpException();
        }

        return view('pages.dienst', [
            'service'       => $data,
            'serviceKey'    => $data['key'],
            'localeUrls'    => ServicePages::localeUrls($data),
            'parentLink'    => $data['parent'] === null
                ? null
                : ServicePages::links([$data['parent']], $locale)[0] ?? null,
            'relatedLinks'  => ServicePages::links($data['related'], $locale),
            'galleryImages' => $this->gallery($data),
            'ogImage'       => '/' . ltrim($data['hero'], '/'),
        ]);
    }

    /**
     * Existing photos for this service, or an empty list when the archive has
     * nothing that honestly illustrates it.
     *
     * @param  array<string, mixed>  $service
     * @return array<int, string>
     */
    private function gallery(array $service): array
    {
        if (empty($service['gallery'])) {
            return [];
        }

        $images = array_values(array_filter(
            GalleryScanner::scan($service['gallery']),
            static fn (string $path): bool => !str_contains(basename($path), 'hero')
        ));

        return array_slice(
            $images,
            (int) ($service['gallery_offset'] ?? 0),
            (int) config('service-pages.gallery_limit', 6)
        );
    }
}

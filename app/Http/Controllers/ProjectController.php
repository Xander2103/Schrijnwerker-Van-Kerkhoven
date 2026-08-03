<?php

namespace App\Http\Controllers;

use App\Support\Projects;
use App\Support\Regions;
use App\Support\ServicePages;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectController extends Controller
{
    /**
     * The realisation index. Renders an explicit empty state rather than a
     * broken page when nothing is published yet.
     */
    public function index(Request $request, string $locale, string $index): View
    {
        $this->assertIndexSlug($locale, $index);

        $cards   = Projects::cards($locale);
        $perPage = (int) config('projects.per_page', 12);
        $page    = max(1, (int) $request->query('page', 1));
        $pages   = max(1, (int) ceil(count($cards) / $perPage));

        if ($page > $pages) {
            throw new NotFoundHttpException();
        }

        return view('pages.realisaties', [
            'cards'       => array_slice($cards, ($page - 1) * $perPage, $perPage),
            'totalCards'  => count($cards),
            'currentPage' => $page,
            'totalPages'  => $pages,
            'localeUrls'  => Projects::indexLocaleUrls(),
        ]);
    }

    /**
     * One project page.
     *
     * The route constraint already limits {project} to published slugs, but a
     * slug belonging to another language still lands here and must 404 — as
     * must any draft, which never appears in Projects::find() at all.
     */
    public function show(Request $request, string $locale, string $index, string $project): View
    {
        $this->assertIndexSlug($locale, $index);

        $data = Projects::find($locale, $project);

        if ($data === null) {
            throw new NotFoundHttpException();
        }

        $services = array_values(array_filter([
            $data['service'],
            $data['subservice'] ?? null,
        ]));

        return view('pages.project', [
            'project'       => $data,
            'projectKey'    => $data['key'],
            'localeUrls'    => Projects::localeUrls($data),
            'serviceLinks'  => ServicePages::links($services, $locale),
            'regionLink'    => empty($data['region']) ? null : [
                'key'  => $data['region'],
                'name' => Regions::name($data['region'], $locale),
                'url'  => '/' . $locale . '/' . config("regions.items.{$data['region']}.slugs.{$locale}"),
            ],
            'relatedCards'  => Projects::related($data['key'], $locale),
            'indexUrl'      => Projects::indexUrl($locale),
            'ogImage'       => '/' . ltrim($data['hero'], '/'),
        ]);
    }

    /**
     * The index segment is part of the URL, so /nl/realisations/... would
     * otherwise render the Dutch page under a French path.
     */
    private function assertIndexSlug(string $locale, string $index): void
    {
        if ($index !== Projects::indexSlug($locale)) {
            throw new NotFoundHttpException();
        }
    }
}

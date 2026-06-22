<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    private const LOCALES = ['nl', 'fr', 'en'];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale', 'nl');

        if (!in_array($locale, self::LOCALES, true)) {
            $locale = 'nl';
        }

        App::setLocale($locale);

        // Build locale-switcher URLs by swapping the locale segment in the path.
        // e.g. "nl/contact" → ["nl" => "/nl/contact", "fr" => "/fr/contact", ...]
        $path = $request->path(); // e.g. "nl" or "nl/contact"
        $localeUrls = [];
        foreach (self::LOCALES as $l) {
            $swapped = preg_replace('/^(nl|fr|en)(\/|$)/', $l . '$2', $path, 1);
            $localeUrls[$l] = '/' . $swapped;
        }

        View::share('locale', $locale);
        View::share('localeUrls', $localeUrls);

        return $next($request);
    }
}

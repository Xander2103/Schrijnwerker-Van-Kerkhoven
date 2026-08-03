<?php

namespace App\Support;

/**
 * Read-only helper around config/regions.php.
 *
 * Everything that needs to know about the local landing pages — the route
 * constraint, the controller, the sitemap and the "Werkregio" section — goes
 * through here, so a region is only ever declared once (in the config file).
 */
class Regions
{
    public const LOCALES = ['nl', 'fr', 'en'];

    /**
     * @return array<string, array{name: string, slugs: array<string, string>, hero: string, gallery: string}>
     */
    public static function all(): array
    {
        return (array) config('regions.items', []);
    }

    /**
     * The region a (locale, slug) pair points at, or null when the slug does
     * not belong to that locale — e.g. /nl/menuisier-leuven. Those must 404
     * rather than render a duplicate under the wrong language.
     *
     * @return array{key: string, name: string, slugs: array<string, string>, hero: string, gallery: string}|null
     */
    public static function find(string $locale, string $slug): ?array
    {
        foreach (self::all() as $key => $region) {
            if (($region['slugs'][$locale] ?? null) === $slug) {
                return ['key' => $key] + $region;
            }
        }

        return null;
    }

    /**
     * Every region slug across every locale — used to constrain the catch-all
     * route so it can never swallow an unrelated path.
     *
     * @return array<int, string>
     */
    public static function allSlugs(): array
    {
        $slugs = [];

        foreach (self::all() as $region) {
            foreach ($region['slugs'] as $slug) {
                $slugs[] = $slug;
            }
        }

        return array_values(array_unique($slugs));
    }

    /**
     * Regex alternation for Route::where(). Anchored by Laravel itself.
     */
    public static function routeConstraint(): string
    {
        return implode('|', array_map(
            static fn (string $slug): string => preg_quote($slug, '/'),
            self::allSlugs()
        ));
    }

    /**
     * "/{locale}/{slug}" for every locale of a single region.
     *
     * @param  array<string, mixed>  $region
     * @return array<string, string>
     */
    public static function localeUrls(array $region): array
    {
        $urls = [];

        foreach (self::LOCALES as $locale) {
            $urls[$locale] = '/' . $locale . '/' . $region['slugs'][$locale];
        }

        return $urls;
    }

    /**
     * Display name in the given locale. Only Leuven actually differs (Louvain
     * in French), but going through the translation files keeps the exception
     * out of the code.
     */
    public static function name(string $key, string $locale): string
    {
        $translated = trans('regions.items.' . $key . '.name', [], $locale);

        return is_string($translated) && !str_starts_with($translated, 'regions.')
            ? $translated
            : (string) (config('regions.items.' . $key . '.name') ?? $key);
    }

    /**
     * Region links for the current locale, in config order.
     *
     * @return array<int, array{key: string, name: string, url: string}>
     */
    public static function links(string $locale): array
    {
        $links = [];

        foreach (self::all() as $key => $region) {
            $links[] = [
                'key'  => $key,
                'name' => self::name($key, $locale),
                'url'  => '/' . $locale . '/' . $region['slugs'][$locale],
            ];
        }

        return $links;
    }
}

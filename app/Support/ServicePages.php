<?php

namespace App\Support;

/**
 * Read-only helper around config/service-pages.php.
 *
 * Covers both the existing main pages (`core`) and the deeper service pages
 * (`items`), so anything that needs a service URL — the route constraint, the
 * controller, the sitemap, breadcrumbs, related-service blocks — resolves it
 * here instead of hard-coding a slug.
 */
class ServicePages
{
    public const LOCALES = ['nl', 'fr', 'en'];

    /**
     * The deeper service pages, in config order.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return (array) config('service-pages.items', []);
    }

    /**
     * The existing main pages, keyed by their key rather than list-indexed.
     *
     * @return array<string, array{slugs: array<string, string>}>
     */
    public static function core(): array
    {
        $core = [];

        foreach ((array) config('service-pages.core', []) as $page) {
            $core[$page['key']] = ['slugs' => $page['slugs']];
        }

        return $core;
    }

    /**
     * A (locale, slug) pair resolved to a service, or null when the slug
     * belongs to another language — /nl/interior-doors must 404 rather than
     * render a duplicate.
     *
     * @return array<string, mixed>|null
     */
    public static function find(string $locale, string $slug): ?array
    {
        foreach (self::all() as $key => $service) {
            if (($service['slugs'][$locale] ?? null) === $slug) {
                return ['key' => $key] + $service;
            }
        }

        return null;
    }

    /**
     * Every service slug across every locale, for the route constraint.
     *
     * @return array<int, string>
     */
    public static function allSlugs(): array
    {
        $slugs = [];

        foreach (self::all() as $service) {
            foreach ($service['slugs'] as $slug) {
                $slugs[] = $slug;
            }
        }

        return array_values(array_unique($slugs));
    }

    public static function routeConstraint(): string
    {
        return implode('|', array_map(
            static fn (string $slug): string => preg_quote($slug, '/'),
            self::allSlugs()
        ));
    }

    /**
     * "/{locale}/{slug}" for every locale of one service.
     *
     * @param  array<string, mixed>  $service
     * @return array<string, string>
     */
    public static function localeUrls(array $service): array
    {
        $urls = [];

        foreach (self::LOCALES as $locale) {
            $urls[$locale] = '/' . $locale . '/' . $service['slugs'][$locale];
        }

        return $urls;
    }

    /**
     * URL for any page key — a core page or a deeper service page.
     */
    public static function url(string $key, string $locale): ?string
    {
        $slugs = self::core()[$key]['slugs']
            ?? self::all()[$key]['slugs']
            ?? null;

        return $slugs === null ? null : '/' . $locale . '/' . $slugs[$locale];
    }

    /**
     * Label for any page key. Core pages reuse the labels the region pages
     * already publish; service pages use their own short name.
     */
    public static function label(string $key, string $locale): string
    {
        $core = trans('regions.common.service_labels.' . $key, [], $locale);

        if (is_string($core) && !str_starts_with($core, 'regions.')) {
            return $core;
        }

        $name = trans('service-pages.items.' . $key . '.name', [], $locale);

        return is_string($name) && !str_starts_with($name, 'service-pages.') ? $name : $key;
    }

    /**
     * Resolved link list for a set of page keys, skipping anything unknown.
     *
     * @param  array<int, string>  $keys
     * @return array<int, array{key: string, label: string, url: string}>
     */
    public static function links(array $keys, string $locale): array
    {
        $links = [];

        foreach ($keys as $key) {
            $url = self::url($key, $locale);

            if ($url !== null) {
                $links[] = [
                    'key'   => $key,
                    'label' => self::label($key, $locale),
                    'url'   => $url,
                ];
            }
        }

        return $links;
    }

    /**
     * The deeper services shown at the bottom of a given main page.
     *
     * @return array<int, array{key: string, label: string, url: string, teaser: string}>
     */
    public static function forCorePage(string $coreKey, string $locale): array
    {
        $keys = (array) config('service-pages.on_core_pages.' . $coreKey, []);

        return array_map(
            static fn (array $link): array => $link + [
                'teaser' => (string) trans('service-pages.items.' . $link['key'] . '.teaser', [], $locale),
            ],
            self::links($keys, $locale)
        );
    }
}

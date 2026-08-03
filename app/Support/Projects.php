<?php

namespace App\Support;

/**
 * Read-only helper around config/projects.php.
 *
 * Everything public goes through published(): the route constraint, the index,
 * the sitemap and every internal link. Drafts are only ever visible to
 * all() — which exists for the configuration tests and for tooling, never for
 * rendering.
 */
class Projects
{
    public const LOCALES = ['nl', 'fr', 'en'];

    /** Minimum number of photos before a project may go live. */
    public const MIN_PHOTOS = 3;

    /**
     * Every project, drafts included. Do not use this to render anything.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return (array) config('projects.items', []);
    }

    /**
     * Only the projects that may be shown publicly, in config order.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function published(): array
    {
        return array_filter(
            self::all(),
            static fn (array $project): bool => ($project['status'] ?? 'draft') === 'published'
        );
    }

    public static function hasPublished(): bool
    {
        return self::published() !== [];
    }

    /**
     * Resolve a (locale, slug) pair to a published project.
     *
     * Returns null for an unknown slug, for a draft, and for a slug that
     * belongs to another language — all three must 404.
     *
     * @return array<string, mixed>|null
     */
    public static function find(string $locale, string $slug): ?array
    {
        foreach (self::published() as $key => $project) {
            if (($project['slugs'][$locale] ?? null) === $slug) {
                return ['key' => $key] + $project;
            }
        }

        return null;
    }

    /**
     * Published project slugs across every locale, for the route constraint.
     *
     * @return array<int, string>
     */
    public static function publishedSlugs(): array
    {
        $slugs = [];

        foreach (self::published() as $project) {
            foreach ($project['slugs'] as $slug) {
                $slugs[] = $slug;
            }
        }

        return array_values(array_unique($slugs));
    }

    /**
     * Shape constraint for the {project} segment.
     *
     * Deliberately a slug shape rather than an alternation of published slugs:
     * route constraints are frozen at boot, so a published-slug list there
     * would go stale the moment config changes, while adding nothing. Whether
     * a slug actually resolves is decided per request by find(), which rejects
     * unknown slugs, drafts and slugs from another language alike.
     */
    public static function routeConstraint(): string
    {
        return '[a-z0-9]+(?:-[a-z0-9]+)*';
    }

    // ── Index ─────────────────────────────────────────────────────────────

    public static function indexSlug(string $locale): string
    {
        return (string) config('projects.index_slugs.' . $locale, 'realisaties');
    }

    public static function indexUrl(string $locale): string
    {
        return '/' . $locale . '/' . self::indexSlug($locale);
    }

    /** @return array<string, string> */
    public static function indexLocaleUrls(): array
    {
        $urls = [];

        foreach (self::LOCALES as $locale) {
            $urls[$locale] = self::indexUrl($locale);
        }

        return $urls;
    }

    public static function indexRouteConstraint(): string
    {
        return implode('|', array_map(
            static fn (string $slug): string => preg_quote($slug, '/'),
            array_unique(array_values((array) config('projects.index_slugs', [])))
        ));
    }

    // ── URLs ──────────────────────────────────────────────────────────────

    /**
     * "/{locale}/{index}/{slug}" for every locale of one project.
     *
     * @param  array<string, mixed>  $project
     * @return array<string, string>
     */
    public static function localeUrls(array $project): array
    {
        $urls = [];

        foreach (self::LOCALES as $locale) {
            $urls[$locale] = self::indexUrl($locale) . '/' . $project['slugs'][$locale];
        }

        return $urls;
    }

    public static function url(string $key, string $locale): ?string
    {
        $project = self::published()[$key] ?? null;

        return $project === null ? null : self::localeUrls($project)[$locale];
    }

    // ── Card data ─────────────────────────────────────────────────────────

    /**
     * Published projects shaped for the index and for card grids.
     *
     * @param  array<int, string>|null  $keys  restrict to these keys, in order
     * @return array<int, array<string, mixed>>
     */
    public static function cards(string $locale, ?array $keys = null): array
    {
        $source = self::published();

        if ($keys !== null) {
            $ordered = [];
            foreach ($keys as $key) {
                if (isset($source[$key])) {
                    $ordered[$key] = $source[$key];
                }
            }
            $source = $ordered;
        }

        $cards = [];

        foreach ($source as $key => $project) {
            $cards[] = [
                'key'          => $key,
                'title'        => (string) trans('projects.items.' . $key . '.title', [], $locale),
                'intro'        => (string) trans('projects.items.' . $key . '.intro', [], $locale),
                'url'          => self::localeUrls($project)[$locale],
                'hero'         => $project['hero'],
                'hero_alt'     => (string) trans('projects.items.' . $key . '.hero_alt', [], $locale),
                'service'      => $project['service'],
                'serviceLabel' => ServicePages::label($project['service'], $locale),
                'region'       => $project['region'] ?? null,
                'regionName'   => empty($project['region'])
                    ? null
                    : Regions::name($project['region'], $locale),
            ];
        }

        return $cards;
    }

    /**
     * Published projects tied to a service — either as primary service or as
     * subservice. Used by the "gerelateerde realisaties" blocks, which render
     * nothing at all when this comes back empty.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function forService(string $serviceKey, string $locale, int $limit = 3): array
    {
        $keys = [];

        foreach (self::published() as $key => $project) {
            if ($project['service'] === $serviceKey || ($project['subservice'] ?? null) === $serviceKey) {
                $keys[] = $key;
            }
        }

        return array_slice(self::cards($locale, $keys), 0, $limit);
    }

    /**
     * Published projects in a municipality. Only projects whose region has
     * actually been confirmed can ever appear here.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function forRegion(string $regionKey, string $locale, int $limit = 3): array
    {
        $keys = [];

        foreach (self::published() as $key => $project) {
            if (($project['region'] ?? null) === $regionKey) {
                $keys[] = $key;
            }
        }

        return array_slice(self::cards($locale, $keys), 0, $limit);
    }

    /**
     * Related projects for one project: the configured ones first, topped up
     * with other projects sharing the same service.
     *
     * @return array<int, array<string, mixed>>
     */
    public static function related(string $key, string $locale): array
    {
        $project = self::published()[$key] ?? null;

        if ($project === null) {
            return [];
        }

        $limit = (int) config('projects.related_limit', 3);
        $keys  = array_values(array_filter(
            $project['related_projects'] ?? [],
            static fn (string $other): bool => $other !== $key && isset(self::published()[$other])
        ));

        foreach (array_keys(self::published()) as $other) {
            if (count($keys) >= $limit) {
                break;
            }

            if ($other !== $key
                && !in_array($other, $keys, true)
                && self::published()[$other]['service'] === $project['service']) {
                $keys[] = $other;
            }
        }

        return self::cards($locale, array_slice($keys, 0, $limit));
    }
}

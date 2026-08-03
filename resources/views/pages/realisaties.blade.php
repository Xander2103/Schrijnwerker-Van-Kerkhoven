@extends('layouts.client')

@php
    $locale ??= 'nl';

    $pageTitle       = __('projects.common.index_meta_title');
    $pageDescription = __('projects.common.index_meta_description');

    $appUrl       = rtrim((string) config('app.url'), '/');
    $canonicalUrl = $appUrl . $localeUrls[$locale]
        . ($currentPage > 1 ? '?page=' . $currentPage : '');
    $homeUrl      = $appUrl . '/' . $locale;

    $crumbs = [
        ['label' => __('projects.common.breadcrumb_home'),  'url' => '/' . $locale],
        ['label' => __('projects.common.breadcrumb_index'), 'url' => null],
    ];
@endphp

@section('page_title', $pageTitle)
@section('page_description', $pageDescription)
@section('body_class', 'page-realisaties')

@section('content')

<section class="page-hero projects-index-hero">
    <div class="client-container">
        @include('partials.breadcrumbs', ['breadcrumbsAria' => __('projects.common.breadcrumb_aria')])

        <div class="page-hero-content">
            <span class="section-eyebrow">{{ __('projects.common.eyebrow') }}</span>
            <h1 class="page-hero-title">{{ __('projects.common.index_heading') }}</h1>
            <p class="page-hero-intro">{{ __('projects.common.index_intro') }}</p>
        </div>
    </div>
</section>

<section class="client-section projects-index-section">
    <div class="client-container">

        @if($totalCards > 0)
            @include('partials.project-cards')

            @if($totalPages > 1)
                <nav class="projects-pagination" aria-label="{{ __('projects.common.pagination_aria') }}">
                    @if($currentPage > 1)
                        <a href="{{ $localeUrls[$locale] }}?page={{ $currentPage - 1 }}" rel="prev" class="btn btn-secondary">
                            {{ __('projects.common.pagination_prev') }}
                        </a>
                    @endif

                    <span class="projects-pagination-status" aria-live="polite">
                        {{ __('projects.common.pagination_page', ['page' => $currentPage, 'total' => $totalPages]) }}
                    </span>

                    @if($currentPage < $totalPages)
                        <a href="{{ $localeUrls[$locale] }}?page={{ $currentPage + 1 }}" rel="next" class="btn btn-secondary">
                            {{ __('projects.common.pagination_next') }}
                        </a>
                    @endif
                </nav>
            @endif
        @else
            {{-- Geen verzonnen voorbeeldprojecten: liever een eerlijke lege staat. --}}
            <div class="projects-empty">
                <h2 class="page-intro-heading">{{ __('projects.common.index_empty_heading') }}</h2>
                <p>{{ __('projects.common.index_empty_text') }}</p>
                <div class="cta-row">
                    <a href="{{ \App\Support\ServicePages::url('werkplaats', $locale) }}" class="btn btn-secondary">
                        {{ __('projects.common.index_empty_cta') }}
                    </a>
                    <a href="/{{ $locale }}/contact" class="btn btn-primary">
                        {{ __('projects.common.cta_contact') }}
                    </a>
                </div>
            </div>
        @endif

    </div>
</section>

@endsection

@push('head')
@php
    $breadcrumbItems = [];
    foreach ($crumbs as $i => $crumb) {
        $item = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $crumb['label']];
        if (!empty($crumb['url'])) {
            $item['item'] = $appUrl . $crumb['url'];
        }
        $breadcrumbItems[] = $item;
    }

    $graph = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'       => 'CollectionPage',
                '@id'         => $canonicalUrl,
                'url'         => $canonicalUrl,
                'name'        => $pageTitle,
                'description' => $pageDescription,
                'inLanguage'  => ['nl' => 'nl-BE', 'fr' => 'fr-BE', 'en' => 'en'][$locale] ?? 'nl-BE',
                'isPartOf'    => ['@type' => 'WebSite', 'url' => $homeUrl, 'name' => config('site.name')],
                'breadcrumb'  => ['@id' => $canonicalUrl . '#breadcrumb'],
            ],
            [
                '@type'           => 'BreadcrumbList',
                '@id'             => $canonicalUrl . '#breadcrumb',
                'itemListElement' => $breadcrumbItems,
            ],
        ],
    ];

    // Alleen een ItemList publiceren wanneer er werkelijk iets in staat.
    if (count($cards) > 0) {
        $graph['@graph'][] = [
            '@type'           => 'ItemList',
            '@id'             => $canonicalUrl . '#projects',
            'numberOfItems'   => $totalCards,
            'itemListElement' => array_values(array_map(
                static fn (int $i, array $card): array => [
                    '@type'    => 'ListItem',
                    'position' => $i + 1,
                    'name'     => $card['title'],
                    'url'      => rtrim((string) config('app.url'), '/') . $card['url'],
                ],
                array_keys($cards),
                $cards
            )),
        ];
    }
@endphp
<script type="application/ld+json">
{!! json_encode($graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
</script>
@endpush

@extends('layouts.client')

@php
    $locale ??= 'nl';
    $t       = 'regions.items.' . $regionKey . '.';
    $city    = __($t . 'name');

    $pageTitle       = __($t . 'meta_title');
    $pageDescription = __($t . 'meta_description');

    // Same rule as layouts/client.blade.php, so the JSON-LD @id and the
    // <link rel="canonical"> can never point at different URLs.
    $appUrl        = rtrim((string) config('app.url'), '/');
    $canonicalPath = $localeUrls[$locale];
    $canonicalUrl  = $appUrl . $canonicalPath;
    $homeUrl       = $appUrl . '/' . $locale;

    $serviceLinks = [];
    foreach (config('service-pages.core', []) as $service) {
        $serviceLinks[$service['key']] = '/' . $locale . '/' . $service['slugs'][$locale];
    }

    $crumbs = [
        ['label' => __('regions.common.breadcrumb_home'), 'url' => '/' . $locale],
        ['label' => __($t . 'h1'),                        'url' => null],
    ];

    $heroPreload = $region['hero'];
    $galleryCategory = __('regions.common.service_labels.' . $region['gallery_service']);
@endphp

@section('page_title', $pageTitle)
@section('page_description', $pageDescription)
@section('body_class', 'page-regio')

@section('content')

{{-- ── Hero ───────────────────────────────────────────────────────────── --}}
<section
    class="page-hero page-hero--image region-hero"
    style="--page-hero-image: url('{{ asset($region['hero']) }}')"
>
    <div class="client-container">
        @include('partials.breadcrumbs')

        <div class="page-hero-content">
            <span class="section-eyebrow">{{ __('regions.common.eyebrow') }}</span>
            <h1 class="page-hero-title">{{ __($t . 'h1') }}</h1>
            <p class="page-hero-intro">{{ __($t . 'hero_intro') }}</p>

            <div class="cta-row">
                <a href="/{{ $locale }}/contact" class="btn btn-primary">
                    {{ __('regions.common.cta_contact') }}
                </a>
                <a href="{{ $serviceLinks['werkplaats'] }}" class="btn btn-secondary-light">
                    {{ __('regions.common.cta_realisaties') }}
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ── Lokale introductie ─────────────────────────────────────────────── --}}
<section class="client-section region-intro-section">
    <div class="client-container">
        <div class="page-intro-inner">

            <div class="page-intro-text">
                <h2 class="page-intro-heading">{{ __($t . 'intro_heading') }}</h2>
                @foreach(__($t . 'intro') as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>

            <div class="page-intro-highlights">
                <ul class="page-highlight-list" role="list">
                    @foreach(__($t . 'highlights') as $highlight)
                        <li>{{ $highlight }}</li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</section>

{{-- ── Diensten in deze regio ─────────────────────────────────────────── --}}
<section class="client-section-alt wood-bg-beige region-services-section">
    <div class="client-container">

        <div class="section-header">
            <h2 class="section-title">{{ __('regions.common.services_heading', ['city' => $city]) }}</h2>
            <p class="section-intro">{{ __($t . 'services_intro') }}</p>
        </div>

        <div class="region-services-grid">
            @foreach(__($t . 'services') as $key => $description)
                @php $label = __('regions.common.service_labels.' . $key); @endphp
                <article class="region-service-card">
                    <h3>{{ $label }}</h3>
                    <p>{{ $description }}</p>
                    <a href="{{ $serviceLinks[$key] }}" class="region-service-link">
                        {{ __('regions.common.service_link', ['service' => $label]) }}
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M6 4l4 4-4 4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </article>
            @endforeach
        </div>

    </div>
</section>

{{-- ── Werkwijze ──────────────────────────────────────────────────────── --}}
<section class="client-section region-steps-section">
    <div class="client-container">

        <div class="section-header">
            <h2 class="section-title">{{ __('werkwijze.heading') }}</h2>
            <p class="section-intro">{{ __($t . 'werkwijze_intro') }}</p>
        </div>

        <ol class="region-steps">
            @foreach(__('werkwijze.steps') as $i => $step)
                <li class="region-step">
                    <span class="region-step-number" aria-hidden="true">{{ $i + 1 }}</span>
                    <div>
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['text'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>

    </div>
</section>

{{-- ── Waarom lokaal werken ───────────────────────────────────────────── --}}
<section class="client-section-alt wood-bg-oak region-local-section">
    <div class="client-container">
        <div class="two-column-grid">

            <div class="page-intro-text">
                <h2 class="page-intro-heading">{{ __('regions.common.lokaal_heading') }}</h2>
                @foreach(__($t . 'lokaal') as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>

            <div class="info-card">
                <ul class="page-highlight-list" role="list">
                    @foreach(__($t . 'lokaal_points') as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</section>

{{-- ── Realisaties ────────────────────────────────────────────────────── --}}
@if(count($galleryImages) > 0)
    <section class="client-section region-gallery-section">
        <div class="client-container">

            <div class="section-header">
                <span class="section-eyebrow">{{ __('site.gallery_eyebrow') }}</span>
                <h2 class="section-title">{{ __('regions.common.realisaties_heading') }}</h2>
                <p class="section-intro">{{ __('regions.common.realisaties_note') }}</p>
            </div>

            <div class="region-gallery-grid">
                @foreach($galleryImages as $i => $path)
                    <figure class="region-gallery-item">
                        <img
                            src="{{ asset($path) }}"
                            alt="{{ __('regions.common.realisatie_alt', [
                                'category' => $galleryCategory,
                                'n'        => $i + 1,
                                'm'        => count($galleryImages),
                            ]) }}"
                            loading="lazy"
                            decoding="async"{!! \App\Support\ImageDimensions::attributes($path) !!}
                        >
                    </figure>
                @endforeach
            </div>

            <div class="section-actions">
                <a href="{{ $serviceLinks[$region['gallery_service']] }}" class="btn btn-secondary">
                    {{ __('regions.common.realisaties_link') }}
                </a>
            </div>

        </div>
    </section>
@endif

{{-- ── Gerelateerde realisaties — enkel met bevestigde gemeente ───────── --}}
@include('partials.related-projects', [
    'cards' => \App\Support\Projects::forRegion($regionKey, $locale),
])

{{-- ── FAQ ────────────────────────────────────────────────────────────── --}}
<section class="client-section-alt region-faq-section">
    <div class="client-container">

        <div class="section-header">
            <h2 class="section-title">{{ __('regions.common.faq_heading') }}</h2>
        </div>

        <div class="region-faq">
            @foreach(__($t . 'faq') as $item)
                <details class="region-faq-item">
                    <summary>
                        <span>{{ $item['q'] }}</span>
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M4 6l4 4 4-4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </summary>
                    <p>{{ $item['a'] }}</p>
                </details>
            @endforeach
        </div>

    </div>
</section>

{{-- ── Andere gemeenten ───────────────────────────────────────────────── --}}
<section class="client-section region-siblings-section">
    <div class="client-container">
        <h2 class="region-siblings-heading">{{ __('regions.common.other_regions_heading') }}</h2>
        <ul class="region-siblings-list" role="list">
            @foreach($otherRegions as $other)
                <li><a href="{{ $other['url'] }}">{{ $other['name'] }}</a></li>
            @endforeach
        </ul>
    </div>
</section>

{{-- ── Afsluitende CTA ────────────────────────────────────────────────── --}}
<section class="client-section-alt wood-bg-beige region-cta-section">
    <div class="client-container">
        <div class="page-cta-row">
            <div>
                <h2 class="page-cta-heading">{{ __($t . 'cta_heading') }}</h2>
                <p>{{ __($t . 'cta_text') }}</p>
            </div>
            <a href="/{{ $locale }}/contact" class="btn btn-primary">
                {{ __('regions.common.cta_contact') }}
            </a>
        </div>
    </div>
</section>

@endsection

@push('head')
@php
    $breadcrumbItems = [];
    foreach ($crumbs as $i => $crumb) {
        $item = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $crumb['label'],
        ];
        if (!empty($crumb['url'])) {
            $item['item'] = $appUrl . $crumb['url'];
        }
        $breadcrumbItems[] = $item;
    }

    $faqEntities = [];
    foreach (__($t . 'faq') as $item) {
        $faqEntities[] = [
            '@type'          => 'Question',
            'name'           => $item['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $item['a'],
            ],
        ];
    }

    // WebPage + BreadcrumbList + FAQPage. Deliberately no second LocalBusiness
    // node: there is one business, at one address, in Huldenberg.
    $graph = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type'       => 'WebPage',
                '@id'         => $canonicalUrl,
                'url'         => $canonicalUrl,
                'name'        => $pageTitle,
                'description' => $pageDescription,
                'inLanguage'  => ['nl' => 'nl-BE', 'fr' => 'fr-BE', 'en' => 'en'][$locale] ?? 'nl-BE',
                'isPartOf'    => ['@type' => 'WebSite', 'url' => $homeUrl, 'name' => config('site.name')],
                'breadcrumb'  => ['@id' => $canonicalUrl . '#breadcrumb'],
                'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => asset($region['hero'])],
            ],
            [
                '@type'           => 'BreadcrumbList',
                '@id'             => $canonicalUrl . '#breadcrumb',
                'itemListElement' => $breadcrumbItems,
            ],
            [
                '@type'      => 'FAQPage',
                '@id'        => $canonicalUrl . '#faq',
                'mainEntity' => $faqEntities,
            ],
        ],
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
</script>
@endpush

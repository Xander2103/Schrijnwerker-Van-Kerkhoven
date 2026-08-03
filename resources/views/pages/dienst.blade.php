@extends('layouts.client')

@php
    $locale ??= 'nl';
    $t       = 'service-pages.items.' . $serviceKey . '.';

    $pageTitle       = __($t . 'meta_title');
    $pageDescription = __($t . 'meta_description');

    // Same rule as layouts/client.blade.php, so the JSON-LD @id and the
    // <link rel="canonical"> can never point at different URLs.
    $appUrl       = rtrim((string) config('app.url'), '/');
    $canonicalUrl = $appUrl . $localeUrls[$locale];
    $homeUrl      = $appUrl . '/' . $locale;

    // The secondary hero CTA goes to the main page this service sits under;
    // services without a real parent fall back to their first related page.
    $secondaryLink = $parentLink ?? ($relatedLinks[0] ?? null);

    $heroPreload = $service['hero'];

    // Home > [Deuren] > Binnendeuren. No intermediate crumb is invented when
    // the service has no existing parent page.
    $crumbs = [['label' => __('service-pages.common.breadcrumb_home'), 'url' => '/' . $locale]];
    if ($parentLink !== null) {
        $crumbs[] = ['label' => $parentLink['label'], 'url' => $parentLink['url']];
    }
    $crumbs[] = ['label' => __($t . 'h1'), 'url' => null];
@endphp

@section('page_title', $pageTitle)
@section('page_description', $pageDescription)
@section('body_class', 'page-dienst')

@section('content')

{{-- ── Hero ───────────────────────────────────────────────────────────── --}}
<section
    class="page-hero page-hero--image service-hero"
    style="--page-hero-image: url('{{ asset($service['hero']) }}')"
>
    <div class="client-container">
        @include('partials.breadcrumbs', ['breadcrumbsAria' => __('service-pages.common.breadcrumb_aria')])

        <div class="page-hero-content">
            <span class="section-eyebrow">{{ __('service-pages.common.eyebrow') }}</span>
            <h1 class="page-hero-title">{{ __($t . 'h1') }}</h1>
            <p class="page-hero-intro">{{ __($t . 'hero_intro') }}</p>

            <div class="cta-row">
                <a href="/{{ $locale }}/contact" class="btn btn-primary">
                    {{ __('service-pages.common.cta_contact') }}
                </a>
                @if($secondaryLink)
                    <a href="{{ $secondaryLink['url'] }}" class="btn btn-secondary-light">
                        {{ __('service-pages.common.cta_secondary', ['service' => $secondaryLink['label']]) }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ── Wat houdt deze dienst in? ──────────────────────────────────────── --}}
<section class="client-section service-intro-section">
    <div class="client-container">
        <div class="page-intro-inner">

            <div class="page-intro-text">
                <h2 class="page-intro-heading">{{ __($t . 'what_heading') }}</h2>
                @foreach(__($t . 'what') as $paragraph)
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

{{-- ── Wanneer is dit interessant? ────────────────────────────────────── --}}
<section class="client-section-alt wood-bg-beige service-when-section">
    <div class="client-container">

        <div class="section-header">
            <h2 class="section-title">{{ __('service-pages.common.when_heading') }}</h2>
        </div>

        <div class="service-when-grid">
            @foreach(__($t . 'when') as $case)
                <article class="service-case-card">
                    <h3>{{ $case['title'] }}</h3>
                    <p>{{ $case['text'] }}</p>
                </article>
            @endforeach
        </div>

    </div>
</section>

{{-- ── Mogelijkheden en keuzes ────────────────────────────────────────── --}}
<section class="client-section service-options-section">
    <div class="client-container">

        <div class="section-header">
            <h2 class="section-title">{{ __('service-pages.common.options_heading') }}</h2>
        </div>

        <dl class="service-options">
            @foreach(__($t . 'options') as $option)
                <div class="service-option">
                    <dt>{{ $option['title'] }}</dt>
                    <dd>{{ $option['text'] }}</dd>
                </div>
            @endforeach
        </dl>

    </div>
</section>

{{-- ── Werkwijze ──────────────────────────────────────────────────────── --}}
<section class="client-section-alt wood-bg-oak service-steps-section">
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

{{-- ── Materialen en afwerking ────────────────────────────────────────── --}}
<section class="client-section service-materials-section">
    <div class="client-container">
        <div class="service-materials-inner">
            <h2 class="page-intro-heading">{{ __('service-pages.common.materials_heading') }}</h2>
            <div class="page-intro-text">
                @foreach(__($t . 'materials') as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── Realisaties ────────────────────────────────────────────────────── --}}
@if(count($galleryImages) > 0)
    <section class="client-section-alt service-gallery-section">
        <div class="client-container">

            <div class="section-header">
                <span class="section-eyebrow">{{ __('site.gallery_eyebrow') }}</span>
                <h2 class="section-title">{{ __('service-pages.common.realisaties_heading') }}</h2>
                <p class="section-intro">{{ __('service-pages.common.realisaties_note') }}</p>
            </div>

            <div class="region-gallery-grid">
                @foreach($galleryImages as $i => $path)
                    <figure class="region-gallery-item">
                        <img
                            src="{{ asset($path) }}"
                            alt="{{ __('service-pages.common.realisatie_alt', [
                                'n' => $i + 1,
                                'm' => count($galleryImages),
                            ]) }}"
                            loading="lazy"
                            decoding="async"{!! \App\Support\ImageDimensions::attributes($path) !!}
                        >
                    </figure>
                @endforeach
            </div>

        </div>
    </section>
@endif

{{-- ── FAQ ────────────────────────────────────────────────────────────── --}}
<section class="client-section service-faq-section">
    <div class="client-container">

        <div class="section-header">
            <h2 class="section-title">{{ __('service-pages.common.faq_heading') }}</h2>
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

{{-- ── Gerelateerde realisaties (rendert niets zonder gepubliceerd project) --}}
@include('partials.related-projects', [
    'cards' => \App\Support\Projects::forService($serviceKey, $locale),
])

{{-- ── Gerelateerde diensten ──────────────────────────────────────────── --}}
@if(count($relatedLinks) > 0)
    <section class="client-section-alt service-related-section">
        <div class="client-container">
            <h2 class="region-siblings-heading">{{ __('service-pages.common.related_heading') }}</h2>
            <ul class="region-siblings-list" role="list">
                @foreach($relatedLinks as $link)
                    <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </section>
@endif

{{-- ── Afsluitende CTA ────────────────────────────────────────────────── --}}
<section class="client-section wood-bg-beige service-cta-section">
    <div class="client-container">
        <div class="page-cta-row">
            <div>
                <h2 class="page-cta-heading">{{ __($t . 'cta_heading') }}</h2>
                <p>{{ __($t . 'cta_text') }}</p>
            </div>
            <a href="/{{ $locale }}/contact" class="btn btn-primary">
                {{ __('service-pages.common.cta_contact') }}
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
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']],
        ];
    }

    // WebPage + Service + BreadcrumbList + FAQPage. The Service node points at
    // the sitewide Carpenter block via `provider` rather than repeating the
    // business — there is one business, at one address. No offers, no price,
    // no rating, no areaServed: none of that is confirmed anywhere.
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
                'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => asset($service['hero'])],
            ],
            [
                '@type'       => 'Service',
                '@id'         => $canonicalUrl . '#service',
                'name'        => __($t . 'name'),
                'serviceType' => __($t . 'service_type'),
                'description' => __($t . 'teaser'),
                'url'         => $canonicalUrl,
                // Reference to the sitewide Carpenter block in the layout —
                // not a copy of it.
                'provider'    => ['@id' => url('/') . '#business'],
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

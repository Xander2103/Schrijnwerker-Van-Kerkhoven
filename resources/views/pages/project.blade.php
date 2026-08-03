@extends('layouts.client')

@php
    $locale ??= 'nl';
    $t       = 'projects.items.' . $projectKey . '.';

    $pageTitle       = __($t . 'meta_title');
    $pageDescription = __($t . 'meta_description');

    $appUrl       = rtrim((string) config('app.url'), '/');
    $canonicalUrl = $appUrl . $localeUrls[$locale];
    $homeUrl      = $appUrl . '/' . $locale;

    $heroPreload = $project['hero'];

    $crumbs = [
        ['label' => __('projects.common.breadcrumb_home'),  'url' => '/' . $locale],
        ['label' => __('projects.common.breadcrumb_index'), 'url' => $indexUrl],
        ['label' => __($t . 'title'),                       'url' => null],
    ];

    /*
     * Projectgegevens: alleen wat werkelijk bevestigd is. Een leeg veld wordt
     * niet getoond — geen streepje, geen "onbekend", geen lege rij.
     */
    $facts = [];
    foreach ($serviceLinks as $i => $link) {
        $facts[] = [
            'label' => __('projects.common.' . ($i === 0 ? 'label_service' : 'label_subservice')),
            'value' => $link['label'],
            'url'   => $link['url'],
        ];
    }
    if ($regionLink !== null) {
        $facts[] = ['label' => __('projects.common.label_region'), 'value' => $regionLink['name'], 'url' => $regionLink['url']];
    }
    if (!empty($project['work_type'])) {
        $facts[] = ['label' => __('projects.common.label_work_type'), 'value' => __('projects.common.work_type_' . $project['work_type']), 'url' => null];
    }
    if (!empty($project['materials'])) {
        $facts[] = ['label' => __('projects.common.label_materials'), 'value' => implode(', ', $project['materials']), 'url' => null];
    }
    if (!empty($project['year'])) {
        $facts[] = ['label' => __('projects.common.label_year'), 'value' => $project['year'], 'url' => null];
    }

    // Optionele blokken: alleen renderen als de vertaling ze aanlevert.
    $execution  = __($t . 'execution');
    $highlights = __($t . 'highlights');
    $faq        = __($t . 'faq');
    $execution  = is_array($execution) ? $execution : [];
    $highlights = is_array($highlights) ? $highlights : [];
    $faq        = is_array($faq) ? $faq : [];

    $galleryAlts   = __($t . 'gallery_alts');
    $galleryAlts   = is_array($galleryAlts) ? $galleryAlts : [];
    $galleryImages = $project['gallery'];
    $galleryTitle  = __('projects.common.gallery_heading');

    // De hero is een CSS-achtergrond bovenaan; de galerij staat altijd onder
    // de vouw, dus elke foto daar mag lazy laden.
    $galleryEagerCount = 0;
@endphp

@section('page_title', $pageTitle)
@section('page_description', $pageDescription)
@section('body_class', 'page-project')

@section('content')

{{-- ── Hero ───────────────────────────────────────────────────────────── --}}
<section
    class="page-hero page-hero--image project-hero"
    style="--page-hero-image: url('{{ asset($project['hero']) }}')"
>
    <div class="client-container">
        @include('partials.breadcrumbs', ['breadcrumbsAria' => __('projects.common.breadcrumb_aria')])

        <div class="page-hero-content">
            <span class="section-eyebrow">
                {{ $serviceLinks[0]['label'] ?? __('projects.common.eyebrow') }}@if($regionLink) · {{ $regionLink['name'] }}@endif
            </span>
            <h1 class="page-hero-title">{{ __($t . 'title') }}</h1>
            <p class="page-hero-intro">{{ __($t . 'intro') }}</p>

            <div class="cta-row">
                <a href="/{{ $locale }}/contact" class="btn btn-primary">
                    {{ __('projects.common.cta_contact') }}
                </a>
                @if(isset($serviceLinks[0]))
                    <a href="{{ $serviceLinks[0]['url'] }}" class="btn btn-secondary-light">
                        {{ $serviceLinks[0]['label'] }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ── Projectgegevens ────────────────────────────────────────────────── --}}
@if(count($facts) > 0)
    <section class="client-section-alt wood-bg-beige project-facts-section">
        <div class="client-container">
            <h2 class="region-siblings-heading">{{ __('projects.common.overview_heading') }}</h2>
            <dl class="project-facts">
                @foreach($facts as $fact)
                    <div class="project-fact">
                        <dt>{{ $fact['label'] }}</dt>
                        <dd>
                            @if($fact['url'])
                                <a href="{{ $fact['url'] }}">{{ $fact['value'] }}</a>
                            @else
                                {{ $fact['value'] }}
                            @endif
                        </dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>
@endif

{{-- ── Uitgangssituatie / aanpak / uitvoering / resultaat ─────────────── --}}
<section class="client-section project-story-section">
    <div class="client-container">
        <div class="project-story">

            <div class="page-intro-text">
                <h2 class="page-intro-heading">{{ __('projects.common.challenge_heading') }}</h2>
                @foreach(__($t . 'challenge') as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach

                <h2 class="page-intro-heading">{{ __('projects.common.approach_heading') }}</h2>
                @foreach(__($t . 'approach') as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach

                @if(count($execution) > 0)
                    <h2 class="page-intro-heading">{{ __('projects.common.execution_heading') }}</h2>
                    @foreach($execution as $paragraph)
                        <p>{{ $paragraph }}</p>
                    @endforeach
                @endif

                <h2 class="page-intro-heading">{{ __('projects.common.result_heading') }}</h2>
                @foreach(__($t . 'result') as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>

            @if(count($highlights) > 0)
                <aside class="project-highlights info-card">
                    <ul class="page-highlight-list" role="list">
                        @foreach($highlights as $highlight)
                            <li>{{ $highlight }}</li>
                        @endforeach
                    </ul>
                </aside>
            @endif

        </div>
    </div>
</section>

{{-- ── Fotogalerij — hergebruikt de bestaande galerij en lightbox ─────── --}}
@include('partials.realisaties-gallery')

{{-- ── FAQ ────────────────────────────────────────────────────────────── --}}
@if(count($faq) > 0)
    <section class="client-section-alt project-faq-section">
        <div class="client-container">
            <div class="section-header">
                <h2 class="section-title">{{ __('projects.common.faq_heading') }}</h2>
            </div>
            <div class="region-faq">
                @foreach($faq as $item)
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
@endif

{{-- ── Gerelateerde diensten ──────────────────────────────────────────── --}}
<section class="client-section project-services-section">
    <div class="client-container">
        <h2 class="region-siblings-heading">{{ __('projects.common.services_heading') }}</h2>
        <ul class="region-siblings-list" role="list">
            @foreach($serviceLinks as $link)
                <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
            @endforeach
            @if($regionLink)
                <li><a href="{{ $regionLink['url'] }}">{{ $regionLink['name'] }}</a></li>
            @endif
            <li><a href="{{ $indexUrl }}">{{ __('projects.common.back_to_index') }}</a></li>
        </ul>
    </div>
</section>

{{-- ── Andere realisaties ─────────────────────────────────────────────── --}}
@if(count($relatedCards) > 0)
    <section class="client-section-alt project-related-section">
        <div class="client-container">
            <div class="section-header">
                <h2 class="section-title">{{ __('projects.common.related_heading') }}</h2>
            </div>
            @include('partials.project-cards', ['cards' => $relatedCards])
        </div>
    </section>
@endif

{{-- ── CTA ────────────────────────────────────────────────────────────── --}}
<section class="client-section wood-bg-beige project-cta-section">
    <div class="client-container">
        <div class="page-cta-row">
            <div>
                <h2 class="page-cta-heading">{{ __('projects.common.cta_heading') }}</h2>
                <p>{{ __('projects.common.cta_text') }}</p>
            </div>
            <a href="/{{ $locale }}/contact" class="btn btn-primary">
                {{ __('projects.common.cta_contact') }}
            </a>
        </div>
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

    /*
     * WebPage + ImageObject + CreativeWork + BreadcrumbList.
     *
     * CreativeWork past hier semantisch: een op maat gemaakt, uitgevoerd stuk
     * schrijnwerk. Bewust géén Product (het is geen aanbod), géén Offer, géén
     * prijs, géén rating, géén klantnaam of adres. `dateCreated` en `material`
     * worden alleen toegevoegd wanneer ze in de config bevestigd staan.
     */
    $creativeWork = [
        '@type'       => 'CreativeWork',
        '@id'         => $canonicalUrl . '#project',
        'name'        => __($t . 'title'),
        'description' => __($t . 'intro'),
        'url'         => $canonicalUrl,
        'image'       => ['@id' => $canonicalUrl . '#primaryimage'],
        'creator'     => ['@id' => url('/') . '#business'],
        'about'       => ['@id' => $appUrl . ($serviceLinks[0]['url'] ?? '') . '#service'],
    ];

    if (!empty($project['year'])) {
        $creativeWork['dateCreated'] = (string) $project['year'];
    }

    if (!empty($project['materials'])) {
        $creativeWork['material'] = $project['materials'];
    }

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
                'primaryImageOfPage' => ['@id' => $canonicalUrl . '#primaryimage'],
                'mainEntity'  => ['@id' => $canonicalUrl . '#project'],
            ],
            [
                '@type'       => 'ImageObject',
                '@id'         => $canonicalUrl . '#primaryimage',
                'url'         => asset($project['hero']),
                'contentUrl'  => asset($project['hero']),
                'description' => __($t . 'hero_alt'),
            ],
            $creativeWork,
            [
                '@type'           => 'BreadcrumbList',
                '@id'             => $canonicalUrl . '#breadcrumb',
                'itemListElement' => $breadcrumbItems,
            ],
        ],
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
</script>
@endpush

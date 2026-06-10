@extends('layouts.client')

@section('page_title', 'Massief hout — Houtsoorten bij Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Van Kerkhoven werkt uitsluitend met massief hout. Ontdek onze houtsoorten: Afzelia, Afrormosia, Beukenhout, Eik / Franse eik en Meranti voor ramen, deuren en trappen op maat.')

@section('content')

{{-- ─── Page hero ───────────────────────────────────────────────── --}}
<section class="client-section houtsoorten-hero wood-bg-sand">
    <div class="client-container">
        <div class="section-header">
            <a href="/" class="page-back-link" style="justify-content:center;margin-bottom:1.5rem;" aria-label="Terug naar home">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Terug naar home
            </a>
            <span class="section-eyebrow">Materialen</span>
            <h1 class="section-title">Onze houtsoorten</h1>
            <p class="section-intro">
                Bij Van Kerkhoven werken we uitsluitend met massief hout. Binnen die hoofdsoort bieden we verschillende houttypes aan, elk met hun eigen uitstraling, eigenschappen en toepassingen.
            </p>
        </div>
    </div>
</section>

{{-- ─── Massief hout: hoofdsoort intro ─────────────────────────────── --}}
<section class="client-section">
    <div class="client-container">
        <div class="massief-intro-block reveal">
            <span class="section-eyebrow">Hoofdsoort</span>
            <h2 style="font-family:var(--font-serif,serif);font-size:1.75rem;font-weight:700;color:var(--color-text);margin-bottom:0;">Massief hout</h2>
            <p class="massief-intro-text">{{ $massieHoutBeschrijving }}</p>
        </div>
    </div>
</section>

{{-- ─── Houtsoorten grid ────────────────────────────────────────────── --}}
<section class="client-section-alt wood-bg-ivory">
    <div class="client-container">

        <div class="section-header reveal">
            <span class="section-eyebrow">Houtsoorten</span>
            <h2 class="section-title">Soorten binnen massief hout</h2>
            <p class="section-intro">Afhankelijk van de toepassing, uw stijl en het budget adviseren wij de meest geschikte houtsoort voor uw project.</p>
        </div>

        <div class="wood-types-grid reveal-stagger">
            @foreach($woodTypes as $wood)
                <article class="wood-type-card reveal">

                    <div class="wood-type-image wood-type-image-fallback"
                         @if(!empty($wood['image']))
                             style="background-image:url('{{ asset($wood['image']) }}');background-color:{{ $wood['tone_color'] }}20;"
                         @else
                             style="background: linear-gradient(135deg, {{ $wood['tone_color'] }}55 0%, {{ $wood['tone_color'] }}22 100%);"
                         @endif
                         role="img"
                         aria-label="{{ $wood['name'] }} kleur- en nerfindicatie"
                    ></div>

                    <div class="wood-type-body">
                        <h2 class="wood-type-name">{{ $wood['name'] }}</h2>
                        <p class="wood-type-description">{{ $wood['description'] }}</p>

                        <div class="wood-type-meta">
                            <p class="wood-meta-label">Geschikt voor</p>
                            <ul class="wood-best-for-list" role="list">
                                @foreach($wood['best_for'] as $use)
                                    <li>{{ $use }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <p class="wood-tone-note">
                            <span class="wood-tone-dot" style="background-color:{{ $wood['tone_color'] }};" aria-hidden="true"></span>
                            {{ $wood['tone'] }}
                        </p>
                    </div>

                </article>
            @endforeach
        </div>

        <div class="section-actions" style="margin-top:3.5rem;">
            @if(!empty(config('site.cta_primary')))
                <a href="/#contact" class="btn btn-primary">{{ config('site.cta_primary') }}</a>
            @endif
            <a href="/" class="btn btn-secondary">Terug naar home</a>
        </div>

    </div>
</section>

@endsection

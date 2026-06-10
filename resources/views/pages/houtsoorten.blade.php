@extends('layouts.client')

@section('page_title', 'Massief hout — Houtsoorten bij Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Van Kerkhoven werkt uitsluitend met massief hout. Ontdek onze houtsoorten: Afzelia, Afrormosia, Beukenhout, Eerste keus (Franse eik) en Meranti voor ramen, deuren en trappen op maat.')

@section('content')

{{-- ─── Compact page hero ───────────────────────────────────────── --}}
<section class="houtsoorten-hero section-compact wood-bg-sand">
    <div class="client-container">
        <a href="/" class="page-back-link" aria-label="Terug naar home">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Terug naar home
        </a>
        <div class="hout-hero-content">
            <span class="section-eyebrow">Materialen</span>
            <h1 class="section-title" style="margin-bottom:0.5rem;">Onze houtsoorten</h1>
            <p class="section-intro" style="margin:0;">
                Bij Van Kerkhoven werken we uitsluitend met massief hout — elk type heeft zijn eigen karakter, sterkte en toepassing.
            </p>
        </div>
    </div>
</section>

{{-- ─── Massief hout hub card ───────────────────────────────────── --}}
<section class="client-section massief-hub-section">
    <div class="client-container">

        <div class="massief-hub-card reveal">
            <div class="massief-hub-inner">
                @if(!empty(config('images.about')) && file_exists(public_path(config('images.about'))))
                    <div class="massief-hub-image"
                         style="background-image:url('{{ asset(config('images.about')) }}')"
                         role="img" aria-label="Massief hout schrijnwerk"
                    ></div>
                @else
                    <div class="massief-hub-image massief-hub-image--fallback"
                         style="background-image:url('{{ asset('assets/client/images/massieifhout.webp') }}')"
                         role="img" aria-label="Massief hout"
                    ></div>
                @endif
                <div class="massief-hub-text">
                    <span class="section-eyebrow" style="color:var(--color-accent);">Hoofdsoort</span>
                    <h2 class="massief-hub-title">Massief hout</h2>
                    <p class="massief-hub-description">{{ $massieHoutBeschrijving }}</p>
                </div>
            </div>
        </div>

        {{-- Visual connector --}}
        <div class="hub-connector" aria-hidden="true">
            <div class="hub-connector-line"></div>
            <span class="hub-connector-label">Houtsoorten binnen massief hout</span>
            <div class="hub-connector-line"></div>
        </div>

        {{-- ─── Wood type cards: first 3 in top row, last 2 centered below --}}
        @php
            $firstRow = array_slice($woodTypes, 0, 3);
            $lastRow  = array_slice($woodTypes, 3);
        @endphp

        <div class="wood-hub-grid reveal-stagger">
            @foreach($firstRow as $wood)
                @include('partials.wood-type-card', compact('wood'))
            @endforeach
        </div>

        @if(count($lastRow) > 0)
            <div class="wood-hub-grid wood-hub-grid--centered reveal-stagger" style="margin-top:1.5rem;">
                @foreach($lastRow as $wood)
                    @include('partials.wood-type-card', compact('wood'))
                @endforeach
            </div>
        @endif

        <div class="section-actions" style="margin-top:3rem;">
            @if(!empty(config('site.cta_primary')))
                <a href="/#contact" class="btn btn-primary">{{ config('site.cta_primary') }}</a>
            @endif
            <a href="/" class="btn btn-secondary">Terug naar home</a>
        </div>

    </div>
</section>

@endsection

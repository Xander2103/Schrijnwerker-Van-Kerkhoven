@extends('layouts.client')

@section('page_title', 'Houten ramen op maat — Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Massief houten ramen op maat voor renovatie en nieuwbouw. Advies over houtsoort, afwerking en isolerende beglazing. Van Kerkhoven — 45 jaar vakmanschap in Huldenberg.')

@section('content')

{{-- ─── Page hero with background image ──────────────────────────── --}}
<section
    class="page-hero page-hero--image"
    style="--page-hero-image: url('{{ asset('assets/client/images/ramen/hero-ramen.webp') }}')"
>
    <div class="client-container">
        <div class="page-hero-content">
            <a href="/" class="page-back-link" aria-label="Terug naar home">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Terug
            </a>
            <span class="section-eyebrow">Specialisatie</span>
            <h1 class="page-hero-title">Houten ramen op maat</h1>
            <p class="page-hero-intro">Authentiek vakmanschap in massief hout — van houtkeuze tot plaatsing door eigen dienst.</p>
        </div>
    </div>
</section>

{{-- ─── Short intro + CTA ──────────────────────────────────────────── --}}
<section class="client-section section-compact">
    <div class="client-container">
        <p style="color:var(--color-text-light); max-width:60ch; font-size:1rem; line-height:1.75; margin:0 0 1.5rem;">
            Massief houten ramen volledig op maat — eik, meranti, afrormosia of afzelia — met isolerende beglazing naar keuze. Geschikt voor renovatie en nieuwbouw, geplaatst door onze eigen dienst.
        </p>
        <a href="/contact" class="btn btn-primary">Maak een afspraak</a>
    </div>
</section>

{{-- ─── Photo gallery ───────────────────────────────────────────────── --}}
@php $galleryTitle = 'Realisaties houten ramen'; @endphp
@include('partials.realisaties-gallery')

@endsection

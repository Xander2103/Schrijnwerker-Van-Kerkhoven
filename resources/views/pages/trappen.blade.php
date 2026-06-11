@extends('layouts.client')

@section('page_title', 'Trappen op maat — Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Massief houten trappen op maat — rechte trappen, kwartslag en halfslag in elke gewenste houtsoort en afwerking. Van Kerkhoven — 45 jaar vakmanschap in Huldenberg.')

@section('content')

{{-- ─── Page hero with background image ──────────────────────────── --}}
<section
    class="page-hero page-hero--image"
    style="--page-hero-image: url('{{ asset('assets/client/images/trappen-hero.webp') }}')"
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
            <h1 class="page-hero-title">Trappen op maat in massief hout</h1>
            <p class="page-hero-intro">Functioneel en elegant — een houten trap die aansluit bij uw woning, stijl en interieur.</p>
        </div>
    </div>
</section>

{{-- ─── Short intro + CTA ──────────────────────────────────────────── --}}
<section class="client-section section-compact">
    <div class="client-container">
        <p style="color:var(--color-text-light); max-width:60ch; font-size:1rem; line-height:1.75; margin:0 0 1.5rem;">
            Rechte trappen, kwartslag en halfslag — volledig op maat in eigen werkhuis, in de houtsoort en afwerking van uw keuze. Veiligheid en kwaliteit gegarandeerd, plaatsing door eigen dienst.
        </p>
        <a href="/contact" class="btn btn-primary">Maak een afspraak</a>
    </div>
</section>

{{-- ─── Photo gallery ───────────────────────────────────────────────── --}}
@php $galleryTitle = 'Realisaties trappen'; @endphp
@include('partials.realisaties-gallery')

@endsection

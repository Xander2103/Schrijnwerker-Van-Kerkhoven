@extends('layouts.client')

@section('page_title', 'Houten ramen op maat — Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Massief houten ramen op maat voor renovatie en nieuwbouw. Advies over houtsoort, afwerking en isolerende beglazing. Van Kerkhoven — 45 jaar vakmanschap in Huldenberg.')

@section('content')

{{-- ─── Page hero ─────────────────────────────────────────────────── --}}
<section class="page-hero wood-bg-sand">
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
            <p class="page-hero-intro">Authentiek vakmanschap, duurzame materialen en een persoonlijke aanpak — van houtkeuze tot plaatsing.</p>
        </div>
    </div>
</section>

{{-- ─── Intro tekst ────────────────────────────────────────────────── --}}
<section class="client-section">
    <div class="client-container">
        <div class="page-intro-inner reveal">
            <div class="page-intro-text">
                <h2 class="page-intro-heading">Ramen die passen bij uw woning</h2>
                <p>Houten ramen zijn meer dan een functioneel onderdeel — ze bepalen mee het karakter en de uitstraling van uw woning. Bij Van Kerkhoven maken wij houten ramen volledig op maat, in de houtsoort, profilering en afwerking die bij uw project past.</p>
                <p>Of het nu gaat om de restauratie van authentieke ramen in een jaren '30 woning, een renovatieproject met aandacht voor stijl en isolatie, of nieuwbouw met een eigentijdse uitstraling — wij begeleiden u van de eerste bespreking tot de vakkundige plaatsing door onze eigen dienst.</p>
                <p>Wij werken met massief hout: eik, meranti, afrormosia en andere soorten die duurzaamheid combineren met uitstraling. Elke raam wordt gemonteerd met isolerende beglazing naar uw keuze.</p>
            </div>
            <div class="page-intro-highlights">
                <ul class="page-highlight-list">
                    <li>Volledig op maat, in eigen werkhuis</li>
                    <li>Keuze uit meerdere houtsoorten</li>
                    <li>Enkelvoudige, dubbele of driedubbele beglazing</li>
                    <li>Restauratie van authentiek schrijnwerk</li>
                    <li>Plaatsing door eigen dienst</li>
                    <li>Geschikt voor renovatie en nieuwbouw</li>
                </ul>
                <a href="/#contact" class="btn btn-primary" style="margin-top:1.5rem;align-self:flex-start;">Maak een afspraak</a>
            </div>
        </div>
    </div>
</section>

{{-- ─── Realisaties gallery ─────────────────────────────────────────── --}}
@php $galleryTitle = 'Realisaties houten ramen'; @endphp
@include('partials.realisaties-gallery')

{{-- ─── Bottom CTA ──────────────────────────────────────────────────── --}}
<section class="client-section wood-bg-sand">
    <div class="client-container">
        <div class="page-cta-row reveal">
            <div>
                <h2 class="page-cta-heading">Interesse in houten ramen?</h2>
                <p style="color:var(--color-text-light);">Wij bespreken graag uw project op afspraak. Neem contact op voor een vrijblijvend gesprek.</p>
            </div>
            <a href="/#contact" class="btn btn-primary">Maak een afspraak</a>
        </div>
    </div>
</section>

@endsection

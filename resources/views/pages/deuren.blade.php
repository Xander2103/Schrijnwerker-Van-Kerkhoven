@extends('layouts.client')

@section('page_title', 'Houten deuren op maat — Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Massief houten deuren op maat — buitendeuren en binnendeuren in elke stijl en afwerking. Van Kerkhoven — 45 jaar vakmanschap in Huldenberg.')

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
            <h1 class="page-hero-title">Houten deuren met karakter</h1>
            <p class="page-hero-intro">Van een solide voordeur tot stijlvolle binnendeuren — elk op maat, in massief hout, met persoonlijke begeleiding.</p>
        </div>
    </div>
</section>

{{-- ─── Intro tekst ────────────────────────────────────────────────── --}}
<section class="client-section">
    <div class="client-container">
        <div class="page-intro-inner reveal">
            <div class="page-intro-text">
                <h2 class="page-intro-heading">Deuren die indruk maken</h2>
                <p>Een houten deur in massief hout geeft uw woning karakter en uitstraling. Of het gaat om een robuuste voordeur, een elegante binnendeur of een bijzonder ontwerp voor een renovatieproject — bij Van Kerkhoven wordt elke deur met vakmanschap gemaakt in eigen werkhuis.</p>
                <p>Buitendeuren worden behandeld met weersbestendige afwerkingen voor maximale duurzaamheid. Binnendeuren stemmen we af op de sfeer en stijl van uw interieur, van klassiek tot modern. Elke afmeting, profilering en afwerking is bespreekbaar.</p>
                <p>Wij werken samen met architecten en interieurvormgevers voor projecten waarbij de deur een centrale designrol speelt. Plaatsing gebeurt door onze eigen dienst, met aandacht voor een nette, duurzame montage.</p>
            </div>
            <div class="page-intro-highlights">
                <ul class="page-highlight-list">
                    <li>Buitendeuren in weersbestendig massief hout</li>
                    <li>Binnendeuren op maat van stijl en ruimte</li>
                    <li>Klassieke en moderne profileringen</li>
                    <li>Samenwerking met architecten mogelijk</li>
                    <li>Plaatsing door eigen dienst</li>
                    <li>Keuze uit meerdere houtsoorten en afwerkingen</li>
                </ul>
                <a href="/#contact" class="btn btn-primary" style="margin-top:1.5rem;align-self:flex-start;">Maak een afspraak</a>
            </div>
        </div>
    </div>
</section>

{{-- ─── Realisaties gallery ─────────────────────────────────────────── --}}
@php $galleryTitle = 'Realisaties houten deuren'; @endphp
@include('partials.realisaties-gallery')

{{-- ─── Bottom CTA ──────────────────────────────────────────────────── --}}
<section class="client-section wood-bg-sand">
    <div class="client-container">
        <div class="page-cta-row reveal">
            <div>
                <h2 class="page-cta-heading">Interesse in houten deuren?</h2>
                <p style="color:var(--color-text-light);">Wij bespreken graag uw project op afspraak. Neem contact op voor een vrijblijvend gesprek.</p>
            </div>
            <a href="/#contact" class="btn btn-primary">Maak een afspraak</a>
        </div>
    </div>
</section>

@endsection

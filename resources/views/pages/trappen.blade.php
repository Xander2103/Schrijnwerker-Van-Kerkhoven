@extends('layouts.client')

@section('page_title', 'Trappen op maat — Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Massief houten trappen op maat — rechte trappen, kwartslag en halfslag in elke gewenste houtsoort en afwerking. Van Kerkhoven — 45 jaar vakmanschap in Huldenberg.')

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
            <h1 class="page-hero-title">Trappen op maat in massief hout</h1>
            <p class="page-hero-intro">Functioneel en elegant — een houten trap die aansluit bij uw woning, stijl en interieur.</p>
        </div>
    </div>
</section>

{{-- ─── Intro tekst ────────────────────────────────────────────────── --}}
<section class="client-section">
    <div class="client-container">
        <div class="page-intro-inner reveal">
            <div class="page-intro-text">
                <h2 class="page-intro-heading">Een trap als blikvanger</h2>
                <p>Een houten trap is een van de meest opvallende elementen in een interieur. Bij Van Kerkhoven maken wij trappen volledig op maat — van een rechte trap in een compacte woning tot een halfslag trap met elegante balustrade in een ruim herenhuis.</p>
                <p>Elke trap wordt ontworpen op maat van de beschikbare ruimte en de gewenste stijl. We adviseren u over houtsoort, trapvorm, traptrede-afwerking en balustrade. De combinatie van functieopbouw en esthetische afwerking staat centraal in elk project.</p>
                <p>Veiligheid en duurzaamheid zijn niet onderhandelbaar. Trappen worden geproduceerd in eigen werkhuis en geplaatst door onze eigen dienst — zodat we kwaliteitscontrole behouden van ontwerp tot definitieve plaatsing.</p>
            </div>
            <div class="page-intro-highlights">
                <ul class="page-highlight-list">
                    <li>Rechte trappen, kwartslag en halfslag</li>
                    <li>Volledig op maat in eigen werkhuis</li>
                    <li>Keuze uit meerdere houtsoorten</li>
                    <li>Diverse trapvormen en balustrade-opties</li>
                    <li>Plaatsing door eigen dienst</li>
                    <li>Aandacht voor veiligheid en afwerking</li>
                </ul>
                <a href="/#contact" class="btn btn-primary" style="margin-top:1.5rem;align-self:flex-start;">Maak een afspraak</a>
            </div>
        </div>
    </div>
</section>

{{-- ─── Realisaties gallery ─────────────────────────────────────────── --}}
@php $galleryTitle = 'Realisaties trappen'; @endphp
@include('partials.realisaties-gallery')

{{-- ─── Bottom CTA ──────────────────────────────────────────────────── --}}
<section class="client-section wood-bg-sand">
    <div class="client-container">
        <div class="page-cta-row reveal">
            <div>
                <h2 class="page-cta-heading">Interesse in een trap op maat?</h2>
                <p style="color:var(--color-text-light);">Wij bespreken graag uw project op afspraak. Neem contact op voor een vrijblijvend gesprek.</p>
            </div>
            <a href="/#contact" class="btn btn-primary">Maak een afspraak</a>
        </div>
    </div>
</section>

@endsection

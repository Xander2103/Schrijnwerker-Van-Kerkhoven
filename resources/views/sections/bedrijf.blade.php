{{-- ============================================================
     Ons bedrijf — dark workshop section.
     Integrates the atelier story, dark style and photo collage.
     id="bedrijf" is the nav anchor for /#bedrijf.
     ============================================================ --}}

@php
    $bedrijfPhotos = array_values(array_filter(
        array_slice($atelierImages ?? [], 0, 5),
        fn($p) => !empty($p)
    ));
@endphp

<section id="bedrijf" class="client-section bedrijf-section bedrijf-section--dark wood-bg-dark">
    <div class="client-container">
        <div class="bedrijf-inner">

            {{-- ─── Text content ─────────────────────────────── --}}
            <div class="bedrijf-content reveal">
                <span class="section-eyebrow">Ons bedrijf</span>
                <h2 class="bedrijf-heading">45 jaar vakmanschap — van ruwe plank tot afgewerkt schrijnwerk</h2>

                <blockquote class="bedrijf-quote">
                    Elke opdracht begint in ons eigen atelier in Huldenberg. Van ruwe planken tot afgewerkt schrijnwerk: elk stuk verlaat het werkhuis met de zorg en precisie van 45 jaar vakmanschap.
                </blockquote>

                <div class="bedrijf-text">
                    <p>Wij begeleiden elk project van het eerste adviesgesprek tot de vakkundige plaatsing — volledig in eigen handen. Maatwerk in massief hout voor particulieren, renovatieprojecten en samenwerking met architecten.</p>
                </div>

                <ul class="bedrijf-kenmerken" aria-label="Kenmerken">
                    <li>45 jaar expertise in massief hout</li>
                    <li>Eigen werkhuis en plaatsingsdienst</li>
                    <li>Van grondstof tot afwerking</li>
                    <li>Maatwerk voor particulieren en architecten</li>
                    <li>Klantgericht van ontwerp tot oplevering</li>
                </ul>

                @if(!empty(config('site.cta_primary')))
                    <a href="/contact" class="btn btn-primary">{{ config('site.cta_primary') }}</a>
                @endif
            </div>

            {{-- ─── Atelier photo collage ─────────────────────── --}}
            <div class="bedrijf-images reveal" data-reveal-delay="100" aria-hidden="true">
                @if(count($bedrijfPhotos) >= 2)
                    <div class="bedrijf-photo-stack">
                        @foreach(array_slice($bedrijfPhotos, 0, 3) as $i => $img)
                            <div
                                class="bedrijf-photo bedrijf-photo--{{ $i + 1 }}"
                                style="background-image:url('{{ asset($img) }}')"
                                role="img"
                                aria-label="Van Kerkhoven atelier"
                            ></div>
                        @endforeach
                    </div>
                @elseif(count($bedrijfPhotos) === 1)
                    <div
                        class="about-image-frame"
                        style="background-image:url('{{ asset($bedrijfPhotos[0]) }}')"
                        role="img"
                        aria-label="Van Kerkhoven atelier"
                    ></div>
                @else
                    <div class="image-fallback about-image-frame">
                        <span style="color:rgba(255,255,255,0.45);">Atelier foto wordt geplaatst</span>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

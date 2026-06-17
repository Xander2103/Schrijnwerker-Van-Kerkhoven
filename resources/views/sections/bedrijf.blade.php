{{-- ============================================================
     Ons bedrijf — dark workshop section.
     Integrates the atelier story, dark style and photo collage.
     id="bedrijf" is the nav anchor for /#bedrijf.
     ============================================================ --}}

@php
    $atelierAll    = array_values(array_filter($atelierImages ?? [], fn($p) => !empty($p)));
    $bedrijfPhotos = array_slice($atelierAll, 0, 3);
    // json_encode produces "…" which Blade {{ }} encodes to &quot;…&quot; — one pass only.
    // Do NOT wrap in htmlspecialchars() here; that would double-encode and break JSON.parse() in JS.
    $atelierJson   = json_encode(
        array_map(fn($p) => asset($p), $atelierAll),
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );
@endphp

<section id="bedrijf" class="client-section bedrijf-section wood-bg-cream">
    <div class="client-container">
        <div class="bedrijf-inner">

            {{-- ─── Text content ─────────────────────────────── --}}
            <div class="bedrijf-content reveal">
                <span class="section-eyebrow">Ons bedrijf</span>
                <h2 class="bedrijf-heading">45 jaar vakmanschap —<br>van ruwe plank tot afgewerkt schrijnwerk</h2>

                <blockquote class="bedrijf-quote">
                    Elke opdracht begint in ons eigen atelier in Huldenberg. Van ruwe planken tot afgewerkt schrijnwerk: elk stuk verlaat het werkhuis met de zorg en precisie van 45 jaar vakmanschap.
                </blockquote>

                <div class="bedrijf-text">
                    <p>Met massief hout creëren we maatwerk voor particulieren, zelfstandigen en ondernemers, van renovatie tot nieuwbouw.</p>
                </div>

                <ul class="bedrijf-kenmerken" aria-label="Kenmerken">
                    <li>45 jaar expertise in massief hout</li>
                    <li>Eigen werkhuis en plaatsingsdienst</li>
                    <li>Van grondstof tot afwerking</li>
                    <li>Maatwerk voor woningen, zelfstandige zaken en ondernemingen</li>
                    <li>Klantgericht van ontwerp tot oplevering</li>
                </ul>

                <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-top:1.5rem;">
                    @if(!empty(config('site.cta_primary')))
                        <a href="/contact" class="btn btn-primary">{{ config('site.cta_primary') }}</a>
                    @endif
                    <a href="/werkplaats" class="btn btn-secondary">Bekijk onze werkplaats</a>
                </div>
            </div>

            {{-- ─── Atelier photo collage — images cycle via JS ──────── --}}
            <div class="bedrijf-images reveal" data-reveal-delay="100" aria-hidden="true">
                @if(count($bedrijfPhotos) >= 2)
                    {{-- data-atelier-images passes the full pool to JS for cycling --}}
                    <div class="bedrijf-photo-stack" data-atelier-images="{{ $atelierJson }}">
                        @foreach($bedrijfPhotos as $i => $img)
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

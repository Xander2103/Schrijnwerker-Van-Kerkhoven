{{-- ============================================================
     Ons bedrijf — merged welcome + about section.
     Text (left) + stacked atelier photos (right).
     id="bedrijf" is the nav anchor for /#bedrijf.
     ============================================================ --}}
<section id="bedrijf" class="client-section bedrijf-section wood-bg-ivory">
    <div class="client-container">
        <div class="bedrijf-inner">

            {{-- ─── Text content ─────────────────────────────── --}}
            <div class="bedrijf-content reveal">
                <span class="section-eyebrow">Ons bedrijf</span>
                <h2 class="bedrijf-heading">45 jaar vakmanschap, van boom tot plaatsing</h2>
                <div class="bedrijf-text">
                    <p>Bij Algemene Schrijnwerkerij Van Kerkhoven draait elk project rond vakmanschap, kwaliteit en persoonlijk contact. Vanuit het eigen werkhuis maken ze houten ramen, deuren, trappen en maatwerk in massief hout, volledig afgestemd op uw woning of bedrijfsruimte.</p>
                    <p>De eigen plaatsingsdienst zorgt daarna voor een nauwkeurige installatie met oog voor detail. Zo blijft het volledige traject in vertrouwde handen: van advies en productie tot plaatsing en opvolging nadien.</p>
                </div>
                <ul class="bedrijf-kenmerken" aria-label="Kenmerken">
                    <li>45 jaar expertise in massief hout</li>
                    <li>Eigen werkhuis en eigen plaatsingsdienst</li>
                    <li>Begeleiding van ontwerp tot oplevering</li>
                    <li>Samenwerking met particulieren en architecten</li>
                </ul>
                @if(!empty(config('site.cta_primary')))
                    <a href="/#contact" class="btn btn-primary">{{ config('site.cta_primary') }}</a>
                @endif
            </div>

            {{-- ─── Atelier photos ────────────────────────────── --}}
            @php
                $atelierImages = array_values(array_filter([
                    config('images.about'),
                    config('images.hero'),
                    'assets/client/images/massieifhout.webp',
                    'assets/client/images/hero1.webp',
                ], fn($p) => !empty($p) && file_exists(public_path($p))));
            @endphp
            <div class="bedrijf-images reveal" data-reveal-delay="100" aria-hidden="true">
                @if(count($atelierImages) >= 2)
                    <div class="bedrijf-photo-stack">
                        @foreach(array_slice($atelierImages, 0, 3) as $i => $img)
                            <div
                                class="bedrijf-photo bedrijf-photo--{{ $i + 1 }}"
                                style="background-image:url('{{ asset($img) }}')"
                                role="img"
                                aria-label="Van Kerkhoven schrijnwerkerij"
                            ></div>
                        @endforeach
                    </div>
                @elseif(count($atelierImages) === 1)
                    <div
                        class="about-image-frame"
                        style="background-image:url('{{ asset($atelierImages[0]) }}')"
                        role="img"
                        aria-label="Van Kerkhoven schrijnwerkerij"
                    ></div>
                @else
                    <div class="image-fallback about-image-frame">
                        <span>Atelier foto wordt geplaatst</span>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

{{-- ============================================================
     Homepage specialisaties teaser — three cards linking to dedicated pages.
     Full content (gallery, description, realisaties) lives on /ramen /deuren /trappen.
     ============================================================ --}}
<section id="specialisaties" class="client-section">
    <div class="client-container">

        <div class="section-header reveal">
            <span class="section-eyebrow">Specialisaties</span>
            <h2 class="section-title">Vakwerk in massief hout</h2>
            <p class="section-intro">Ontdek onze drie kerndisciplines — elk uitgewerkt met 45 jaar vakkennis, in eigen werkhuis.</p>
        </div>

        <div class="spec-teaser-grid reveal-stagger">

            {{-- Ramen --}}
            <article class="spec-teaser-card reveal">
                <div class="spec-teaser-image"
                     @if(!empty(config('images.ramen')) && file_exists(public_path(config('images.ramen'))))
                         style="background-image:url('{{ asset(config('images.ramen')) }}')"
                     @else
                         style="background: linear-gradient(135deg, #C9956A 0%, #A07040 100%);"
                     @endif
                     role="img" aria-label="Houten ramen"
                ></div>
                <div class="spec-teaser-body">
                    <span class="section-eyebrow" style="margin-bottom:.5rem;">Ramen</span>
                    <h3 class="spec-teaser-title">Houten ramen op maat</h3>
                    <p class="spec-teaser-text">Massief houten ramen voor renovatie en nieuwbouw — afgestemd op uw woning, houtsoort en beglazing.</p>
                    <a href="{{ route('ramen') }}" class="spec-teaser-link">
                        Meer over ramen
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </article>

            {{-- Deuren --}}
            <article class="spec-teaser-card reveal">
                <div class="spec-teaser-image"
                     @if(!empty(config('images.deuren')) && file_exists(public_path(config('images.deuren'))))
                         style="background-image:url('{{ asset(config('images.deuren')) }}')"
                     @else
                         style="background: linear-gradient(135deg, #8B5E3C 0%, #6A4020 100%);"
                     @endif
                     role="img" aria-label="Houten deuren"
                ></div>
                <div class="spec-teaser-body">
                    <span class="section-eyebrow" style="margin-bottom:.5rem;">Deuren</span>
                    <h3 class="spec-teaser-title">Houten deuren met karakter</h3>
                    <p class="spec-teaser-text">Buitendeuren en binnendeuren in massief hout — stijlvol, duurzaam en volledig op maat.</p>
                    <a href="{{ route('deuren') }}" class="spec-teaser-link">
                        Meer over deuren
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </article>

            {{-- Trappen --}}
            <article class="spec-teaser-card reveal">
                <div class="spec-teaser-image"
                     @if(!empty(config('images.trappen')) && file_exists(public_path(config('images.trappen'))))
                         style="background-image:url('{{ asset(config('images.trappen')) }}')"
                     @else
                         style="background: linear-gradient(135deg, #7B4A1E 0%, #5A3010 100%);"
                     @endif
                     role="img" aria-label="Trappen op maat"
                ></div>
                <div class="spec-teaser-body">
                    <span class="section-eyebrow" style="margin-bottom:.5rem;">Trappen</span>
                    <h3 class="spec-teaser-title">Trappen op maat</h3>
                    <p class="spec-teaser-text">Rechte trappen, kwartslag en halfslag — in massief hout, aangepast aan uw woning en interieur.</p>
                    <a href="{{ route('trappen') }}" class="spec-teaser-link">
                        Meer over trappen
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </article>

        </div>

    </div>
</section>

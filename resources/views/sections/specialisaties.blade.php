{{-- ============================================================
     Specialisaties: Houten ramen / deuren / trappen
     Three visual focus blocks replacing the generic services grid.
     Each section has its own anchor ID matching the navigation.
     Images: public/assets/client/images/ramen.webp, deuren.webp, trappen.webp
     Slow zoom applied via CSS (kenburnsZoom) respecting prefers-reduced-motion.
     ============================================================ --}}

{{-- ─── Houten Ramen ─────────────────────────────────────────── --}}
<section id="ramen" class="client-section specialisatie-section">
    <div class="client-container">
        <div class="specialisatie-grid reveal">

            <div class="specialisatie-image-wrap">
                @if(!empty(config('images.ramen')) && file_exists(public_path(config('images.ramen'))))
                    <img
                        class="specialisatie-image"
                        src="{{ asset(config('images.ramen')) }}"
                        alt="Houten ramen op maat — Van Kerkhoven"
                        loading="lazy"
                        width="800" height="600"
                    >
                @else
                    <div class="specialisatie-fallback" aria-hidden="true">
                        <span>Foto houten ramen</span>
                    </div>
                @endif
            </div>

            <div class="specialisatie-content">
                <span class="section-eyebrow">Ramen</span>
                <h2>Houten ramen op maat</h2>
                <p>Massief houten ramen, gemaakt in eigen werkhuis op maat van uw woning. Of het nu gaat om een renovatie van authentieke ramen of een nieuwbouwproject met een eigentijdse look — wij adviseren u over houtsoort, afwerking en isolerende beglazing.</p>
                <p>Onze ramen worden geplaatst door onze eigen dienst, met oog voor detail en een nette afwerking.</p>
                <a href="/#contact" class="btn btn-primary" style="align-self:flex-start;">Maak een afspraak</a>
            </div>

        </div>
    </div>
</section>

{{-- ─── Houten Deuren ────────────────────────────────────────── --}}
<section id="deuren" class="client-section-alt specialisatie-section wood-bg-cream">
    <div class="client-container">
        <div class="specialisatie-grid specialisatie-grid--reverse reveal">

            <div class="specialisatie-image-wrap">
                @if(!empty(config('images.deuren')) && file_exists(public_path(config('images.deuren'))))
                    <img
                        class="specialisatie-image"
                        src="{{ asset(config('images.deuren')) }}"
                        alt="Houten deuren op maat — Van Kerkhoven"
                        loading="lazy"
                        width="800" height="600"
                    >
                @else
                    <div class="specialisatie-fallback" aria-hidden="true">
                        <span>Foto houten deuren</span>
                    </div>
                @endif
            </div>

            <div class="specialisatie-content">
                <span class="section-eyebrow">Deuren</span>
                <h2>Houten deuren met karakter</h2>
                <p>Van een solide voordeur in massief hout tot stijlvolle binnendeuren die de sfeer van uw interieur bepalen. Elke deur wordt op maat gemaakt, afgestemd op de stijl van uw woning en afgewerkt naar uw wens.</p>
                <p>Buitendeuren worden weersbestendig behandeld. Binnendeuren passen wij aan aan de maat en de gewenste afwerking.</p>
                <a href="/#contact" class="btn btn-primary" style="align-self:flex-start;">Maak een afspraak</a>
            </div>

        </div>
    </div>
</section>

{{-- ─── Trappen op maat ──────────────────────────────────────── --}}
<section id="trappen" class="client-section specialisatie-section">
    <div class="client-container">
        <div class="specialisatie-grid reveal">

            <div class="specialisatie-image-wrap">
                @if(!empty(config('images.trappen')) && file_exists(public_path(config('images.trappen'))))
                    <img
                        class="specialisatie-image"
                        src="{{ asset(config('images.trappen')) }}"
                        alt="Trappen op maat — Van Kerkhoven"
                        loading="lazy"
                        width="800" height="600"
                    >
                @else
                    <div class="specialisatie-fallback" aria-hidden="true">
                        <span>Foto trap op maat</span>
                    </div>
                @endif
            </div>

            <div class="specialisatie-content">
                <span class="section-eyebrow">Trappen</span>
                <h2>Trappen op maat in massief hout</h2>
                <p>Een houten trap is meer dan een functioneel element — het is een blikvanger die uw interieur definieert. Wij maken rechte trappen, kwartslag en halfslag trappen volledig op maat, in de houtsoort en afwerking die past bij uw woning.</p>
                <p>Elke trap wordt ontworpen met oog voor veiligheid, duurzaamheid en esthetiek, en geplaatst door onze eigen dienst.</p>
                <a href="/#contact" class="btn btn-primary" style="align-self:flex-start;">Maak een afspraak</a>
            </div>

        </div>
    </div>
</section>

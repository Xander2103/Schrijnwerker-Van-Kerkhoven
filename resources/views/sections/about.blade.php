<section id="bedrijf" class="client-section-alt wood-bg-sand">
    <div class="client-container">
        <div class="two-column-grid">

            <div class="reveal">
                @if(!empty(config('images.about')))
                    <div class="about-image-frame"
                         style="background-image: url('{{ asset(config('images.about')) }}')">
                    </div>
                @else
                    <div class="image-fallback about-image-frame">
                        <span>Afbeelding wordt hier geplaatst</span>
                    </div>
                @endif
            </div>

            <div class="reveal" data-reveal-delay="100">
                <span class="section-eyebrow">Ons bedrijf</span>
                <h2 class="section-title">45 jaar vakmanschap in massief hout</h2>
                <p style="color:var(--color-text-light);line-height:1.75;margin-bottom:1.5rem;">
                    {{ config('site.intro_long') }}
                </p>
                @if(!empty(config('site.cta_primary')))
                    <a href="/#contact" class="btn btn-primary">{{ config('site.cta_primary') }}</a>
                @endif
            </div>

        </div>
    </div>
</section>

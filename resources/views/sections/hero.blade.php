<section
    id="hero"
    class="hero"
    aria-label="Welkom bij {{ config('site.name') }}"
>
    {{-- Separate background layer for slow zoom without layout shift --}}
    @if(!empty(config('images.hero')))
        <div class="hero-bg" style="--hero-image: url('{{ asset(config('images.hero')) }}'); background-image: var(--hero-image);"></div>
    @endif

    <div class="client-container hero-content">
        <div class="hero-inner">

            {{-- Logo — left-aligned brand mark --}}
            <div class="hero-logo-wrap" aria-hidden="true">
                @if(!empty(config('images.logo')))
                @else
                    <div class="hero-logo-fallback">
                        <span>VK</span>
                    </div>
                @endif
            </div>

            {{-- Hero text + CTAs --}}
            <div class="hero-text">
                <h1>{{ config('site.tagline') }}</h1>
                <p>{{ config('site.intro_short') }}</p>
                <div class="cta-row">
                    @if(!empty(config('site.cta_primary')))
                        <a href="/contact" class="btn btn-primary">{{ config('site.cta_primary') }}</a>
                    @endif
                    @if(!empty(config('site.cta_secondary')))
                        <a href="/#bedrijf" class="btn btn-secondary-light">{{ config('site.cta_secondary') }}</a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

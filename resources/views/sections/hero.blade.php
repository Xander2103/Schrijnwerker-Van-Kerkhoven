@php $locale ??= 'nl'; @endphp

<section
    id="hero"
    class="hero"
    aria-label="Welkom bij {{ config('site.name') }}"
>
    @if(!empty(config('images.hero')))
        <div class="hero-bg" style="--hero-image: url('{{ asset(config('images.hero')) }}'); background-image: var(--hero-image);"></div>
    @endif

    <div class="client-container hero-content">
        <div class="hero-inner">

            <div class="hero-logo-wrap" aria-hidden="true">
                @if(!empty(config('images.logo')))
                @else
                    <div class="hero-logo-fallback">
                        <span>VK</span>
                    </div>
                @endif
            </div>

            <div class="hero-text">
                <h1>{{ __('site.tagline') }}</h1>
                <p>{{ __('site.intro_short') }}</p>
                <div class="cta-row">
                    <a href="/{{ $locale }}/contact" class="btn btn-primary">{{ __('site.cta_primary') }}</a>
                    <a href="/{{ $locale }}#bedrijf" class="btn btn-secondary-light">{{ __('site.cta_secondary') }}</a>
                </div>
            </div>

        </div>
    </div>
</section>

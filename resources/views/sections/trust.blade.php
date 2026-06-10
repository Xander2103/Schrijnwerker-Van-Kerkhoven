@if(!empty(config('site.trust_points')))
<section id="trust" class="client-section wood-bg-ivory">
    <div class="client-container">

        <div class="section-header reveal">
            <span class="section-eyebrow">Waarom ons</span>
            <h2 class="section-title">Wat ons onderscheidt</h2>
            <p class="section-intro">{{ config('site.trust_intro', 'Eerlijk vakmanschap en een vertrouwde aanpak van start tot oplevering.') }}</p>
        </div>

        <div class="trust-grid reveal-stagger">
            @foreach(config('site.trust_points') as $point)
                <div class="trust-card reveal">
                    <span class="trust-card-check" aria-hidden="true">✓</span>
                    <p>{{ $point }}</p>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

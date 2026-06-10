<section id="services" class="client-section wood-bg-cream">
    <div class="client-container">

        <div class="section-header reveal">
            <span class="section-eyebrow">Wat wij doen</span>
            <h2 class="section-title">Onze diensten</h2>
            <p class="section-intro">
                {{ config('site.services_intro', 'Professioneel schrijnwerk voor elk project.') }}
            </p>
        </div>

        <div class="services-grid reveal-stagger">
            @foreach(config('client-services.items', []) as $service)
                <article class="service-card reveal">
                    @if(!empty($service['icon']))
                        <span class="service-card-icon" aria-hidden="true">{{ $service['icon'] }}</span>
                    @endif
                    <h3>{{ $service['name'] }}</h3>
                    <p>{{ $service['description'] }}</p>
                </article>
            @endforeach
        </div>

        <div class="section-actions">
            @if(!empty(config('site.cta_primary')))
                <a href="#contact" class="btn btn-primary">{{ config('site.cta_primary') }}</a>
            @endif
        </div>

    </div>
</section>

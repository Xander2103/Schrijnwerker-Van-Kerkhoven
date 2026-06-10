@extends('layouts.client')

@section('content')

<section class="client-section houtsoorten-hero wood-bg-sand">
    <div class="client-container">
        <div class="section-header">
            <span class="section-eyebrow">Materialen</span>
            <h1 class="section-title">Onze houtsoorten</h1>
            <p class="section-intro">
                De keuze van het juiste hout bepaalt mee de duurzaamheid, uitstraling en prijs van uw schrijnwerk.
                Wij werken met een selectie van kwalitatieve houtsoorten voor elk type project.
            </p>
        </div>
    </div>
</section>

<section class="client-section-alt wood-bg-ivory">
    <div class="client-container">

        <div class="wood-types-grid reveal-stagger">
            @foreach($woodTypes as $wood)
                <article class="wood-type-card reveal">

                    <div class="wood-type-image wood-type-image-fallback"
                         @if(!empty($wood['image']))
                             style="background-image:url('{{ asset($wood['image']) }}');background-color:{{ $wood['tone_color'] }}20;"
                         @else
                             style="background: linear-gradient(135deg, {{ $wood['tone_color'] }}55 0%, {{ $wood['tone_color'] }}22 100%);"
                         @endif
                         role="img"
                         aria-label="{{ $wood['name'] }} kleur- en nerfindicatie"
                    ></div>

                    <div class="wood-type-body">
                        <h2 class="wood-type-name">{{ $wood['name'] }}</h2>
                        <p class="wood-type-description">{{ $wood['description'] }}</p>

                        <div class="wood-type-meta">
                            <p class="wood-meta-label">Geschikt voor</p>
                            <ul class="wood-best-for-list" role="list">
                                @foreach($wood['best_for'] as $use)
                                    <li>{{ $use }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <p class="wood-tone-note">
                            <span class="wood-tone-dot" style="background-color:{{ $wood['tone_color'] }};" aria-hidden="true"></span>
                            {{ $wood['tone'] }}
                        </p>
                    </div>

                </article>
            @endforeach
        </div>

        <div class="section-actions" style="margin-top:3.5rem;">
            @if(!empty(config('site.cta_primary')))
                <a href="/#contact" class="btn btn-primary">{{ config('site.cta_primary') }}</a>
            @endif
            <a href="/" class="btn btn-secondary">Terug naar home</a>
        </div>

    </div>
</section>

@endsection

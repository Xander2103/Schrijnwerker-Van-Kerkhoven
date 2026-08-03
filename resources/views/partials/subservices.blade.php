{{--
    Compact "verder in detail" blok onderaan een bestaande hoofddienstenpagina.

    Verwacht $coreKey — de sleutel van de huidige hoofdpagina. Welke diensten
    getoond worden, staat in config/service-pages.php onder `on_core_pages`.
    Toont niets wanneer er voor die pagina geen verdiepende diensten bestaan.
--}}
@php
    $locale ??= 'nl';
    $subservices = \App\Support\ServicePages::forCorePage($coreKey ?? '', $locale);
@endphp

@if(count($subservices) > 0)
    <section class="client-section-alt subservices-section">
        <div class="client-container">

            <div class="section-header">
                <h2 class="section-title">{{ __('service-pages.common.subservices_heading') }}</h2>
                <p class="section-intro">{{ __('service-pages.common.subservices_intro') }}</p>
            </div>

            <div class="subservices-grid">
                @foreach($subservices as $item)
                    <article class="subservice-card">
                        <h3>{{ $item['label'] }}</h3>
                        <p>{{ $item['teaser'] }}</p>
                        <a href="{{ $item['url'] }}" class="region-service-link">
                            {{ __('service-pages.common.subservices_link') }}
                            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M6 4l4 4-4 4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </article>
                @endforeach
            </div>

        </div>
    </section>
@endif

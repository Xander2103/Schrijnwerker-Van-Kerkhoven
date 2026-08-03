{{--
    Compacte "Gerelateerde realisaties"-sectie voor dienst- en regiopagina's.

    Verwacht $cards. Rendert helemaal niets wanneer er geen gepubliceerd
    project aan gekoppeld is — geen lege sectie, geen lege kop.
--}}
@php
    $locale ??= 'nl';
    $cards  ??= [];
@endphp

@if(count($cards) > 0)
    <section class="client-section related-projects-section">
        <div class="client-container">

            <div class="section-header">
                <span class="section-eyebrow">{{ __('projects.common.eyebrow') }}</span>
                <h2 class="section-title">{{ __('projects.common.section_heading') }}</h2>
            </div>

            @include('partials.project-cards')

            <div class="section-actions">
                <a href="{{ \App\Support\Projects::indexUrl($locale) }}" class="btn btn-secondary">
                    {{ __('projects.common.section_more') }}
                </a>
            </div>

        </div>
    </section>
@endif

{{-- ============================================================
     Ons bedrijf / Notre entreprise / Our company
     ============================================================ --}}
@php
    $locale        = $locale ?? 'nl';
    $atelierAll    = array_values(array_filter($atelierImages ?? [], fn($p) => !empty($p)));
    $bedrijfPhotos = array_slice($atelierAll, 0, 3);
    $atelierJson   = json_encode(
        array_map(fn($p) => asset($p), $atelierAll),
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );
@endphp

<section id="bedrijf" class="client-section bedrijf-section wood-bg-cream">
    <div class="client-container">
        <div class="bedrijf-inner">

            <div class="bedrijf-content reveal">
                <span class="section-eyebrow">{{ __('site.bedrijf_eyebrow') }}</span>
                <h2 class="bedrijf-heading">{{ __('site.bedrijf_heading') }}</h2>

                <blockquote class="bedrijf-quote">
                    {{ __('site.bedrijf_quote') }}
                </blockquote>

                <div class="bedrijf-text">
                    <p>{{ __('site.bedrijf_text') }}</p>
                </div>

                <ul class="bedrijf-kenmerken" aria-label="{{ __('site.bedrijf_aria_kenmerken') }}">
                    @foreach(__('site.bedrijf_features') as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>

                <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-top:1.5rem;">
                    <a href="/{{ $locale }}/contact" class="btn btn-primary">{{ __('site.cta_primary') }}</a>
                    <a href="/{{ $locale }}/werkplaats" class="btn btn-secondary">{{ __('site.bedrijf_cta_werkplaats') }}</a>
                </div>
            </div>

            <div class="bedrijf-images reveal" data-reveal-delay="100" aria-hidden="true">
                @if(count($bedrijfPhotos) >= 2)
                    <div class="bedrijf-photo-stack" data-atelier-images="{{ $atelierJson }}">
                        @foreach($bedrijfPhotos as $i => $img)
                            <div
                                class="bedrijf-photo bedrijf-photo--{{ $i + 1 }}"
                                style="background-image:url('{{ asset($img) }}')"
                                role="img"
                                aria-label="Van Kerkhoven atelier"
                            ></div>
                        @endforeach
                    </div>
                @elseif(count($bedrijfPhotos) === 1)
                    <div
                        class="about-image-frame"
                        style="background-image:url('{{ asset($bedrijfPhotos[0]) }}')"
                        role="img"
                        aria-label="Van Kerkhoven atelier"
                    ></div>
                @else
                    <div class="image-fallback about-image-frame">
                        <span style="color:rgba(255,255,255,0.45);">Atelier foto wordt geplaatst</span>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

@php $locale ??= 'nl'; @endphp

<section id="location" class="client-section-alt wood-bg-oak">
    <div class="client-container">

        <div class="section-header">
            <span class="section-eyebrow">{{ __('site.location_eyebrow') }}</span>
            <h2 class="section-title">{{ __('site.location_heading') }}</h2>
        </div>

        <div class="two-column-grid">

            <div class="info-card">
                <p style="font-weight:600;color:var(--color-primary);font-size:1rem;margin:0 0 .5rem;">
                    {{ config('site.name') }}
                </p>
                <p style="color:var(--color-text-light);margin-bottom:1rem;">
                    {{ config('site.address') }}<br>
                    {{ config('site.city') }}, {{ config('site.region') }}
                </p>
                @if(!empty(config('contact.email')))
                    <p style="margin-bottom:.5rem;font-size:.9rem;">
                        <a href="mailto:{{ config('contact.email') }}"
                           style="color:var(--color-primary);text-decoration:none;">
                            {{ config('contact.email') }}
                        </a>
                    </p>
                @endif
                @if(!empty(config('site.phone')))
                    <p style="margin-bottom:1rem;font-size:.9rem;">
                        <a href="tel:{{ config('site.phone') }}"
                           style="color:var(--color-primary);text-decoration:none;">
                            {{ config('site.phone') }}
                        </a>
                    </p>
                @endif
                <p style="font-size:.9rem;color:var(--color-text-light);margin-bottom:1.5rem;">
                    {{ __('contact.appointment') }}
                </p>
                @if(!empty(config('site.maps_link')))
                    <a href="{{ config('site.maps_link') }}" target="_blank" rel="noopener noreferrer"
                       class="btn btn-secondary">
                        {{ __('site.location_gmaps') }}
                    </a>
                @endif
            </div>

            <div>
                @if(!empty(config('site.maps_embed_url')))
                    <div class="map-embed-container" id="map-consent-wrap">
                        {{-- Click-to-load: iframe not loaded until user consents --}}
                        <div class="map-consent-placeholder" id="map-consent-placeholder">
                            <p class="map-consent-text">{{ __('site.maps_consent_text') }}</p>
                            <button
                                type="button"
                                class="btn btn-secondary map-consent-btn"
                                id="map-consent-btn"
                                aria-label="{{ __('site.maps_consent_aria') }}"
                            >
                                {{ __('site.maps_consent_btn') }}
                            </button>
                        </div>
                    </div>
                @else
                    <div class="image-fallback" style="min-height:360px;">
                        <span>Google Maps wordt hier gekoppeld.</span>
                    </div>
                @endif
            </div>

@push('scripts')
<script>
(function () {
    var btn = document.getElementById('map-consent-btn');
    if (!btn) return;
    btn.addEventListener('click', function () {
        var wrap = document.getElementById('map-consent-wrap');
        var placeholder = document.getElementById('map-consent-placeholder');
        if (!wrap) return;
        var iframe = document.createElement('iframe');
        iframe.src = {!! Js::from(config('site.maps_embed_url')) !!};
        iframe.allowFullscreen = true;
        iframe.loading = 'lazy';
        iframe.referrerPolicy = 'no-referrer-when-downgrade';
        iframe.title = {!! Js::from(__('site.location_title', ['name' => config('site.name')])) !!};
        iframe.style.cssText = 'position:absolute;inset:0;width:100%;height:100%;border:0;';
        if (placeholder) placeholder.remove();
        wrap.appendChild(iframe);
    });
}());
</script>
@endpush

        </div>
    </div>
</section>

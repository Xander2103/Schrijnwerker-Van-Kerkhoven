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
                    <div class="map-embed-container">
                        <iframe
                            src="{{ config('site.maps_embed_url') }}"
                            title="{{ config('site.name') }}"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            style="position:absolute;inset:0;width:100%;height:100%;border:0;"
                        ></iframe>
                    </div>
                @else
                    <div class="image-fallback" style="min-height:360px;">
                        <span>Google Maps</span>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

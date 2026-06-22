@php $locale ??= 'nl'; @endphp

<section id="contact-cta" class="client-section contact-cta-section wood-bg-beige">
    <div class="client-container">
        <div class="contact-cta-inner reveal">

            <div class="contact-cta-text">
                <span class="section-eyebrow">{{ __('site.cta_eyebrow') }}</span>
                <h2 class="contact-cta-heading">{{ __('site.cta_heading') }}</h2>
                <p class="contact-cta-desc">{{ __('site.cta_desc') }}</p>
            </div>

            <div class="contact-cta-actions">
                <a href="/{{ $locale }}/contact" class="btn btn-primary">{{ __('site.cta_primary') }}</a>
                @if(!empty(config('site.phone')))
                    <a href="tel:{{ config('site.phone') }}" class="btn btn-secondary">
                        {{ config('site.phone') }}
                    </a>
                @endif
            </div>

        </div>
    </div>
</section>

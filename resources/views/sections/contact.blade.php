@php
    $locale      ??= 'nl';
    $privacyLink = '/' . $locale . config('contact.privacy_link', '/privacy-policy');
@endphp

<section id="contact" class="client-section wood-bg-beige">
    <div class="client-container">

        <div class="section-header reveal">
            <span class="section-eyebrow">{{ __('contact.eyebrow') }}</span>
            <h2 class="section-title">{{ __('contact.heading') }}</h2>
            <p class="section-intro">{{ __('contact.intro') }}</p>
        </div>

        <div class="two-column-grid">

            <div class="reveal">
                <div class="contact-card">
                    @if(!empty(config('contact.email')))
                        <p><strong>{{ __('site.label_email') }}</strong><br>
                        <a href="mailto:{{ config('contact.email') }}">{{ config('contact.email') }}</a></p>
                    @endif
                    <p>
                        <strong>{{ __('site.label_instagram') }}</strong><br>
                        <a href="{{ config('site.instagram_url') }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="{{ __('site.instagram_aria') }}"
                           style="display:inline-flex;align-items:center;gap:.35rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                <circle cx="12" cy="12" r="4.5"/>
                                <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/>
                            </svg>
                            @van.kerkhoven
                        </a>
                    </p>
                    @if(!empty(config('site.vat')))
                        <p><strong>{{ __('site.label_vat') }}</strong><br>
                        {{ config('site.vat') }}</p>
                    @endif
                    @if(!empty(config('site.phone')))
                        <p><strong>{{ __('site.label_phone') }}</strong><br>
                        <a href="tel:{{ config('site.phone') }}">{{ config('site.phone') }}</a></p>
                    @endif
                    @if(!empty(config('site.whatsapp_url')))
                        <p><a href="{{ config('site.whatsapp_url') }}" target="_blank" rel="noopener noreferrer">{{ __('site.label_whatsapp') }}</a></p>
                    @endif
                    <p><strong>{{ __('site.label_address') }}</strong><br>
                    {{ config('site.address') }}, {{ config('site.city') }}</p>
                    <p style="margin:0;">
                        <strong>{{ __('contact.label_appt') }}</strong><br>
                        {{ __('contact.appointment') }}
                    </p>
                </div>
            </div>

            <div class="reveal" data-reveal-delay="100">

                @if(session('contact_error'))
                    <div class="form-rate-alert" role="alert">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none" aria-hidden="true" style="flex-shrink:0;margin-top:.1rem;">
                            <circle cx="10" cy="10" r="10" fill="#fed7aa"/>
                            <path d="M10 6v5M10 14v.5" stroke="#9a3412" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <span>{{ session('contact_error') }}</span>
                    </div>
                @endif

                @if(session('contact_success'))
                    <div class="form-success-alert" role="status" aria-live="polite">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true" style="flex-shrink:0;margin-top:.1rem;">
                            <circle cx="10" cy="10" r="10" fill="#6ee7b7"/>
                            <path d="M6 10l3 3 5-5" stroke="#065f46" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ session('contact_success') }}</span>
                    </div>
                @endif

                <form class="contact-form" action="{{ route('contact.submit', ['locale' => $locale]) }}" method="POST" novalidate>
                    @csrf

                    <div style="display:none;" aria-hidden="true">
                        <label for="website_url">Laat dit veld leeg</label>
                        <input type="text" id="website_url" name="website_url" tabindex="-1" autocomplete="off">
                    </div>
                    <input type="hidden" name="form_token" value="{{ $formToken ?? '' }}">

                    <div class="form-field">
                        <label for="contact-name">{{ __('contact.name_label') }} {{ __('contact.required_suffix') }}</label>
                        <input type="text" id="contact-name" name="name"
                               class="form-input{{ $errors->has('name') ? ' form-input-error' : '' }}"
                               placeholder="{{ __('contact.name_placeholder') }}" autocomplete="name"
                               value="{{ old('name') }}">
                        @error('name')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="contact-email">{{ __('contact.email_label') }} {{ __('contact.required_suffix') }}</label>
                        <input type="email" id="contact-email" name="email"
                               class="form-input{{ $errors->has('email') ? ' form-input-error' : '' }}"
                               placeholder="{{ __('contact.email_placeholder') }}" autocomplete="email"
                               value="{{ old('email') }}">
                        @error('email')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="contact-phone">
                            {{ __('contact.phone_label') }} <span style="color:var(--color-text-light);font-weight:400;">{{ __('contact.phone_optional') }}</span>
                        </label>
                        <input type="tel" id="contact-phone" name="phone"
                               class="form-input{{ $errors->has('phone') ? ' form-input-error' : '' }}"
                               placeholder="{{ __('contact.phone_placeholder') }}" autocomplete="tel"
                               value="{{ old('phone') }}">
                        @error('phone')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    @if(!empty(config('contact.form_request_types')))
                        <div class="form-field">
                            <label for="contact-type">{{ __('contact.type_label') }} {{ __('contact.required_suffix') }}</label>
                            <select id="contact-type" name="request_type"
                                    class="form-input{{ $errors->has('request_type') ? ' form-input-error' : '' }}">
                                <option value="" disabled {{ old('request_type') ? '' : 'selected' }}>{{ __('contact.type_placeholder') }}</option>
                                @foreach(config('contact.form_request_types') as $key)
                                    <option value="{{ $key }}" {{ old('request_type') === $key ? 'selected' : '' }}>
                                        {{ __('contact.request_types.' . $key) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('request_type')
                                <span class="form-error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div class="form-field">
                        <label for="contact-message">{{ __('contact.message_label') }} {{ __('contact.required_suffix') }}</label>
                        <textarea id="contact-message" name="message"
                                  class="form-input{{ $errors->has('message') ? ' form-input-error' : '' }}"
                                  rows="4" placeholder="{{ __('contact.msg_placeholder') }}">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-checkbox">
                        <input type="checkbox" id="contact-privacy" name="privacy" value="1"
                               {{ old('privacy') ? 'checked' : '' }}>
                        <label for="contact-privacy">
                            {{ __('contact.privacy_text') }}
                            @if(!empty(config('contact.privacy_link')))
                                <a href="{{ $privacyLink }}" target="_blank">{{ __('contact.privacy_more') }}</a>.
                            @endif
                        </label>
                    </div>
                    @error('privacy')
                        <span class="form-error" role="alert">{{ $message }}</span>
                    @enderror

                    <div class="form-submit-row">
                        <button type="submit" class="btn btn-primary" data-loading-label="{{ __('contact.sending') }}">{{ __('contact.submit') }}</button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</section>

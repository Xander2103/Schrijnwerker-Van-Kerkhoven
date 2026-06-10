<section id="contact" class="client-section wood-bg-beige">
    <div class="client-container">

        <div class="section-header reveal">
            <span class="section-eyebrow">Contact</span>
            <h2 class="section-title">Wij helpen u graag</h2>
            <p class="section-intro">Van eerste vraag tot oplevering — wij begeleiden elk project persoonlijk.</p>
        </div>

        <div class="two-column-grid">

            <div class="reveal">
                <div class="contact-card">
                    @if(!empty(config('contact.email')))
                        <p><strong>E-mail</strong><br>
                        <a href="mailto:{{ config('contact.email') }}">{{ config('contact.email') }}</a></p>
                    @endif
                    @if(!empty(config('site.phone')))
                        <p><strong>Telefoon</strong><br>
                        <a href="tel:{{ config('site.phone') }}">{{ config('site.phone') }}</a></p>
                    @endif
                    @if(!empty(config('site.whatsapp_url')))
                        <p><a href="{{ config('site.whatsapp_url') }}" target="_blank" rel="noopener noreferrer">WhatsApp ons</a></p>
                    @endif
                    <p><strong>Adres</strong><br>
                    {{ config('site.address') }}, {{ config('site.city') }}</p>
                    <p style="margin:0;">
                        <strong>Afspraken</strong><br>
                        {{ config('site.appointment_message', 'Wij werken op afspraak.') }}
                    </p>
                </div>
            </div>

            <div class="reveal" data-reveal-delay="100">

                @if(session('contact_rate_error'))
                    <div class="form-rate-alert" role="alert">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none" aria-hidden="true" style="flex-shrink:0;margin-top:.1rem;">
                            <circle cx="10" cy="10" r="10" fill="#fed7aa"/>
                            <path d="M10 6v5M10 14v.5" stroke="#9a3412" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <span>{{ session('contact_rate_error') }}</span>
                    </div>
                @endif

                @if(session('contact_success'))
                    <div class="form-success-alert" role="alert">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" aria-hidden="true" style="flex-shrink:0;margin-top:.1rem;">
                            <circle cx="10" cy="10" r="10" fill="#6ee7b7"/>
                            <path d="M6 10l3 3 5-5" stroke="#065f46" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>{{ session('contact_success') }}</span>
                    </div>
                @endif

                <form class="contact-form" action="{{ route('contact.submit') }}" method="POST" novalidate>
                    @csrf

                    {{-- Honeypot: hidden from humans, bots fill it --}}
                    <div style="display:none;" aria-hidden="true">
                        <label for="website_url">Laat dit veld leeg</label>
                        <input type="text" id="website_url" name="website_url" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="form-field">
                        <label for="contact-name">Naam *</label>
                        <input type="text" id="contact-name" name="name"
                               class="form-input{{ $errors->has('name') ? ' form-input-error' : '' }}"
                               placeholder="Uw naam" autocomplete="name"
                               value="{{ old('name') }}">
                        @error('name')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="contact-phone">Telefoonnummer *</label>
                        <input type="tel" id="contact-phone" name="phone"
                               class="form-input{{ $errors->has('phone') ? ' form-input-error' : '' }}"
                               placeholder="Uw telefoonnummer" autocomplete="tel"
                               value="{{ old('phone') }}">
                        @error('phone')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-field">
                        <label for="contact-email">
                            E-mailadres <span style="color:var(--color-text-light);font-weight:400;">(optioneel)</span>
                        </label>
                        <input type="email" id="contact-email" name="email"
                               class="form-input{{ $errors->has('email') ? ' form-input-error' : '' }}"
                               placeholder="uw@email.be" autocomplete="email"
                               value="{{ old('email') }}">
                        @error('email')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    @if(!empty(config('contact.form_request_types')))
                        <div class="form-field">
                            <label for="contact-type">Type aanvraag *</label>
                            <select id="contact-type" name="request_type"
                                    class="form-input{{ $errors->has('request_type') ? ' form-input-error' : '' }}">
                                <option value="" disabled {{ old('request_type') ? '' : 'selected' }}>Kies een optie</option>
                                @foreach(config('contact.form_request_types') as $type)
                                    <option value="{{ $type }}" {{ old('request_type') === $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('request_type')
                                <span class="form-error" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div class="form-field">
                        <label for="contact-message">Bericht *</label>
                        <textarea id="contact-message" name="message"
                                  class="form-input{{ $errors->has('message') ? ' form-input-error' : '' }}"
                                  rows="4" placeholder="Beschrijf uw aanvraag...">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="form-error" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-checkbox">
                        <input type="checkbox" id="contact-privacy" name="privacy" value="1"
                               {{ old('privacy') ? 'checked' : '' }}>
                        <label for="contact-privacy">
                            Ik ga akkoord dat mijn gegevens gebruikt worden om mijn aanvraag te beantwoorden.
                            @if(!empty(config('contact.privacy_link')))
                                <a href="{{ config('contact.privacy_link') }}" target="_blank">Meer info</a>.
                            @endif
                        </label>
                    </div>
                    @error('privacy')
                        <span class="form-error" role="alert">{{ $message }}</span>
                    @enderror

                    <div class="form-submit-row">
                        <button type="submit" class="btn btn-primary">Verstuur aanvraag</button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</section>

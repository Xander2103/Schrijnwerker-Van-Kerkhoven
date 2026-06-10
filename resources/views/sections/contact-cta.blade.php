{{-- ============================================================
     Contact CTA — simple homepage teaser linking to /contact.
     Replaces the full inline contact section on the homepage.
     ============================================================ --}}
<section id="contact-cta" class="client-section contact-cta-section wood-bg-beige">
    <div class="client-container">
        <div class="contact-cta-inner reveal">

            <div class="contact-cta-text">
                <span class="section-eyebrow">Contact</span>
                <h2 class="contact-cta-heading">Klaar voor uw project?</h2>
                <p class="contact-cta-desc">
                    Van eerste idee tot afwerking — wij begeleiden elk project van ontwerp
                    tot plaatsing vanuit ons eigen werkhuis in Huldenberg.
                </p>
            </div>

            <div class="contact-cta-actions">
                <a href="/contact" class="btn btn-primary">Maak een afspraak</a>
                @if(!empty(config('site.phone')))
                    <a href="tel:{{ config('site.phone') }}" class="btn btn-secondary">
                        {{ config('site.phone') }}
                    </a>
                @endif
            </div>

        </div>
    </div>
</section>

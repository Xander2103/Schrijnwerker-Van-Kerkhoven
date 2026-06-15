<footer class="footer-bar">
    <div class="client-container">
        <div class="footer-grid">

            <div>
                <p class="footer-heading">{{ config('site.name') }}</p>
                <p style="font-size:.875rem;margin:0 0 .4rem;">{{ config('site.address') }}, {{ config('site.city') }}</p>
                @if(!empty(config('site.phone')))
                    <p style="font-size:.875rem;margin:0 0 .25rem;">
                        <a href="tel:{{ config('site.phone') }}">{{ config('site.phone') }}</a>
                    </p>
                @endif
                @if(!empty(config('contact.email')))
                    <p style="font-size:.875rem;margin:0;">
                        <a href="mailto:{{ config('contact.email') }}">{{ config('contact.email') }}</a>
                    </p>
                @endif
            </div>

            <div>
                <p class="footer-heading">Navigatie</p>
                <ul class="footer-nav-list" role="list">
                    @foreach(config('site.nav_items', []) as $item)
                        <li><a href="{{ $item['href'] }}">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <p class="footer-heading">Bereikbaarheid</p>
                <p style="font-size:.875rem;color:rgba(255,255,255,.7);margin:0 0 .5rem;">
                    {{ config('site.appointment_message', 'Wij werken op afspraak.') }}
                </p>
                @if(!empty(config('contact.privacy_link')))
                    <p style="margin-top:1rem;font-size:.875rem;">
                        <a href="{{ config('contact.privacy_link') }}">Privacybeleid</a>
                    </p>
                @endif
            </div>

        </div>
        <div class="footer-bottom">
            <span>{{ config('site.footer_text') }}</span>
            <span class="footer-credit">Designed by <a href="https://vanmalderstudio.be/nl" target="_blank" rel="noopener noreferrer">VanMalderStudio</a></span>
        </div>
    </div>
</footer>

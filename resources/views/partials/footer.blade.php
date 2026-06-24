@php
    $locale     ??= 'nl';
    $navItems   = __('pages.nav_items');
@endphp

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
                    <p style="font-size:.875rem;margin:0 0 .25rem;">
                        <a href="mailto:{{ config('contact.email') }}">{{ config('contact.email') }}</a>
                    </p>
                @endif
                <p style="font-size:.875rem;margin:0;">
                    <a
                        href="https://www.instagram.com/van.kerkhoven/"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="{{ __('site.instagram_aria') }}"
                        style="display:inline-flex;align-items:center;gap:.35rem;color:rgba(255,255,255,.65);text-decoration:none;transition:color .2s;"
                        onmouseover="this.style.color='rgba(255,255,255,.95)'"
                        onmouseout="this.style.color='rgba(255,255,255,.65)'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <circle cx="12" cy="12" r="4.5"/>
                            <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/>
                        </svg>
                        {{ __('site.label_instagram') }}
                    </a>
                </p>
            </div>

            <div>
                <p class="footer-heading">{{ __('site.footer_nav') }}</p>
                <ul class="footer-nav-list" role="list">
                    @foreach($navItems as $item)
                        @php
                            $href = isset($item['anchor'])
                                ? '/' . $locale . '#' . $item['anchor']
                                : '/' . $locale . '/' . $item['path'];
                        @endphp
                        <li><a href="{{ $href }}">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <p class="footer-heading">{{ __('site.footer_access') }}</p>
                <p style="font-size:.875rem;color:rgba(255,255,255,.7);margin:0 0 .5rem;">
                    {{ __('contact.appointment') }}
                </p>
                @if(!empty(config('contact.privacy_link')))
                    <p style="margin-top:1rem;font-size:.875rem;">
                        <a href="/{{ $locale }}{{ config('contact.privacy_link') }}">{{ __('site.footer_privacy') }}</a>
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

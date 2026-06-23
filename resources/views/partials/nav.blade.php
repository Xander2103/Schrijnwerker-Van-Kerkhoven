@php
    $locale    ??= 'nl';
    $navItems  = __('pages.nav_items');
    $localeUrls ??= ['nl' => '/nl', 'fr' => '/fr', 'en' => '/en'];
@endphp

<nav class="nav-bar" aria-label="{{ __('pages.nav_aria') }}">
    <div class="nav-inner">

        <a href="/{{ $locale }}" class="nav-logo" aria-label="{{ config('site.name') }}">
            @if(config('images.logo_header'))
                <img
                    src="{{ asset(config('images.logo_header')) }}"
                    alt=""
                    height="44"
                    class="nav-logo-img"
                    aria-hidden="true"
                >
            @endif
            <span class="nav-brand-name">
                <span>Alg. schrijnwerkerij</span>
                <span>Van Kerkhoven</span>
            </span>
        </a>

        <ul class="nav-links" role="list">
            @foreach($navItems as $item)
                @php
                    $href = isset($item['anchor'])
                        ? '/' . $locale . '#' . $item['anchor']
                        : '/' . $locale . '/' . $item['path'];
                @endphp
                <li><a href="{{ $href }}">{{ $item['label'] }}</a></li>
            @endforeach
        </ul>

        {{-- Desktop language switcher (≥ 1100px) --}}
        <div class="nav-lang-switcher" aria-label="{{ __('pages.lang_switcher_aria') }}">
            @foreach(['nl', 'fr', 'en'] as $l)
                @if($l === $locale)
                    <span class="nav-lang-active" aria-current="true">{{ strtoupper($l) }}</span>
                @else
                    <a href="{{ $localeUrls[$l] }}" class="nav-lang-link" hreflang="{{ $l }}">{{ strtoupper($l) }}</a>
                @endif
            @endforeach
        </div>

        {{-- Mobile/tablet language dropdown (< 1100px) --}}
        <div class="nav-lang-dropdown-wrap" aria-label="{{ __('pages.lang_switcher_aria') }}">
            <select class="nav-lang-dropdown" id="nav-lang-dropdown" aria-label="{{ __('pages.lang_switcher_aria') }}">
                @foreach(['nl', 'fr', 'en'] as $l)
                    <option value="{{ $localeUrls[$l] }}"{{ $l === $locale ? ' selected' : '' }}>{{ strtoupper($l) }}</option>
                @endforeach
            </select>
            <span class="nav-lang-dropdown-caret" aria-hidden="true"></span>
        </div>

        <button
            class="nav-toggle"
            id="nav-toggle"
            aria-label="{{ __('pages.nav_open') }}"
            aria-expanded="false"
            aria-controls="nav-mobile-panel"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>{{-- /nav-inner --}}
</nav>

<div
    class="nav-mobile-panel"
    id="nav-mobile-panel"
    role="dialog"
    aria-modal="true"
    aria-label="{{ __('pages.mobile_menu_aria') }}"
    aria-hidden="true"
>
    @foreach($navItems as $item)
        @php
            $href = isset($item['anchor'])
                ? '/' . $locale . '#' . $item['anchor']
                : '/' . $locale . '/' . $item['path'];
        @endphp
        <a href="{{ $href }}" class="nav-mobile-link">{{ $item['label'] }}</a>
    @endforeach

    {{-- Mobile language switcher --}}
    <div class="nav-mobile-lang" aria-label="{{ __('pages.lang_switcher_aria') }}">
        @foreach(['nl', 'fr', 'en'] as $l)
            @if($l === $locale)
                <span class="nav-lang-active" aria-current="true">{{ strtoupper($l) }}</span>
            @else
                <a href="{{ $localeUrls[$l] }}" class="nav-lang-link" hreflang="{{ $l }}">{{ strtoupper($l) }}</a>
            @endif
        @endforeach
    </div>
</div>

@push('scripts')
<script>
(function () {
    var toggle = document.getElementById('nav-toggle');
    var panel  = document.getElementById('nav-mobile-panel');
    if (!toggle || !panel) return;

    function openMenu() {
        panel.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
        panel.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        panel.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        panel.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    toggle.addEventListener('click', function () {
        panel.classList.contains('is-open') ? closeMenu() : openMenu();
    });

    panel.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeMenu();
    });

    var langSel = document.getElementById('nav-lang-dropdown');
    if (langSel) {
        langSel.addEventListener('change', function () {
            window.location.href = this.value;
        });
    }
}());
</script>
@endpush

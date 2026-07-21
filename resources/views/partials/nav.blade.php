@php
    $locale    ??= 'nl';
    $navItems  = __('pages.nav_items');
    $localeUrls ??= ['nl' => '/nl', 'fr' => '/fr', 'en' => '/en'];
@endphp

<nav class="nav-bar" id="nav-bar" aria-label="{{ __('pages.nav_aria') }}">
    <div class="nav-inner">

        <a href="/{{ $locale }}" class="nav-logo" aria-label="{{ config('site.name') }}">
            @if(config('images.logo_header'))
                <img
                    src="{{ asset(config('images.logo_header')) }}"
                    alt=""
                    width="43"
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

        {{-- Mobile/tablet right group: lang picker + hamburger (< 1100px) --}}
        <div class="nav-mobile-actions">

            {{-- Custom language picker (replaces native <select> for full style control) --}}
            <div class="nav-lang-picker" id="nav-lang-picker">
                <button
                    class="nav-lang-picker-btn"
                    id="nav-lang-picker-btn"
                    type="button"
                    aria-expanded="false"
                    aria-haspopup="true"
                    aria-label="{{ __('pages.lang_switcher_aria') }}"
                >
                    <span class="nav-lang-picker-label">{{ strtoupper($locale) }}</span>
                    <span class="nav-lang-picker-caret" aria-hidden="true"></span>
                </button>
                <ul class="nav-lang-picker-menu" role="list" aria-label="{{ __('pages.lang_switcher_aria') }}">
                    @foreach(['nl', 'fr', 'en'] as $l)
                        <li>
                            @if($l === $locale)
                                <span class="nav-lang-picker-item is-current" aria-current="true">{{ strtoupper($l) }}</span>
                            @else
                                <a href="{{ $localeUrls[$l] }}" class="nav-lang-picker-item" hreflang="{{ $l }}">{{ strtoupper($l) }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
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
        </div>

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
    <div class="nav-mobile-links">
        @foreach($navItems as $item)
            @php
                $href = isset($item['anchor'])
                    ? '/' . $locale . '#' . $item['anchor']
                    : '/' . $locale . '/' . $item['path'];
            @endphp
            <a href="{{ $href }}" class="nav-mobile-link">{{ $item['label'] }}</a>
        @endforeach
    </div>

    <a
        href="{{ config('site.instagram_url') }}"
        class="nav-mobile-instagram"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Instagram Van Kerkhoven"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
            <circle cx="12" cy="12" r="4.5"/>
            <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
        </svg>
        Instagram
    </a>

    {{-- Language switching: use the picker in the header (nav-bar is z:50, always above this panel) --}}
</div>

@push('scripts')
<script>
(function () {
    var navBar    = document.getElementById('nav-bar');
    var toggle    = document.getElementById('nav-toggle');
    var panel     = document.getElementById('nav-mobile-panel');
    var picker    = document.getElementById('nav-lang-picker');
    var pickerBtn = document.getElementById('nav-lang-picker-btn');

    // ── Custom language picker ────────────────────────────────────────────
    function openPicker() {
        if (!picker) return;
        picker.classList.add('is-open');
        if (pickerBtn) pickerBtn.setAttribute('aria-expanded', 'true');
    }

    function closePicker() {
        if (!picker) return;
        picker.classList.remove('is-open');
        if (pickerBtn) pickerBtn.setAttribute('aria-expanded', 'false');
    }

    if (pickerBtn && picker) {
        pickerBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            picker.classList.contains('is-open') ? closePicker() : openPicker();
        });
        picker.addEventListener('click', function (e) {
            e.stopPropagation();
        });
        document.addEventListener('click', closePicker);
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closePicker();
        });
    }

    // ── Hamburger menu ────────────────────────────────────────────────────
    if (!toggle || !panel) return;

    function openMenu() {
        panel.classList.add('is-open');
        toggle.classList.add('is-open');
        if (navBar) navBar.classList.add('nav-open');
        toggle.setAttribute('aria-expanded', 'true');
        panel.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        panel.classList.remove('is-open');
        toggle.classList.remove('is-open');
        if (navBar) navBar.classList.remove('nav-open');
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
        if (e.key === 'Escape') { closeMenu(); closePicker(); }
    });
}());
</script>
@endpush

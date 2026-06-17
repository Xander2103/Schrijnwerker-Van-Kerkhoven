<nav class="nav-bar" aria-label="Hoofdnavigatie">

    <a href="/" class="nav-logo" aria-label="{{ config('site.name') }}">
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
        @foreach(config('site.nav_items', []) as $item)
            <li><a href="{{ $item['href'] }}">{{ $item['label'] }}</a></li>
        @endforeach
    </ul>

    <button
        class="nav-toggle"
        id="nav-toggle"
        aria-label="Menu openen"
        aria-expanded="false"
        aria-controls="nav-mobile-panel"
    >
        <span></span>
        <span></span>
        <span></span>
    </button>

</nav>

<div
    class="nav-mobile-panel"
    id="nav-mobile-panel"
    role="dialog"
    aria-modal="true"
    aria-label="Mobiel menu"
    aria-hidden="true"
>
    @foreach(config('site.nav_items', []) as $item)
        <a href="{{ $item['href'] }}" class="nav-mobile-link">{{ $item['label'] }}</a>
    @endforeach
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
}());
</script>
@endpush

{{-- ============================================================
     Atelier section — 5-frame cycling gallery from /atelier/ folder.
     Dark walnut background. No-duplicate cycling. Lightbox on click.
     Static fallback if JS unavailable. Respects prefers-reduced-motion.
     ============================================================ --}}
@php
    $displayImages = array_slice($atelierImages ?? [], 0, 5);
    $hasImages     = count($displayImages) >= 1;
@endphp

<section id="{{ $atelierId ?? 'atelier' }}" class="atelier-section {{ $atelierVariant ?? '' }}" aria-label="{{ $atelierEyebrow ?? 'Eigen werkhuis' }}">
    <div class="client-container">

        <div class="atelier-header reveal">
            <span class="section-eyebrow" style="color:var(--color-accent);">{{ $atelierEyebrow ?? 'Eigen werkhuis' }}</span>
            <h2 class="atelier-title">{{ $atelierTitle ?? 'Vakmanschap begint in ons eigen atelier' }}</h2>
            <p class="atelier-intro">
                {{ $atelierIntro ?? 'In ons werkhuis in Huldenberg krijgt elk project vorm. Van de eerste voorbereiding tot de afwerking werken we met eigen machines, ervaren handen en oog voor detail. Zo houden we controle over kwaliteit, planning en afwerking.' }}
            </p>
        </div>

        @if($hasImages)

            {{-- JSON data for JS --}}
            <script id="atelier-gallery-data" type="application/json">
                @json($atelierImages ?? [])
            </script>

            <div class="atelier-grid" id="atelier-grid" aria-label="Atelier galerij">
                @foreach($displayImages as $idx => $img)
                    <button
                        class="atelier-frame"
                        style="background-image:url('{{ asset($img) }}')"
                        aria-label="Atelier foto {{ $idx + 1 }} — klik om te vergroten"
                        data-lightbox-index="{{ $idx }}"
                        type="button"
                    ></button>
                @endforeach
            </div>

            {{-- Lightbox dialog --}}
            <dialog
                class="atelier-lightbox"
                id="atelier-lightbox"
                aria-label="Atelier galerij volledig scherm"
            >
                <button class="lightbox-close" id="atelier-lb-close" aria-label="Sluiten" type="button">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                        <path d="M18 6L6 18M6 6l12 12" stroke-linecap="round"/>
                    </svg>
                </button>
                <button class="lightbox-prev" id="atelier-lb-prev" aria-label="Vorige foto" type="button">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <img class="lightbox-img" id="atelier-lb-img" src="" alt="" loading="lazy">
                <button class="lightbox-next" id="atelier-lb-next" aria-label="Volgende foto" type="button">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <span class="lightbox-counter" id="atelier-lb-counter" aria-live="polite"></span>
            </dialog>

        @endif

    </div>
</section>

@if($hasImages)
@push('scripts')
<script>
(function () {
    'use strict';

    var dataEl = document.getElementById('atelier-gallery-data');
    if (!dataEl) return;

    var allImages  = JSON.parse(dataEl.textContent || '[]');
    var grid       = document.getElementById('atelier-grid');
    var lightbox   = document.getElementById('atelier-lightbox');
    var lbImg      = document.getElementById('atelier-lb-img');
    var lbCounter  = document.getElementById('atelier-lb-counter');
    var lbClose    = document.getElementById('atelier-lb-close');
    var lbPrev     = document.getElementById('atelier-lb-prev');
    var lbNext     = document.getElementById('atelier-lb-next');

    if (!grid || !lightbox) return;

    var frames      = Array.prototype.slice.call(grid.querySelectorAll('.atelier-frame'));
    var FADE_MS     = 700;
    var INTERVAL_MS = 4200;
    var frameShown  = frames.map(function (_, i) { return i; });
    var nextPtr     = frames.length;
    var currentIdx  = 0;
    var swapTimer   = null;
    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    // ── Auto-cycling ──────────────────────────────────────────────────────
    function swapOneFrame() {
        if (allImages.length <= frames.length) return;

        var slot      = Math.floor(Math.random() * frames.length);
        var shown     = new Set(frameShown);
        var candidate = nextPtr % allImages.length;
        var tries     = 0;

        while (shown.has(candidate) && tries < allImages.length) {
            nextPtr++;
            candidate = nextPtr % allImages.length;
            tries++;
        }
        if (tries >= allImages.length) return;

        var frame = frames[slot];
        frame.style.opacity = '0';

        setTimeout(function () {
            frame.style.backgroundImage = 'url("' + asset(allImages[candidate]) + '")';
            frame.style.opacity = '1';
        }, FADE_MS);

        frameShown[slot]             = candidate;
        frame.dataset.lightboxIndex  = candidate;
        nextPtr++;
    }

    function asset(path) {
        return '/' + path.replace(/^\//, '');
    }

    if (!prefersReduced && allImages.length > frames.length) {
        swapTimer = setInterval(swapOneFrame, INTERVAL_MS);
    }

    // ── Lightbox ──────────────────────────────────────────────────────────
    function openLightbox(idx) {
        currentIdx = Math.max(0, Math.min(idx, allImages.length - 1));
        updateLightbox();
        lightbox.showModal();
    }

    function updateLightbox() {
        lbImg.src     = asset(allImages[currentIdx]);
        lbImg.alt     = 'Atelier foto ' + (currentIdx + 1) + ' van ' + allImages.length;
        lbCounter.textContent = (currentIdx + 1) + ' / ' + allImages.length;
    }

    frames.forEach(function (frame) {
        frame.addEventListener('click', function () {
            openLightbox(parseInt(frame.dataset.lightboxIndex, 10) || 0);
        });
    });

    lbClose.addEventListener('click', function () { lightbox.close(); });

    lbPrev.addEventListener('click', function () {
        currentIdx = (currentIdx - 1 + allImages.length) % allImages.length;
        updateLightbox();
    });

    lbNext.addEventListener('click', function () {
        currentIdx = (currentIdx + 1) % allImages.length;
        updateLightbox();
    });

    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) lightbox.close();
    });

    document.addEventListener('keydown', function (e) {
        if (!lightbox.open) return;
        if (e.key === 'ArrowLeft')  { currentIdx = (currentIdx - 1 + allImages.length) % allImages.length; updateLightbox(); }
        if (e.key === 'ArrowRight') { currentIdx = (currentIdx + 1) % allImages.length; updateLightbox(); }
        if (e.key === 'Escape')     { lightbox.close(); }
    });

    // Touch swipe support
    var touchStartX = 0;
    lightbox.addEventListener('touchstart', function (e) { touchStartX = e.touches[0].clientX; }, { passive: true });
    lightbox.addEventListener('touchend', function (e) {
        var dx = e.changedTouches[0].clientX - touchStartX;
        if (Math.abs(dx) < 50) return;
        if (dx < 0) { currentIdx = (currentIdx + 1) % allImages.length; }
        else        { currentIdx = (currentIdx - 1 + allImages.length) % allImages.length; }
        updateLightbox();
    });

    // Pause cycling while lightbox is open
    lightbox.addEventListener('close', function () {
        if (!prefersReduced && !swapTimer && allImages.length > frames.length) {
            swapTimer = setInterval(swapOneFrame, INTERVAL_MS);
        }
    });
    lightbox.addEventListener('open', function () {
        if (swapTimer) { clearInterval(swapTimer); swapTimer = null; }
    });

}());
</script>
@endpush
@endif

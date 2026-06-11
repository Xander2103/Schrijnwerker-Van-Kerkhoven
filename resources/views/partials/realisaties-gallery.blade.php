{{-- ============================================================
     Category gallery: wooden-framed static grid.
     Requires: $galleryImages (array of relative public paths)
     Optional: $galleryTitle (string)

     Shows all available images. Lightbox opens on click.
     Respects prefers-reduced-motion.
     ============================================================ --}}
@php
    $galleryTitle = $galleryTitle ?? 'Onze realisaties';
    $allUrls      = array_values(array_map(fn($p) => asset($p), $galleryImages ?? []));
    $hasImages    = count($allUrls) > 0;
    $manyImages   = count($allUrls) > 9;
@endphp

<section class="curated-gallery-section client-section">
    <div class="client-container">

        <div class="section-header reveal">
            <span class="section-eyebrow">Realisaties</span>
            <h2 class="section-title">{{ $galleryTitle }}</h2>
        </div>

        @if($hasImages)
            <div
                class="curated-gallery{{ $manyImages ? ' curated-gallery--many' : '' }}"
                id="curated-gallery"
                role="list"
                aria-label="{{ $galleryTitle }}"
            >
                @foreach($allUrls as $i => $url)
                    <button
                        class="curated-frame"
                        type="button"
                        role="listitem"
                        aria-label="Foto {{ $i + 1 }} van {{ count($allUrls) }} — klik om te vergroten"
                        data-lightbox-index="{{ $i }}"
                        style="background-image:url('{{ $url }}')"
                    ></button>
                @endforeach
            </div>
        @else
            <p class="section-intro" style="text-align:center;padding:3rem 0;">
                Foto's worden hier geplaatst.
            </p>
        @endif

    </div>
</section>

{{-- ─── Lightbox ──────────────────────────────────────────────────── --}}
<dialog
    class="realisaties-lightbox"
    id="realisaties-lightbox"
    aria-label="Foto vergroot"
    aria-modal="true"
>
    <button class="lightbox-close" type="button" aria-label="Sluiten">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
            <path d="M18 6 6 18M6 6l12 12" stroke-linecap="round"/>
        </svg>
    </button>
    <div class="lightbox-inner">
        <img class="lightbox-img" src="" alt="" loading="eager">
    </div>
    <div class="lightbox-nav" aria-label="Navigatie">
        <button class="lightbox-nav-btn lightbox-prev" type="button" aria-label="Vorige foto">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <span class="lightbox-counter" aria-live="polite"></span>
        <button class="lightbox-nav-btn lightbox-next" type="button" aria-label="Volgende foto">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M6 4l4 4-4 4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</dialog>

@push('scripts')
<script id="curated-gallery-data" type="application/json">
{!! json_encode($allUrls, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
<script>
(function () {
  'use strict';

  var dataEl = document.getElementById('curated-gallery-data');
  var dialog = document.getElementById('realisaties-lightbox');
  if (!dataEl || !dialog) return;

  var allImages;
  try { allImages = JSON.parse(dataEl.textContent); } catch (e) { return; }
  if (!allImages || !allImages.length) return;

  var frames   = Array.from(document.querySelectorAll('.curated-frame'));
  var lbImg    = dialog.querySelector('.lightbox-img');
  var counter  = dialog.querySelector('.lightbox-counter');
  var closeBtn = dialog.querySelector('.lightbox-close');
  var prevBtn  = dialog.querySelector('.lightbox-prev');
  var nextBtn  = dialog.querySelector('.lightbox-next');
  var lbCurrent = 0;

  function lbShow(idx) {
    lbCurrent = ((idx % allImages.length) + allImages.length) % allImages.length;
    lbImg.src = allImages[lbCurrent];
    lbImg.alt = 'Realisatie ' + (lbCurrent + 1) + ' van ' + allImages.length;
    if (counter) counter.textContent = (lbCurrent + 1) + ' / ' + allImages.length;
  }

  function lbOpen(idx) {
    lbShow(idx);
    dialog.showModal();
    document.body.style.overflow = 'hidden';
  }

  function lbClose() {
    dialog.close();
    document.body.style.overflow = '';
  }

  frames.forEach(function (btn) {
    btn.addEventListener('click', function () {
      lbOpen(parseInt(btn.dataset.lightboxIndex, 10));
    });
  });

  if (closeBtn) closeBtn.addEventListener('click', lbClose);
  if (prevBtn)  prevBtn.addEventListener('click',  function () { lbShow(lbCurrent - 1); });
  if (nextBtn)  nextBtn.addEventListener('click',  function () { lbShow(lbCurrent + 1); });

  dialog.addEventListener('click', function (e) { if (e.target === dialog) lbClose(); });

  document.addEventListener('keydown', function (e) {
    if (!dialog.open) return;
    if (e.key === 'ArrowLeft')  lbShow(lbCurrent - 1);
    if (e.key === 'ArrowRight') lbShow(lbCurrent + 1);
    if (e.key === 'Escape')     lbClose();
  });

  var touchX = null;
  dialog.addEventListener('touchstart', function (e) { touchX = e.touches[0].clientX; }, { passive: true });
  dialog.addEventListener('touchend',   function (e) {
    if (touchX === null) return;
    var dx = e.changedTouches[0].clientX - touchX;
    if (Math.abs(dx) > 50) { dx < 0 ? lbShow(lbCurrent + 1) : lbShow(lbCurrent - 1); }
    touchX = null;
  }, { passive: true });
}());
</script>
@endpush

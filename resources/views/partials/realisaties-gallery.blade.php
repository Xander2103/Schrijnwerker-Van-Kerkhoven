{{-- ============================================================
     Realisaties photo gallery with dialog lightbox.
     Requires: $galleryImages (array of relative public paths)
     Optional: $galleryTitle (string, defaults to "Onze realisaties")
     ============================================================ --}}
@php
    $galleryTitle = $galleryTitle ?? 'Onze realisaties';
    $assetUrls    = array_map(fn($p) => asset($p), $galleryImages ?? []);
@endphp

<section class="realisaties-section client-section-alt wood-bg-ivory">
    <div class="client-container">

        <div class="section-header reveal">
            <span class="section-eyebrow">Realisaties</span>
            <h2 class="section-title">{{ $galleryTitle }}</h2>
        </div>

        @if(!empty($assetUrls))
            <div class="realisaties-grid reveal-stagger" id="realisaties-grid">
                @foreach($assetUrls as $index => $url)
                    <button
                        class="realisatie-btn reveal"
                        type="button"
                        aria-label="Realisatie {{ $index + 1 }} vergroot weergeven"
                        data-lightbox-src="{{ $url }}"
                        data-lightbox-index="{{ $index }}"
                        style="background-image:url('{{ $url }}')"
                    ></button>
                @endforeach
            </div>
        @else
            <p class="section-intro" style="text-align:center;color:var(--color-text-light);">
                Foto's worden hier geplaatst.
            </p>
        @endif

    </div>
</section>

{{-- Lightbox dialog --}}
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
<script id="realisaties-data" type="application/json">
{!! json_encode(array_values($assetUrls), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
<script>
(function () {
  'use strict';

  var dataEl  = document.getElementById('realisaties-data');
  var dialog  = document.getElementById('realisaties-lightbox');
  if (!dataEl || !dialog) return;

  var images;
  try { images = JSON.parse(dataEl.textContent); } catch (e) { return; }
  if (!images || !images.length) return;

  var lightboxImg  = dialog.querySelector('.lightbox-img');
  var counter      = dialog.querySelector('.lightbox-counter');
  var closeBtn     = dialog.querySelector('.lightbox-close');
  var prevBtn      = dialog.querySelector('.lightbox-prev');
  var nextBtn      = dialog.querySelector('.lightbox-next');
  var current      = 0;

  function show(index) {
    current = ((index % images.length) + images.length) % images.length;
    lightboxImg.src = images[current];
    lightboxImg.alt = 'Realisatie ' + (current + 1);
    if (counter) counter.textContent = (current + 1) + ' / ' + images.length;
  }

  function open(index) {
    show(index);
    dialog.showModal();
    document.body.style.overflow = 'hidden';
  }

  function close() {
    dialog.close();
    document.body.style.overflow = '';
  }

  // Open on tile click
  document.querySelectorAll('.realisatie-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      open(parseInt(btn.dataset.lightboxIndex, 10));
    });
  });

  // Controls
  if (closeBtn) closeBtn.addEventListener('click', close);
  if (prevBtn)  prevBtn.addEventListener('click', function () { show(current - 1); });
  if (nextBtn)  nextBtn.addEventListener('click', function () { show(current + 1); });

  // Backdrop click closes
  dialog.addEventListener('click', function (e) {
    if (e.target === dialog) close();
  });

  // Keyboard navigation
  dialog.addEventListener('keydown', function (e) {
    if (e.key === 'ArrowLeft')  show(current - 1);
    if (e.key === 'ArrowRight') show(current + 1);
  });

  // Swipe support (touch)
  var touchStartX = null;
  dialog.addEventListener('touchstart', function (e) {
    touchStartX = e.touches[0].clientX;
  }, { passive: true });
  dialog.addEventListener('touchend', function (e) {
    if (touchStartX === null) return;
    var dx = e.changedTouches[0].clientX - touchStartX;
    if (Math.abs(dx) > 50) dx < 0 ? show(current + 1) : show(current - 1);
    touchStartX = null;
  }, { passive: true });
}());
</script>
@endpush

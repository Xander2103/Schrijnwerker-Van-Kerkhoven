@extends('layouts.client')

@section('page_title', 'Onze werkplaats — Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Bekijk de werkplaats van Algemene Schrijnwerkerij Van Kerkhoven in Huldenberg. Eigen machines, ervaren handen en productie van ramen, deuren en trappen op maat.')

@section('content')

@php
    $allUrls     = array_values(array_map(fn($p) => asset($p), $atelierImages ?? []));
    $previewUrls = array_slice($allUrls, 0, 6);
    $moreUrls    = array_slice($allUrls, 6);
    $hasMore     = count($moreUrls) > 0;
@endphp

{{-- Compact page header: back link + title strip --}}
<header class="werkplaats-page-header">
    <div class="client-container">
        <a href="/" class="werkplaats-back">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Terug naar homepage
        </a>
        <div class="werkplaats-page-title">
            <span class="section-eyebrow">Eigen werkplaats</span>
            <h1 class="werkplaats-title-compact">Waar vakmanschap vorm krijgt</h1>
        </div>
    </div>
</header>

{{-- Featured 6-photo gallery --}}
<section class="werkplaats-gallery-section">
    <div class="client-container">

        @if(count($previewUrls) > 0)
            <div class="atelier-preview-grid" role="list" aria-label="Werkplaats — preview foto's">
                @foreach($previewUrls as $i => $url)
                    <button
                        class="atelier-frame"
                        type="button"
                        role="listitem"
                        data-lightbox-index="{{ $i }}"
                        style="background-image:url('{{ $url }}')"
                        aria-label="Werkplaatsfoto {{ $i + 1 }} — klik om te vergroten"
                    ></button>
                @endforeach
            </div>
        @endif

        @if($hasMore)
            <div class="atelier-show-more-wrap" id="atelier-show-more-wrap">
                <button class="btn btn-secondary atelier-show-more-btn" type="button" id="atelier-show-more-btn">
                    Zie meer foto's
                </button>
            </div>

            <div class="atelier-more-grid" id="atelier-more" hidden role="list" aria-label="Meer werkplaatsfotos">
                @foreach($moreUrls as $j => $url)
                    <button
                        class="atelier-frame"
                        type="button"
                        role="listitem"
                        data-lightbox-index="{{ 6 + $j }}"
                        style="background-image:url('{{ $url }}')"
                        aria-label="Werkplaatsfoto {{ 6 + $j + 1 }} — klik om te vergroten"
                    ></button>
                @endforeach
            </div>
        @endif

    </div>
</section>

{{-- Lightbox --}}
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

@endsection

@push('scripts')
<script id="curated-gallery-data" type="application/json">
{!! json_encode($allUrls, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
<script>
(function () {
  'use strict';

  /* ── Lightbox ─────────────────────────────────────────────── */
  var dataEl = document.getElementById('curated-gallery-data');
  var dialog = document.getElementById('realisaties-lightbox');
  if (!dataEl || !dialog) return;

  var allImages;
  try { allImages = JSON.parse(dataEl.textContent); } catch (e) { return; }
  if (!allImages || !allImages.length) return;

  var lbImg    = dialog.querySelector('.lightbox-img');
  var counter  = dialog.querySelector('.lightbox-counter');
  var closeBtn = dialog.querySelector('.lightbox-close');
  var prevBtn  = dialog.querySelector('.lightbox-prev');
  var nextBtn  = dialog.querySelector('.lightbox-next');
  var lbCurrent = 0;

  function lbShow(idx) {
    lbCurrent = ((idx % allImages.length) + allImages.length) % allImages.length;
    lbImg.src = allImages[lbCurrent];
    lbImg.alt = 'Werkplaatsfoto ' + (lbCurrent + 1) + ' van ' + allImages.length;
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

  function bindFrames() {
    document.querySelectorAll('.atelier-frame').forEach(function (btn) {
      if (btn._lbBound) return;
      btn._lbBound = true;
      btn.addEventListener('click', function () {
        lbOpen(parseInt(btn.dataset.lightboxIndex, 10));
      });
    });
  }
  bindFrames();

  if (closeBtn) closeBtn.addEventListener('click', lbClose);
  if (prevBtn)  prevBtn.addEventListener('click', function () { lbShow(lbCurrent - 1); });
  if (nextBtn)  nextBtn.addEventListener('click', function () { lbShow(lbCurrent + 1); });

  dialog.addEventListener('click', function (e) { if (e.target === dialog) lbClose(); });

  document.addEventListener('keydown', function (e) {
    if (!dialog.open) return;
    if (e.key === 'ArrowLeft')  lbShow(lbCurrent - 1);
    if (e.key === 'ArrowRight') lbShow(lbCurrent + 1);
    if (e.key === 'Escape')     lbClose();
  });

  var touchX = null;
  dialog.addEventListener('touchstart', function (e) { touchX = e.touches[0].clientX; }, { passive: true });
  dialog.addEventListener('touchend', function (e) {
    if (touchX === null) return;
    var dx = e.changedTouches[0].clientX - touchX;
    if (Math.abs(dx) > 50) { dx < 0 ? lbShow(lbCurrent + 1) : lbShow(lbCurrent - 1); }
    touchX = null;
  }, { passive: true });

  /* ── "Zie meer foto's" reveal ─────────────────────────── */
  var showMoreBtn  = document.getElementById('atelier-show-more-btn');
  var showMoreWrap = document.getElementById('atelier-show-more-wrap');
  var moreGrid     = document.getElementById('atelier-more');

  if (showMoreBtn && moreGrid) {
    showMoreBtn.addEventListener('click', function () {
      moreGrid.hidden = false;
      requestAnimationFrame(function () {
        moreGrid.classList.add('is-visible');
      });
      showMoreWrap.hidden = true;
      bindFrames();
      setTimeout(function () {
        moreGrid.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }, 80);
    });
  }

  /* ── Animated cycling of the 6-photo preview ──────────── */
  (function () {
    // Respect prefers-reduced-motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    // Only cycle when there are more than 6 photos to draw from
    if (!allImages || allImages.length <= 6) return;

    var previewFrames = Array.from(
      document.querySelectorAll('.atelier-preview-grid .atelier-frame')
    );
    if (!previewFrames.length) return;

    // Track which allImages index each preview slot is currently showing
    var frameIndices = previewFrames.map(function (_, i) { return i; });
    var poolPtr      = 6;  // start pulling from index 6 (after the initial set)
    var slotPtr      = 0;  // rotate through slots so all 6 cycle evenly
    var cycleTimer   = null;

    function isShown(idx) {
      for (var i = 0; i < frameIndices.length; i++) {
        if (frameIndices[i] === idx) return true;
      }
      return false;
    }

    function pickNextImage() {
      var total = allImages.length;
      var tries = 0;
      while (tries < total) {
        var candidate = poolPtr % total;
        poolPtr = (poolPtr + 1) % total;
        if (!isShown(candidate)) return candidate;
        tries++;
      }
      return -1; // all images already visible — unlikely with 42 photos
    }

    function cycleOne() {
      var slot  = slotPtr % previewFrames.length;
      slotPtr   = (slotPtr + 1) % previewFrames.length;
      var newIdx = pickNextImage();
      if (newIdx === -1) return;

      var frame = previewFrames[slot];

      // Fade out
      frame.classList.add('is-fading');

      setTimeout(function () {
        // Swap content while invisible
        frame.style.backgroundImage = 'url(' + allImages[newIdx] + ')';
        frame.dataset.lightboxIndex  = String(newIdx);
        frameIndices[slot]           = newIdx;
        // Fade back in
        frame.classList.remove('is-fading');
      }, 480); // slightly longer than opacity transition (0.45s)
    }

    cycleTimer = setInterval(cycleOne, 3800);

    // Stop cycling once "Zie meer" is clicked
    if (showMoreBtn) {
      showMoreBtn.addEventListener('click', function () {
        if (cycleTimer) { clearInterval(cycleTimer); cycleTimer = null; }
      }, true);
    }
  }());
}());
</script>
@endpush

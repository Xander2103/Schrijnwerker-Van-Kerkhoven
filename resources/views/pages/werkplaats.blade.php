@extends('layouts.client')

@section('page_title', __('pages.werkplaats_title'))
@section('page_description', __('pages.werkplaats_desc'))

@section('content')

@php
    $locale  ??= 'nl';
    $allUrls     = array_values(array_map(fn($p) => asset($p), $atelierImages ?? []));
    $previewUrls = array_slice($allUrls, 0, 6);
    $moreUrls    = array_slice($allUrls, 6);
    $hasMore     = count($moreUrls) > 0;
@endphp

<header class="werkplaats-page-header">
    <div class="client-container">
        <a href="/{{ $locale }}" class="werkplaats-back">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{ __('pages.werkplaats_back') }}
        </a>
        <div class="werkplaats-page-title">
            <span class="section-eyebrow">{{ __('pages.werkplaats_eyebrow') }}</span>
            <h1 class="werkplaats-title-compact">{{ __('pages.werkplaats_heading') }}</h1>
        </div>
    </div>
</header>

<section class="werkplaats-gallery-section">
    <div class="client-container">

        @if(count($previewUrls) > 0)
            <div class="atelier-preview-grid" role="list" aria-label="{{ __('pages.werkplaats_aria') }}">
                @foreach($previewUrls as $i => $url)
                    <button
                        class="atelier-frame"
                        type="button"
                        role="listitem"
                        data-lightbox-index="{{ $i }}"
                        style="background-image:url('{{ $url }}')"
                        aria-label="{{ __('site.photo_label', ['n' => $i + 1, 'm' => count($allUrls)]) }}"
                    ></button>
                @endforeach
            </div>
        @endif

        @if($hasMore)
            <div class="atelier-show-more-wrap" id="atelier-show-more-wrap">
                <button class="btn btn-secondary atelier-show-more-btn" type="button" id="atelier-show-more-btn">
                    {{ __('pages.werkplaats_more') }}
                </button>
            </div>

            <div class="atelier-more-grid" id="atelier-more" hidden role="list" aria-label="{{ __('pages.werkplaats_more_aria') }}">
                @foreach($moreUrls as $j => $url)
                    <button
                        class="atelier-frame"
                        type="button"
                        role="listitem"
                        data-lightbox-index="{{ 6 + $j }}"
                        style="background-image:url('{{ $url }}')"
                        aria-label="{{ __('site.photo_label', ['n' => 6 + $j + 1, 'm' => count($allUrls)]) }}"
                    ></button>
                @endforeach
            </div>
        @endif

    </div>
</section>

<dialog
    class="realisaties-lightbox"
    id="realisaties-lightbox"
    aria-label="{{ __('site.lightbox_label') }}"
    aria-modal="true"
>
    <button class="lightbox-close" type="button" aria-label="{{ __('site.close') }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
            <path d="M18 6 6 18M6 6l12 12" stroke-linecap="round"/>
        </svg>
    </button>
    <div class="lightbox-inner">
        <img class="lightbox-img" src="" alt="" loading="eager">
    </div>
    <div class="lightbox-nav" aria-label="{{ __('site.nav_label') }}">
        <button class="lightbox-nav-btn lightbox-prev" type="button" aria-label="{{ __('site.prev_photo') }}">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <span class="lightbox-counter" aria-live="polite"></span>
        <button class="lightbox-nav-btn lightbox-next" type="button" aria-label="{{ __('site.next_photo') }}">
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
    lbImg.alt = (lbCurrent + 1) + ' / ' + allImages.length;
    if (counter) counter.textContent = (lbCurrent + 1) + ' / ' + allImages.length;
  }

  function lbOpen(idx) { lbShow(idx); dialog.showModal(); document.body.style.overflow = 'hidden'; }
  function lbClose()   { dialog.close(); document.body.style.overflow = ''; }

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
  dialog.addEventListener('touchend', function (e) {
    if (touchX === null) return;
    var dx = e.changedTouches[0].clientX - touchX;
    if (Math.abs(dx) > 50) { dx < 0 ? lbShow(lbCurrent + 1) : lbShow(lbCurrent - 1); }
    touchX = null;
  }, { passive: true });

  /* ── "Zie meer / voir plus / see more" reveal ── */
  var showMoreBtn  = document.getElementById('atelier-show-more-btn');
  var showMoreWrap = document.getElementById('atelier-show-more-wrap');
  var moreGrid     = document.getElementById('atelier-more');

  if (showMoreBtn && moreGrid) {
    showMoreBtn.addEventListener('click', function () {
      moreGrid.hidden = false;
      requestAnimationFrame(function () { moreGrid.classList.add('is-visible'); });
      showMoreWrap.hidden = true;
      bindFrames();
      setTimeout(function () { moreGrid.scrollIntoView({ behavior: 'smooth', block: 'nearest' }); }, 80);
    });
  }

  /* ── Animated preview cycling ── */
  (function () {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    if (!allImages || allImages.length <= 6) return;

    var previewFrames = Array.from(document.querySelectorAll('.atelier-preview-grid .atelier-frame'));
    if (!previewFrames.length) return;

    var frameIndices = previewFrames.map(function (_, i) { return i; });
    var poolPtr = 6, slotPtr = 0, cycleTimer = null;

    function isShown(idx) { return frameIndices.indexOf(idx) !== -1; }

    function pickNextImage() {
      var total = allImages.length, tries = 0;
      while (tries < total) {
        var candidate = poolPtr % total;
        poolPtr = (poolPtr + 1) % total;
        if (!isShown(candidate)) return candidate;
        tries++;
      }
      return -1;
    }

    function cycleOne() {
      var slot   = slotPtr % previewFrames.length;
      slotPtr    = (slotPtr + 1) % previewFrames.length;
      var newIdx = pickNextImage();
      if (newIdx === -1) return;
      var frame  = previewFrames[slot];
      frame.classList.add('is-fading');
      setTimeout(function () {
        frame.style.backgroundImage = 'url(' + allImages[newIdx] + ')';
        frame.dataset.lightboxIndex  = String(newIdx);
        frameIndices[slot]           = newIdx;
        frame.classList.remove('is-fading');
      }, 480);
    }

    cycleTimer = setInterval(cycleOne, 3800);

    if (showMoreBtn) {
      showMoreBtn.addEventListener('click', function () {
        if (cycleTimer) { clearInterval(cycleTimer); cycleTimer = null; }
      }, true);
    }
  }());
}());
</script>
@endpush

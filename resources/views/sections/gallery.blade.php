@php
    // $galleryImages is passed from the home route (array of relative paths).
    // Falls back to config for other pages that might include this section.
    $allImages  = $galleryImages ?? config('images.gallery', []);
    $firstFour  = array_slice($allImages, 0, 4);
    $hasImages  = count($allImages) > 0;
    $assetUrls  = array_map(fn($p) => asset($p), $allImages);
@endphp

<section id="gallery" class="client-section-alt wood-bg-cream">
    <div class="client-container">

        <div class="section-header reveal">
            <span class="section-eyebrow">Sfeerbeelden</span>
            <h2 class="section-title">Ons werk in beeld</h2>
        </div>

        <div class="gallery-grid" id="gallery-grid">
            @if($hasImages)
                @foreach($firstFour as $i => $imagePath)
                    <div
                        class="gallery-item gallery-cycler"
                        style="background-image:url('{{ asset($imagePath) }}')"
                        role="img"
                        aria-label="Schrijnwerk projectfoto {{ $i + 1 }}"
                    ></div>
                @endforeach
                {{-- Pad to 4 cards if fewer than 4 images --}}
                @for($p = count($firstFour); $p < 4; $p++)
                    <div class="gallery-item gallery-cycler"
                         style="background-image:url('{{ asset($firstFour[0] ?? '') }}')"
                         role="img" aria-label="Schrijnwerk projectfoto"></div>
                @endfor
            @else
                @for($i = 1; $i <= 4; $i++)
                    <div class="gallery-item image-fallback" aria-hidden="true">
                        <span>Foto {{ $i }}</span>
                    </div>
                @endfor
            @endif
        </div>

    </div>
</section>

@if($hasImages)
{{-- All image URLs for the JS cycler --}}
<script id="gallery-data" type="application/json">
{!! json_encode(array_values($assetUrls), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

@push('scripts')
<script>
(function () {
  'use strict';

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var dataEl = document.getElementById('gallery-data');
  if (!dataEl) return;

  var images;
  try { images = JSON.parse(dataEl.textContent); } catch (e) { return; }
  if (!images || images.length < 2) return;

  var cards = Array.prototype.slice.call(document.querySelectorAll('.gallery-cycler'));
  if (!cards.length) return;

  // Preload all images so swaps are instant
  images.forEach(function (src) {
    var img = new Image();
    img.src = src;
  });

  var offset = 0;
  var paused = false;
  var INTERVAL = 3000;
  var FADE_MS  = 420;

  function advance() {
    if (paused) return;

    // Stagger fade-out slightly per card for a nicer effect
    cards.forEach(function (card, i) {
      setTimeout(function () {
        card.style.opacity = '0';
      }, i * 60);
    });

    setTimeout(function () {
      offset = (offset + 1) % images.length;
      cards.forEach(function (card, i) {
        card.style.backgroundImage = 'url("' + images[(offset + i) % images.length] + '")';
        card.style.opacity = '1';
      });
    }, FADE_MS + cards.length * 60);
  }

  var timer = setInterval(advance, INTERVAL);

  var section = document.getElementById('gallery');
  if (section) {
    section.addEventListener('mouseenter', function () { paused = true; });
    section.addEventListener('mouseleave', function () { paused = false; });
    section.addEventListener('focusin',    function () { paused = true; });
    section.addEventListener('focusout',   function () { paused = false; });
  }
}());
</script>
@endpush
@endif

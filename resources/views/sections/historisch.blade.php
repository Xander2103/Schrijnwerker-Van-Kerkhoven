{{-- ============================================================
     Historisch schrijnwerk — premium redesign.
     Left col:  italic caramel title + ornament + main image (full).
     Right col: overlapping polaroid-style card collage.
     Desktop: absolutely stacked, rotated cards with hover lift.
     Mobile:  clean 2×2 grid for cards, no overflow risk.
     ============================================================ --}}
@php
    $historischAll  = $historischImages ?? [];
    $historischMain = null;
    $historischPool = [];
    foreach ($historischAll as $img) {
        if (str_contains($img, 'historisch-werk.webp')) {
            $historischMain = $img;
        } else {
            $historischPool[] = $img;
        }
    }
    // Fallback: if named anchor absent, use first available
    if (!$historischMain && count($historischAll) > 0) {
        $historischMain = $historischAll[0];
        $historischPool = array_slice($historischAll, 1);
    }
    // Show up to 4 cards in the collage
    $collageCards = array_slice($historischPool, 0, 4);
    // Staggered rotations for artisanal scattered feel
    $rotations = ['-4deg', '3.5deg', '-2.5deg', '5deg'];
@endphp

<section id="historisch" class="client-section historisch-section wood-bg-ivory">
    <div class="client-container">
        <div class="historisch-layout">

            {{-- ─── Left: title + ornament + main image ──── --}}
            <div class="historisch-left">

                <div class="historisch-heading reveal">
                    <h2 class="historisch-title">Historisch schrijnwerk</h2>
                    <div class="historisch-ornament" aria-hidden="true">◆</div>
                </div>

                @if($historischMain)
                    <div class="historisch-main-frame reveal" data-reveal-delay="80">
                        <img
                            src="{{ asset($historischMain) }}"
                            alt="Historisch schrijnwerk — Van Kerkhoven"
                            class="historisch-main-img"
                            loading="lazy"
                        >
                    </div>
                @endif

            </div>

            {{-- ─── Right: overlapping card collage ───────── --}}
            @if(count($collageCards) > 0)
                <div class="historisch-collage-wrap reveal" data-reveal-delay="160">
                    <div class="historisch-card-stack" id="historisch-card-stack">
                        @foreach($collageCards as $k => $img)
                            <div
                                class="historisch-card historisch-card--{{ $k + 1 }}"
                                style="--rot: {{ $rotations[$k] ?? '0deg' }}"
                            >
                                <img
                                    src="{{ asset($img) }}"
                                    alt="Historisch schrijnwerk — detail {{ $k + 2 }}"
                                    loading="lazy"
                                >
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Pool JSON for cycling JS --}}
                <script id="historisch-pool-data" type="application/json">
                {!! json_encode(
                    array_values(array_map(fn($p) => asset($p), $historischPool)),
                    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
                ) !!}
                </script>
            @endif

        </div>
    </div>
</section>

@push('scripts')
<script>
(function () {
  'use strict';

  // Respect prefers-reduced-motion
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var poolEl = document.getElementById('historisch-pool-data');
  var stack  = document.getElementById('historisch-card-stack');
  if (!poolEl || !stack) return;

  var pool;
  try { pool = JSON.parse(poolEl.textContent); } catch (e) { return; }
  if (!pool || pool.length < 2) return;

  var cards = Array.from(stack.querySelectorAll('.historisch-card img'));
  if (!cards.length) return;

  // Track which pool index is visible in each card slot
  var shownIndices = cards.map(function (_, i) { return i % pool.length; });
  // Next pool slot to pull from (beyond what's initially shown)
  var poolPtr = cards.length % pool.length;
  // Which card slot to cycle next
  var slotPtr = 0;

  function isShown(idx) {
    return shownIndices.indexOf(idx) !== -1;
  }

  function pickNext() {
    var tries = 0;
    while (tries < pool.length) {
      var candidate = poolPtr % pool.length;
      poolPtr = (poolPtr + 1) % pool.length;
      if (!isShown(candidate)) return candidate;
      tries++;
    }
    return -1; // all images visible — pool too small, skip this cycle
  }

  function cycleOne() {
    var slot   = slotPtr % cards.length;
    slotPtr    = (slotPtr + 1) % cards.length;
    var newIdx = pickNext();
    if (newIdx === -1) return;

    var img = cards[slot];

    // Fade out
    img.classList.add('is-fading');

    setTimeout(function () {
      // Swap while invisible
      img.src              = pool[newIdx];
      img.alt              = 'Historisch schrijnwerk — detail';
      shownIndices[slot]   = newIdx;
      // Fade in
      img.classList.remove('is-fading');
    }, 460);
  }

  // Stagger first cycle so not all timers fire together
  function scheduleNext() {
    var jitter = 2500 + Math.random() * 600 - 300; // 2200–2800ms
    setTimeout(function () {
      cycleOne();
      scheduleNext();
    }, jitter);
  }

  // Small initial delay so entrance animation finishes first
  setTimeout(scheduleNext, 1800);
}());
</script>
@endpush

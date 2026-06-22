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
    if (!$historischMain && count($historischAll) > 0) {
        $historischMain = $historischAll[0];
        $historischPool = array_slice($historischAll, 1);
    }
    $collageCards = array_slice($historischPool, 0, 4);
    $rotations = ['-4deg', '3.5deg', '-2.5deg', '5deg'];
@endphp

<section id="historisch" class="client-section historisch-section wood-bg-ivory">
    <div class="client-container">
        <div class="historisch-layout">

            <div class="historisch-left">

                <div class="historisch-heading reveal">
                    <h2 class="historisch-title">{{ __('site.historisch_heading') }}</h2>
                    <div class="historisch-ornament" aria-hidden="true">◆</div>
                </div>

                @if($historischMain)
                    <div class="historisch-main-frame reveal" data-reveal-delay="80">
                        <img
                            src="{{ asset($historischMain) }}"
                            alt="{{ __('site.historisch_alt') }}"
                            class="historisch-main-img"
                            loading="lazy"
                        >
                    </div>
                @endif

            </div>

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
                                    alt="{{ __('site.historisch_detail') }} {{ $k + 2 }}"
                                    loading="lazy"
                                >
                            </div>
                        @endforeach
                    </div>
                </div>

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

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var poolEl = document.getElementById('historisch-pool-data');
  var stack  = document.getElementById('historisch-card-stack');
  if (!poolEl || !stack) return;

  var pool;
  try { pool = JSON.parse(poolEl.textContent); } catch (e) { return; }
  if (!pool || pool.length < 2) return;

  var cards = Array.from(stack.querySelectorAll('.historisch-card img'));
  if (!cards.length) return;

  var shownIndices = cards.map(function (_, i) { return i % pool.length; });
  var poolPtr = cards.length % pool.length;
  var slotPtr = 0;

  function isShown(idx) { return shownIndices.indexOf(idx) !== -1; }

  function pickNext() {
    var tries = 0;
    while (tries < pool.length) {
      var candidate = poolPtr % pool.length;
      poolPtr = (poolPtr + 1) % pool.length;
      if (!isShown(candidate)) return candidate;
      tries++;
    }
    return -1;
  }

  function cycleOne() {
    var slot   = slotPtr % cards.length;
    slotPtr    = (slotPtr + 1) % cards.length;
    var newIdx = pickNext();
    if (newIdx === -1) return;
    var img = cards[slot];
    img.classList.add('is-fading');
    setTimeout(function () {
      img.src            = pool[newIdx];
      img.alt            = '{{ __("site.historisch_detail") }}';
      shownIndices[slot] = newIdx;
      img.classList.remove('is-fading');
    }, 460);
  }

  function scheduleNext() {
    var jitter = 2500 + Math.random() * 600 - 300;
    setTimeout(function () { cycleOne(); scheduleNext(); }, jitter);
  }

  setTimeout(scheduleNext, 1800);
}());
</script>
@endpush

{{-- ============================================================
     Historisch schrijnwerk — title left, photo collage right.
     Main image: historisch-werk.webp (always large).
     Secondary images from the same folder cycle in smaller slots.
     ============================================================ --}}
@php
    $historischAll = $historischImages ?? [];
    // Separate the main anchor image from the cycling secondary pool
    $historischMain = null;
    $historischPool = [];
    foreach ($historischAll as $img) {
        if (str_contains($img, 'historisch-werk.webp')) {
            $historischMain = $img;
        } else {
            $historischPool[] = $img;
        }
    }
    // Fallback: if the named file is absent, use the first available image
    if (!$historischMain && count($historischAll) > 0) {
        $historischMain = $historischAll[0];
        $historischPool = array_slice($historischAll, 1);
    }
    $historischInitial  = array_slice($historischPool, 0, 2);
    $historischPoolJson = json_encode(
        array_map(fn($p) => asset($p), $historischPool),
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
    );
    $hasCycling = count($historischPool) > 2;
@endphp

<section id="historisch" class="client-section historisch-section wood-bg-ivory">
    <div class="client-container">
        <div class="historisch-inner">

            {{-- ─── Title only — no eyebrow, no body copy ───────── --}}
            <div class="historisch-content reveal">
                <h2 class="historisch-title">Historisch schrijnwerk</h2>
            </div>

            {{-- ─── Photo collage ─────────────────────────────────── --}}
            @if($historischMain)
                <div class="historisch-collage reveal" data-reveal-delay="100">
                    <div class="historisch-collage-grid">

                        {{-- Main image — always visible, always large --}}
                        <div
                            class="historisch-main-photo"
                            style="background-image:url('{{ asset($historischMain) }}')"
                            role="img"
                            aria-label="Historisch schrijnwerk — Van Kerkhoven"
                        ></div>

                        {{-- Secondary images — cycling pool --}}
                        @if(count($historischInitial) > 0)
                            @if($hasCycling)
                                <script id="historisch-pool" type="application/json">
                                    {!! $historischPoolJson !!}
                                </script>
                            @endif
                            <div class="historisch-secondary-grid">
                                @foreach($historischInitial as $j => $img)
                                    <div
                                        class="historisch-secondary-photo"
                                        style="background-image:url('{{ asset($img) }}')"
                                        role="img"
                                        aria-label="Historisch schrijnwerk foto {{ $j + 2 }}"
                                    ></div>
                                @endforeach
                                {{-- Empty slot if only 1 secondary image --}}
                                @if(count($historischInitial) < 2)
                                    <div class="historisch-secondary-photo historisch-secondary-photo--empty"></div>
                                @endif
                            </div>
                        @endif

                    </div>
                </div>
            @endif

        </div>
    </div>
</section>

@if($hasCycling)
@push('scripts')
<script>
(function () {
    'use strict';
    var poolEl = document.getElementById('historisch-pool');
    if (!poolEl) return;
    var pool;
    try { pool = JSON.parse(poolEl.textContent); } catch (e) { return; }
    if (!pool || pool.length <= 2) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var panels = Array.from(document.querySelectorAll('.historisch-secondary-photo'));
    if (!panels.length) return;

    var nextPtr = 2; // pool[0] and pool[1] already shown initially

    setInterval(function () {
        var slot   = Math.floor(Math.random() * panels.length);
        var panel  = panels[slot];
        var newSrc = pool[nextPtr % pool.length];
        nextPtr++;

        panel.style.transition = 'opacity 0.5s ease';
        panel.style.opacity    = '0';
        setTimeout(function () {
            panel.style.backgroundImage = 'url("' + newSrc + '")';
            panel.style.opacity         = '1';
        }, 500);
    }, 5000);
}());
</script>
@endpush
@endif

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
                    <div class="historisch-card-stack">
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
            @endif

        </div>
    </div>
</section>

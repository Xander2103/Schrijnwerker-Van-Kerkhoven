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

{{-- Gallery cycling animation removed — section is disabled on homepage --}}

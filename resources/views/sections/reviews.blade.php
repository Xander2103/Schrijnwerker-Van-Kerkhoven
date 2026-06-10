@php
    $reviews        = config('reviews.items', []);
    $googleRating   = config('reviews.google_rating', 4.9);
    $googleCount    = config('reviews.google_count', 0);
    $activeReviews  = array_values(array_filter($reviews, fn($r) => !empty($r['text'])));
    $hasReviews     = count($activeReviews) > 0;
@endphp

@if($hasReviews)
<section id="reviews" class="client-section reviews-section wood-bg-oak">
    <div class="client-container">

        <div class="section-header reveal">
            <span class="section-eyebrow">Klantervaringen</span>
            <h2 class="section-title">Wat onze klanten zeggen</h2>
            <p class="section-intro">Eerlijk werk, tevreden klanten — bekijk wat anderen over ons schrijnwerk vertellen.</p>
        </div>

        {{-- Rating badge --}}
        @if($googleRating && $googleCount)
            <div class="reviews-intro-row reveal">
                <div class="rating-badge">
                    <span class="rating-score">{{ number_format($googleRating, 1) }}</span>
                    <div>
                        <div class="rating-stars-display" aria-label="{{ $googleRating }} van 5 sterren op Google">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($googleRating))
                                    <span aria-hidden="true">★</span>
                                @elseif($i - 0.5 <= $googleRating)
                                    <span aria-hidden="true" style="opacity:0.6;">★</span>
                                @else
                                    <span aria-hidden="true" style="opacity:0.25;">★</span>
                                @endif
                            @endfor
                        </div>
                        <div class="rating-meta" style="margin-top:2px;">
                            <strong>Google Reviews</strong>
                            <span>{{ $googleCount }} {{ $googleCount === 1 ? 'review' : 'reviews' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Optional: write a review link --}}
        @if(!empty(config('reviews.review_write_url')))
            <div class="reviews-intro-row reveal" style="justify-content:flex-end;">
                <a
                    href="{{ config('reviews.review_write_url') }}"
                    class="btn btn-secondary"
                    target="_blank"
                    rel="noopener noreferrer"
                >{{ config('reviews.review_write_label', 'Schrijf een review') }}</a>
            </div>
        @endif

        {{-- Carousel --}}
        <div
            class="review-carousel reveal"
            data-carousel
            id="review-carousel"
            role="region"
            aria-label="Klantenrecensies"
            aria-roledescription="carousel"
        >
            <div class="review-track">
                @foreach($activeReviews as $index => $review)
                    <article
                        class="review-card{{ $index === 0 ? ' is-active' : '' }}"
                        aria-hidden="{{ $index !== 0 ? 'true' : 'false' }}"
                        role="group"
                        aria-roledescription="slide"
                        aria-label="{{ $review['name'] }}"
                    >
                        {{-- Stars --}}
                        <div
                            class="review-stars"
                            aria-label="{{ $review['rating'] }} van 5 sterren"
                        >
                            @for($i = 1; $i <= 5; $i++)
                                <span aria-hidden="true">{{ $i <= $review['rating'] ? '★' : '☆' }}</span>
                            @endfor
                        </div>

                        {{-- Quote --}}
                        <blockquote class="review-text">
                            <p>{{ $review['text'] }}</p>
                        </blockquote>

                        {{-- Author / meta --}}
                        <footer class="review-footer">
                            <span class="review-author">{{ $review['name'] }}</span>
                            @if(!empty($review['date_label']))
                                <span class="review-date" aria-hidden="true">·</span>
                                <span class="review-date">{{ $review['date_label'] }}</span>
                            @endif
                            @if(!empty($review['source']))
                                <span class="review-source-badge">{{ $review['source'] }}</span>
                            @endif
                        </footer>
                    </article>
                @endforeach
            </div>

            {{-- Controls --}}
            @if(count($activeReviews) > 1)
                <div class="review-controls" aria-label="Carousel navigatie">

                    <button
                        class="review-nav-btn review-prev"
                        type="button"
                        aria-label="Vorige review"
                    >
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div class="review-dots" role="tablist" aria-label="Reviews">
                        @foreach($activeReviews as $index => $review)
                            <button
                                class="review-dot{{ $index === 0 ? ' is-active' : '' }}"
                                type="button"
                                role="tab"
                                aria-label="Review {{ $index + 1 }} — {{ $review['name'] }}"
                                aria-selected="{{ $index === 0 ? 'true' : 'false' }}"
                                data-index="{{ $index }}"
                            ></button>
                        @endforeach
                    </div>

                    <button
                        class="review-nav-btn review-next"
                        type="button"
                        aria-label="Volgende review"
                    >
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M6 4l4 4-4 4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                </div>
            @endif
        </div>

    </div>
</section>
@endif

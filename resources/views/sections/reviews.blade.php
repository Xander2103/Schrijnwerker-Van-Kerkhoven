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
            <span class="section-eyebrow">{{ __('site.reviews_eyebrow') }}</span>
            <h2 class="section-title">{{ __('site.reviews_heading') }}</h2>
            <p class="section-intro">{{ __('site.reviews_intro') }}</p>
        </div>

        @if($googleRating && $googleCount)
            <div class="reviews-intro-row reveal">
                <div class="rating-badge">
                    <span class="rating-score">{{ number_format($googleRating, 1) }}</span>
                    <div>
                        <div class="rating-stars-display" aria-label="{{ __('site.reviews_stars_label', ['rating' => $googleRating]) }}">
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

        <div
            class="review-carousel reveal"
            data-carousel
            id="review-carousel"
            role="region"
            aria-label="{{ __('site.reviews_aria') }}"
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
                        <div
                            class="review-stars"
                            aria-label="{{ __('site.reviews_stars_label', ['rating' => $review['rating']]) }}"
                        >
                            @for($i = 1; $i <= 5; $i++)
                                <span aria-hidden="true">{{ $i <= $review['rating'] ? '★' : '☆' }}</span>
                            @endfor
                        </div>

                        <blockquote class="review-text">
                            <p>{{ $review['text'] }}</p>
                        </blockquote>

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

            @if(count($activeReviews) > 1)
                <div class="review-controls" aria-label="{{ __('site.nav_label') }}">
                    <button class="review-nav-btn review-prev" type="button" aria-label="{{ __('site.reviews_prev') }}">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div class="review-dots" role="tablist" aria-label="{{ __('site.reviews_dots') }}">
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

                    <button class="review-nav-btn review-next" type="button" aria-label="{{ __('site.reviews_next') }}">
                        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M6 4l4 4-4 4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        @if(!empty(config('reviews.review_write_url')))
            <div class="section-actions reveal" style="margin-top:2rem;justify-content:center;">
                <a
                    href="{{ config('reviews.review_write_url') }}"
                    class="btn btn-secondary"
                    target="_blank"
                    rel="noopener noreferrer"
                >{{ __('site.reviews_write') }}</a>
            </div>
        @endif

    </div>
</section>
@endif

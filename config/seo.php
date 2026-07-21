<?php

return [
    /*
     * Sitewide fallback Open Graph / Twitter image, used whenever a page
     * has no entry in `page_images` below.
     */
    'og_image' => '/assets/client/images/hero.webp',
    'og_type'  => 'website',

    /*
     * Per-route OG/Twitter image overrides — each category page shows its
     * own real hero photo instead of the generic sitewide one. Keyed by
     * route name (see routes/web.php). Add an entry here when a new page
     * gets its own hero image.
     */
    'page_images' => [
        'ramen'           => '/assets/client/images/ramen/hero-ramen.webp',
        'deuren'          => '/assets/client/images/deuren/hero-deuren.webp',
        'trappen'         => '/assets/client/images/trappen-hero.webp',
        'poorten'         => '/assets/client/images/poorten/hero-poorten.webp',
        'portails'        => '/assets/client/images/poorten/hero-poorten.webp',
        'gates'           => '/assets/client/images/poorten/hero-poorten.webp',
        'schuiframen'     => '/assets/client/images/schuiframen/hero-schuiframen.webp',
        'coulissants'     => '/assets/client/images/schuiframen/hero-schuiframen.webp',
        'sliding-windows' => '/assets/client/images/schuiframen/hero-schuiframen.webp',
    ],

    'twitter_card' => 'summary_large_image',

    // Set to true (e.g. via env) to keep a staging/preview deploy out of search results.
    'noindex' => env('SEO_NOINDEX', false),
];
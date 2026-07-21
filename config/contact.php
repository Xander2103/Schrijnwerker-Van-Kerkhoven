<?php

return [
    'email'        => 'van.kerkhoven@outlook.be',
    'privacy_link' => '/privacy-policy', // locale prefix prepended at runtime

    /*
     * Machine-stable keys used as option values in the contact form.
     * Display labels live in lang/{locale}/contact.php → request_types.
     */
    'form_request_types' => [
        'buitenschrijnwerk',
        'ramen_op_maat',
        'trappen_op_maat',
        'maatwerk',
        'poorten',
        'andere_vraag',
    ],

    // Minimum time (seconds) between form render and submission — anti-bot timing trap.
    'min_seconds_to_submit' => 2,

    // Window (seconds) in which an identical submission is treated as a duplicate.
    'duplicate_window_seconds' => 60,

    // Named RateLimiter thresholds — see App\Providers\AppServiceProvider.
    // Counters live in the configured cache store and expire automatically
    // (no permanent blocks, no manual unblocking needed).
    'rate_limit' => [
        'per_minute'    => 3,
        'per_day'       => 10,
        'per_day_combo' => 5, // stricter limit for the same IP + e-mail pair
    ],
];

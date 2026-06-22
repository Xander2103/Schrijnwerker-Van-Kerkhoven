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
];

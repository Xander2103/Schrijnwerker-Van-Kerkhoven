<?php

return [
    'enabled' => true,

    'google_rating' => 4.9,
    'google_count'  => 7,

    'handelsgids_rating' => 4.2,
    'handelsgids_count'  => 1,

    // Add your Google review link here to show the
    // "Schrijf een review op Google" button below the reviews carousel.
    // Find it via: Google Maps → your business → "Get more reviews" → copy the link.
    // Leave null to hide the button completely.
    'review_write_url'   => 'https://www.google.com/search?sca_esv=c6c16ab1eb0a4421&sxsrf=ANbL-n5KcrFHiUw7Z8Yj9Ac48RlmFxqQkA:1781546024589&si=AL3DRZEsmMGCryMMFSHJ3StBhOdZ2-6yYkXd_doETEE1OR-qOQMiSdllpPRXTBQNZgxx9WhV-qnvtzBPndfKXHazp9pddayqz8TWddGzkxlX-_OpI7sutTQ3jd5boDBjzRft5sk2baKcVuNNPh3hmJ_vhZLE9YaezqwQlz5cWKuSFeX-PLunut0%3D&q=Algemene+Schrijnwerkerij+bvba+Van+Kerkhoven+Reviews&sa=X&ved=2ahUKEwiQ-MiP6ImVAxVqhv0HHZ49M5UQ0bkNegQIKBAF&cshid=1781546032294276&biw=1706&bih=1140&dpr=0.75',
    'review_write_label' => 'Schrijf een review op Google',

    /*
     * Reviews are manually configured. They are not automatically synced
     * from Google or any external platform.
     */
    'items' => [
        [
            'name'       => 'Annick Hendrickx',
            'rating'     => 5,
            'source'     => 'Google',
            'date_label' => 'een jaar geleden',
            'text'       => 'Prima werk geleverd, super kwaliteit, prijs zeker heel goed in functie van het kwalitatief materiaal. Hele goede communicatie.',
        ],
        [
            'name'       => 'Helena Demuynck',
            'rating'     => 5,
            'source'     => 'Google',
            'date_label' => 'een jaar geleden',
            'text'       => 'Wij hebben voor ons jaren 30 huis opnieuw houten ramen en een achterdeur laten maken in die authentieke stijl. Fijne samenwerking gehad, goede communicatie.',
        ],
        [
            'name'       => 'myr ver',
            'rating'     => 5,
            'source'     => 'Google',
            'date_label' => '6 maanden geleden',
            'text'       => 'Je merkt echt het verschil als mensen hun vak kennen en er van houden. Dank u!',
        ],
        [
            'name'       => 'Frederic Bossaert',
            'rating'     => 5,
            'source'     => 'Google',
            'date_label' => '7 jaar geleden',
            'text'       => 'Super klant vriendelijk, goede communicatie, uitstekende materialen tegen een correcte prijs.',
        ],
        [
            'name'       => 'Jos Si',
            'rating'     => 5,
            'source'     => 'Google',
            'date_label' => '7 jaar geleden',
            'text'       => 'Hebben heel goed werk geleverd.',
        ],
        [
            'name'       => 'Marie-Claude Borre',
            'rating'     => 5,
            'source'     => 'Google',
            'date_label' => '2 jaar geleden',
            'text'       => 'Voici une entreprise à taille humaine, soucieuse de l\'esthétique, du détail, passionnée par son métier et qui pratique des prix honnêtes.',
        ],
        [
            'name'       => 'maciej majlowski',
            'rating'     => 4,
            'source'     => 'Google',
            'date_label' => '6 jaar geleden',
            'text'       => null,
        ],
    ],
];

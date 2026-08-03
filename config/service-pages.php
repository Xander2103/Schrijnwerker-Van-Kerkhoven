<?php

/*
|--------------------------------------------------------------------------
| Dienstenpagina's
|--------------------------------------------------------------------------
|
| `core`  — de bestaande hoofddienstenpagina's uit routes/web.php, met hun
|           slug per taal. Eén bron van waarheid voor elke pagina die ernaar
|           linkt (regiopagina's, dienstenpagina's, "meer maatwerk"-blokken).
|
| `items` — de verdiepende dienstenpagina's. Structurele gegevens alleen;
|           alle tekst staat in lang/{locale}/service-pages.php.
|
| Een dienst toevoegen of verwijderen gebeurt hier: route-constraint, sitemap,
| interne links en breadcrumbs worden allemaal uit deze lijst opgebouwd.
|
*/

return [

    /*
     * Bestaande hoofdpagina's. `slugs` volgt exact routes/web.php.
     */
    'core' => [
        ['key' => 'ramen',       'slugs' => ['nl' => 'ramen',       'fr' => 'ramen',       'en' => 'ramen']],
        ['key' => 'deuren',      'slugs' => ['nl' => 'deuren',      'fr' => 'deuren',      'en' => 'deuren']],
        ['key' => 'trappen',     'slugs' => ['nl' => 'trappen',     'fr' => 'trappen',     'en' => 'trappen']],
        ['key' => 'poorten',     'slugs' => ['nl' => 'poorten',     'fr' => 'portails',    'en' => 'gates']],
        ['key' => 'schuiframen', 'slugs' => ['nl' => 'schuiframen', 'fr' => 'coulissants', 'en' => 'sliding-windows']],
        ['key' => 'werkplaats',  'slugs' => ['nl' => 'werkplaats',  'fr' => 'werkplaats',  'en' => 'werkplaats']],
    ],

    /*
     * Verdiepende dienstenpagina's.
     *
     * parent   — sleutel uit `core`; bepaalt de breadcrumb-hiërarchie en de
     *            secundaire hero-CTA. `null` = tweeledige breadcrumb, want er
     *            bestaat geen echte tussenpagina.
     * related  — sleutels uit `core` én uit `items`, in de volgorde waarin ze
     *            onderaan de pagina getoond worden.
     * gallery  — map onder public/assets/client/images, of `null` wanneer er
     *            geen eerlijk passend fotomateriaal bestaat. Dan wordt de
     *            realisatiesectie gewoon niet getoond.
     */
    'items' => [

        'binnendeuren' => [
            'slugs'   => [
                'nl' => 'binnendeuren',
                'fr' => 'portes-interieures',
                'en' => 'interior-doors',
            ],
            'hero'           => 'assets/client/images/hero1.webp',
            'parent'         => 'deuren',
            'related'        => ['deuren', 'maatkasten', 'trappen', 'werkplaats'],
            'gallery'        => 'deuren',
            'gallery_offset' => 6,
        ],

        'buitendeuren' => [
            'slugs'   => [
                'nl' => 'buitendeuren',
                'fr' => 'portes-exterieures',
                'en' => 'exterior-doors',
            ],
            'hero'           => 'assets/client/images/deuren/hero-deuren.webp',
            'parent'         => 'deuren',
            'related'        => ['deuren', 'binnendeuren', 'houten-ramen', 'garagepoorten'],
            'gallery'        => 'deuren',
            'gallery_offset' => 0,
        ],

        'houten-ramen' => [
            'slugs'   => [
                'nl' => 'houten-ramen',
                'fr' => 'fenetres-en-bois',
                'en' => 'wooden-windows',
            ],
            'hero'           => 'assets/client/images/ramen/hero-ramen.webp',
            'parent'         => 'ramen',
            'related'        => ['ramen', 'aluminium-ramen', 'schuiframen', 'buitendeuren'],
            'gallery'        => 'ramen',
            'gallery_offset' => 0,
        ],

        'aluminium-ramen' => [
            'slugs'   => [
                'nl' => 'aluminium-ramen',
                'fr' => 'fenetres-en-aluminium',
                'en' => 'aluminium-windows',
            ],
            // Geen aluminiumfoto in het beeldarchief — bewust een neutraal
            // gevelbeeld, geen houten raam dat als aluminium zou lezen.
            'hero'           => 'assets/client/images/historisch/historisch-werk.webp',
            'parent'         => 'ramen',
            'related'        => ['ramen', 'schuiframen', 'gevelbekleding', 'houten-ramen'],
            'gallery'        => null,
            'gallery_offset' => 0,
        ],

        'garagepoorten' => [
            'slugs'   => [
                'nl' => 'garagepoorten',
                'fr' => 'portes-de-garage',
                'en' => 'garage-doors',
            ],
            'hero'           => 'assets/client/images/poorten/hero-poorten.webp',
            'parent'         => 'poorten',
            'related'        => ['poorten', 'buitendeuren', 'gevelbekleding', 'werkplaats'],
            'gallery'        => 'poorten',
            'gallery_offset' => 0,
        ],

        'maatkasten' => [
            'slugs'   => [
                'nl' => 'maatkasten',
                'fr' => 'armoires-sur-mesure',
                'en' => 'custom-cabinets',
            ],
            'hero'           => 'assets/client/images/massieifhout.webp',
            'parent'         => null,
            'related'        => ['werkplaats', 'binnendeuren', 'trappen'],
            'gallery'        => null,
            'gallery_offset' => 0,
        ],

        'gevelbekleding' => [
            'slugs'   => [
                'nl' => 'gevelbekleding',
                'fr' => 'bardage-de-facade',
                'en' => 'facade-cladding',
            ],
            'hero'           => 'assets/client/images/hero.webp',
            'parent'         => null,
            'related'        => ['ramen', 'buitendeuren', 'garagepoorten', 'werkplaats'],
            'gallery'        => null,
            'gallery_offset' => 0,
        ],

    ],

    /*
     * Welke verdiepende diensten onderaan welke bestaande hoofdpagina worden
     * getoond. Zo blijft elke nieuwe pagina bereikbaar vanaf een bestaande
     * publieke pagina, zonder het hoofdmenu te vergroten.
     */
    'on_core_pages' => [
        'ramen'       => ['houten-ramen', 'aluminium-ramen'],
        'deuren'      => ['binnendeuren', 'buitendeuren'],
        'poorten'     => ['garagepoorten'],
        'werkplaats'  => ['maatkasten', 'gevelbekleding'],
        // Schuiframen gaan over dezelfde materiaalkeuze als de raampagina's;
        // wie op trappen zit, zoekt vaak ook ander binnenschrijnwerk.
        'schuiframen' => ['houten-ramen', 'aluminium-ramen'],
        'trappen'     => ['maatkasten'],
    ],

    // Aantal realisatiefoto's op een dienstenpagina.
    'gallery_limit' => 6,

];

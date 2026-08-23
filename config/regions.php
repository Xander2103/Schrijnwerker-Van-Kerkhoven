<?php

/*
|--------------------------------------------------------------------------
| Lokale regiopagina's
|--------------------------------------------------------------------------
|
| Structurele gegevens per regio — slug per taal, hero-afbeelding en de map
| die GalleryScanner gebruikt voor de realisatiefoto's. Alle tekst staat in
| lang/{locale}/regions.php; hier staat alleen wat taalonafhankelijk is.
|
| De routeconstraint, de sitemap en de regiolinks in de footer worden allemaal
| uit deze lijst opgebouwd — een regio toevoegen gebeurt dus op één plek.
|
*/

return [

    /*
     * Volgorde bepaalt de volgorde in de sitemap en in de "Andere gemeenten"-
     * sectie. `slugs` moet voor elke ondersteunde locale een sleutel hebben.
     */
    'items' => [

        'huldenberg' => [
            'name'    => 'Huldenberg',
            'slugs'   => [
                'nl' => 'schrijnwerker-huldenberg',
                'fr' => 'menuisier-huldenberg',
                'en' => 'carpenter-huldenberg',
            ],
            'hero'    => 'assets/client/images/hero.webp',
            'gallery'         => 'ramen',
            'gallery_service' => 'ramen',
        ],

        'overijse' => [
            'name'    => 'Overijse',
            'slugs'   => [
                'nl' => 'schrijnwerker-overijse',
                'fr' => 'menuisier-overijse',
                'en' => 'carpenter-overijse',
            ],
            'hero'    => 'assets/client/images/ramen/hero-ramen.webp',
            'gallery'         => 'ramen',
            'gallery_service' => 'ramen',
        ],

        'hoeilaart' => [
            'name'    => 'Hoeilaart',
            'slugs'   => [
                'nl' => 'schrijnwerker-hoeilaart',
                'fr' => 'menuisier-hoeilaart',
                'en' => 'carpenter-hoeilaart',
            ],
            'hero'    => 'assets/client/images/schuiframen/hero-schuiframen.webp',
            'gallery'         => 'schuiframen',
            'gallery_service' => 'schuiframen',
        ],

        'tervuren' => [
            'name'    => 'Tervuren',
            'slugs'   => [
                'nl' => 'schrijnwerker-tervuren',
                'fr' => 'menuisier-tervuren',
                'en' => 'carpenter-tervuren',
            ],
            'hero'    => 'assets/client/images/deuren/hero-deuren.webp',
            'gallery'         => 'deuren',
            'gallery_service' => 'deuren',
        ],

        'bertem' => [
            'name'    => 'Bertem',
            'slugs'   => [
                'nl' => 'schrijnwerker-bertem',
                'fr' => 'menuisier-bertem',
                'en' => 'carpenter-bertem',
            ],
            'hero'    => 'assets/client/images/poorten/hero-poorten.webp',
            'gallery'         => 'poorten',
            'gallery_service' => 'poorten',
        ],

        'leuven' => [
            'name'    => 'Leuven',
            'slugs'   => [
                'nl' => 'schrijnwerker-leuven',
                'fr' => 'menuisier-leuven',
                'en' => 'carpenter-leuven',
            ],
            'hero'    => 'assets/client/images/trappen-hero.webp',
            'gallery'         => 'trap',
            'gallery_service' => 'trappen',
        ],

    ],

    /*
     * De dienstenpagina's waar elke regiopagina naar linkt, staan in
     * config/service-pages.php onder `core` — één bron voor alle pagina's
     * die naar de hoofddiensten verwijzen.
     */

    // Aantal realisatiefoto's dat op een regiopagina getoond wordt.
    'gallery_limit' => 6,

];

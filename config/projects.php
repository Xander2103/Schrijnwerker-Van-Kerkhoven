<?php

/*
|--------------------------------------------------------------------------
| Realisaties (projectpagina's)
|--------------------------------------------------------------------------
|
| Zie docs/projects.md voor de volledige handleiding.
|
| Alleen `status => 'published'` levert een publieke route, een sitemapregel
| en interne links op. Alles wat op `draft` staat, bestaat niet voor de
| buitenwereld — geen route, geen sitemap, geen link, geen indexering.
|
| PUBLICATIECRITERIA (worden afgedwongen door tests/Feature/ProjectPagesTest):
|   - bevestigde dienst (`service`)
|   - minstens 3 foto's die aantoonbaar bij hetzelfde project horen
|   - bestaande hero
|   - vertaalde titel, intro, uitdaging, aanpak en resultaat in nl/fr/en
|
| `region` mag alleen ingevuld worden wanneer de gemeente bevestigd is door de
| klant. Niet invullen betekent: geen gemeente in de tekst, geen gemeente in de
| metadata en geen koppeling aan een regiopagina.
|
| `evidence` en `missing` zijn interne velden. Ze worden nergens gerenderd en
| documenteren waarom een project wel of niet gepubliceerd kan worden.
|
*/

return [

    /*
     * Slug van de realisatie-index per taal. Ook het eerste padsegment van
     * elke projectpagina: /nl/realisaties/{project}.
     */
    'index_slugs' => [
        'nl' => 'realisaties',
        'fr' => 'realisations',
        'en' => 'projects',
    ],

    // Maximum aantal gerelateerde projecten onderaan een projectpagina.
    'related_limit' => 3,

    // Vanaf hoeveel gepubliceerde projecten de index gepagineerd wordt.
    'per_page' => 12,

    'items' => [

        /*
         * ── Herenhuis: houten ramen met boogbovenlicht ───────────────────
         *
         * Het enige fotogroepje in het archief waarvan de samenhang hard te
         * maken is. Op de drie interieurfoto's is dezelfde overburen-gevel
         * zichtbaar (wit pleisterwerk, geelgeschilderde raamomlijstingen, een
         * smeedijzeren balkonhek), plus dezelfde radiatorkasten en dezelfde
         * eiken vloer. De werkhuisfoto toont hetzelfde raamtype vóór plaatsing
         * (zelfde boogbovenlicht, zelfde roedeverdeling, zelfde witte
         * afwerking, glasstickers er nog op).
         *
         * Blijft draft: het fotomateriaal toont wát er staat, maar nergens in
         * het project staat waaróm het werk gebeurde, in welke gemeente, in
         * welk jaar of in welke houtsoort. Die tekst moet van de klant komen.
         */
        'herenhuis-boogramen' => [
            'status'  => 'draft',
            'slugs'   => [
                'nl' => 'houten-boogramen-herenhuis',
                'fr' => 'fenetres-cintrees-maison-de-maitre',
                'en' => 'arched-wooden-windows-townhouse',
            ],
            'service'          => 'ramen',
            'subservice'       => 'houten-ramen',
            'region'           => null,   // geen gemeente bevestigd
            'year'             => null,   // geen jaar bevestigd
            'materials'        => [],     // houtsoort niet bevestigd
            'work_type'        => null,   // renovatie/nieuwbouw niet bevestigd
            'hero'             => 'assets/client/images/ramen/WhatsApp Image 2026-07-16 at 20.59.28 (1).webp',
            'gallery'          => [
                'assets/client/images/ramen/WhatsApp Image 2026-07-16 at 20.59.28 (1).webp',
                'assets/client/images/ramen/WhatsApp Image 2026-07-16 at 20.59.28 (2).webp',
                'assets/client/images/ramen/WhatsApp Image 2026-07-16 at 20.59.28 (3).webp',
                'assets/client/images/ramen/WhatsApp Image 2026-07-16 at 20.59.28 (5).webp',
            ],
            'related_projects' => [],
            'evidence'         => 'Foto 1-3: identiek pand — dezelfde overburen-gevel, radiatorkasten en vloer. Foto 4: hetzelfde raamtype in het werkhuis, vóór plaatsing.',
            'missing'          => [
                'Uitgangssituatie: wat stond er voordien en waarom werd vervangen?',
                'Aanpak: welke keuzes zijn gemaakt in profiel, roedeverdeling en afwerking?',
                'Resultaat: wat was het eindresultaat volgens de klant?',
                'Gemeente (alleen invullen indien bevestigd)',
                'Uitvoeringsjaar (alleen invullen indien bevestigd)',
                'Houtsoort en afwerking (alleen invullen indien bevestigd)',
                'Renovatie of nieuwbouw',
            ],
        ],

        /*
         * ── Houten garagepoort in bakstenen gevel ────────────────────────
         *
         * Eén duidelijke, afgewerkte poort in een bakstenen gevel met betonnen
         * latei. Er is maar één foto van dit pand: de foto één seconde eerder
         * in dezelfde map toont aantoonbaar een ánder gebouw (rode baksteen,
         * pannendak, zijdeur ernaast), dus die hoort er niet bij.
         *
         * Blijft draft: onder de drempel van drie foto's.
         */
        'houten-garagepoort' => [
            'status'  => 'draft',
            'slugs'   => [
                'nl' => 'houten-garagepoort-bakstenen-gevel',
                'fr' => 'porte-de-garage-en-bois-facade-en-briques',
                'en' => 'wooden-garage-door-brick-facade',
            ],
            'service'          => 'poorten',
            'subservice'       => 'garagepoorten',
            'region'           => null,
            'year'             => null,
            'materials'        => [],
            'work_type'        => null,
            'hero'             => 'assets/client/images/poorten/WhatsApp Image 2026-06-16 at 19.43.32.webp',
            'gallery'          => [
                'assets/client/images/poorten/WhatsApp Image 2026-06-16 at 19.43.32.webp',
            ],
            'related_projects' => [],
            'evidence'         => 'Eén foto van een afgewerkte dubbele houten poort in een bakstenen gevel.',
            'missing'          => [
                'Minstens twee extra foto\'s van hetzelfde pand (detail, voordien, of vanuit een andere hoek)',
                'Uitgangssituatie, aanpak en resultaat',
                'Gemeente, jaar, houtsoort en afwerking (alleen indien bevestigd)',
            ],
        ],

        /*
         * ── Gevel met klimop: ramen en voordeur ──────────────────────────
         *
         * Eén gevelfoto van een bakstenen woning met klimop, met nieuw houten
         * buitenschrijnwerk: gebogen ramen boven, een breed raam beneden en een
         * houten voordeur met bovenlicht. Duidelijk één pand, maar één beeld.
         *
         * Blijft draft: onder de drempel van drie foto's.
         */
        'klimopgevel-buitenschrijnwerk' => [
            'status'  => 'draft',
            'slugs'   => [
                'nl' => 'buitenschrijnwerk-klimopgevel',
                'fr' => 'menuiseries-exterieures-facade-au-lierre',
                'en' => 'exterior-joinery-ivy-facade',
            ],
            'service'          => 'ramen',
            'subservice'       => 'houten-ramen',
            'region'           => null,
            'year'             => null,
            'materials'        => [],
            'work_type'        => null,
            'hero'             => 'assets/client/images/ramen/WhatsApp Image 2026-07-16 at 22.27.10.webp',
            'gallery'          => [
                'assets/client/images/ramen/WhatsApp Image 2026-07-16 at 22.27.10.webp',
            ],
            'related_projects' => [],
            'evidence'         => 'Eén gevelfoto met nieuw houten buitenschrijnwerk: ramen en voordeur op hetzelfde pand.',
            'missing' => [
                'Minstens twee extra foto\'s van hetzelfde pand',
                'Uitgangssituatie, aanpak en resultaat',
                'Gemeente, jaar, houtsoort en afwerking (alleen indien bevestigd)',
            ],
        ],

    ],

];

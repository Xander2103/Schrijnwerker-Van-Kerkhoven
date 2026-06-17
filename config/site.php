<?php

return [
    'name'          => 'Algemene Schrijnwerkerij bv Van Kerkhoven',
    'nav_brand'     => 'Van Kerkhoven',
    'tagline'       => 'Schrijnwerk op maat, van boom tot plaatsing.',
    'intro_short'   => 'Houten ramen, deuren en trappen uit eigen werkhuis. Al 45 jaar vakmanschap, met persoonlijke begeleiding van ontwerp tot plaatsing.',
    'intro_long'    => 'Van Kerkhoven combineert 45 jaar expertise met een persoonlijke aanpak. Elk project wordt zorgvuldig voorbereid, geproduceerd in eigen werkhuis en geplaatst door onze eigen plaatsingsdienst. Daardoor houden we controle over het volledige traject: van houtkeuze en ontwerp tot afwerking en plaatsing. We werken voor particulieren, renovaties en projecten in samenwerking met architecten.',
    'business_type' => 'schrijnwerkerij',

    'welcome_heading' => 'Welkom bij Van Kerkhoven',
    'welcome_text'    => 'Bij Van Kerkhoven staat elk project in het teken van vakmanschap, duidelijke communicatie en maatwerk. Vanuit ons eigen werkhuis realiseren we houten ramen, deuren en trappen in massief hout, met aandacht voor stijl, afwerking en duurzaamheid. We begeleiden klanten, architecten en renovatieprojecten van de eerste bespreking tot de plaatsing.',

    'services_intro' => 'Vakwerk in hout voor elk project — van ramen en deuren tot trappen, maatwerk en renovatie.',
    'trust_intro'    => 'Kwaliteit begint bij eerlijk vakmanschap en een vertrouwde aanpak van begin tot oplevering.',

    'nav_items' => [
        ['label' => 'Ramen',       'href' => '/ramen'],
        ['label' => 'Deuren',      'href' => '/deuren'],
        ['label' => 'Trappen',     'href' => '/trappen'],
        ['label' => 'Onze werkplaats', 'href' => '/werkplaats'],
        ['label' => 'Ons bedrijf', 'href' => '/#bedrijf'],
        ['label' => 'Reviews',     'href' => '/#reviews'],
        ['label' => 'Contact',     'href' => '/contact'],
    ],

    'footer_text'   => '© ' . date('Y') . ' Algemene Schrijnwerkerij bv Van Kerkhoven · Hoekstraat 15–19B · 3040 Huldenberg · BTW BE 0700.781.844',
    'whatsapp_url'  => null,
    'cta_primary'   => 'Neem contact op',
    'cta_secondary' => 'Bekijk ons werk',

    'address'     => 'Hoekstraat 15–19B',
    'city'        => '3040 Huldenberg',
    'postal_code' => '3040',
    'city_name'   => 'Huldenberg',
    'region'      => 'Vlaams-Brabant',
    'vat'         => 'BE 0700.781.844',

    // Works by appointment — no opening hours table
    'opening_hours'       => null,
    'appointment_message' => 'Wij werken op afspraak.',

    'maps_link'      => 'https://maps.app.goo.gl/VanKerkhoven',
    'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2522.152928020906!2d4.631281877483352!3d50.79127437165934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c163f3d0529261%3A0x83e6e67c847daeca!2sAlgemene%20Schrijnwerkerij%20bvba%20Van%20Kerkhoven!5e0!3m2!1snl!2sbe!4v1780849021987!5m2!1snl!2sbe',

    'trust_points' => [
        '45 jaar expertise in massief hout',
        'Eigen werkhuis en eigen plaatsingsdienst',
        'Volledige begeleiding van ontwerp tot plaatsing',
        'Samenwerking met particulieren en architecten',
        'Maatwerk in elke stijl, afwerking en houtsoort',
        'Eerlijke communicatie en kwaliteitsafwerking',
    ],

    // Removed: external_quote_url (Vergelijk gratis offertes block removed per client feedback)

    'sections' => [
        'hero'        => true,
        'bedrijf'     => true,
        'trust'       => false,
        'wood_teaser' => true,  // Geschreven in hout — moved above reviews
        'reviews'     => true,
        'gallery'     => false,
        'atelier'     => false, // merged into bedrijf section
        'historisch'  => true,
        'contact_cta' => true,  // NEW: simple CTA linking to /contact
        'contact'     => false, // Contact moved to dedicated /contact page
        'location'    => true,
    ],
];

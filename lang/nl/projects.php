<?php

/*
 * Realisaties. `common` bevat de gedeelde labels; onder `items` staat de
 * projecttekst per projectsleutel uit config/projects.php.
 *
 * Een draftproject hoeft hier nog geen `items`-blok te hebben. Een project op
 * `published` wél — de tests eisen titel, intro, hero_alt, uitdaging, aanpak
 * en resultaat in alle drie de talen.
 */

return [

    'common' => [
        'eyebrow'         => 'Realisatie',
        'breadcrumb_aria' => 'Kruimelpad',
        'breadcrumb_home' => 'Home',
        'breadcrumb_index' => 'Realisaties',

        // Index
        'index_meta_title'       => 'Realisaties — uitgevoerd schrijnwerk | Van Kerkhoven',
        'index_meta_description' => 'Een selectie van uitgevoerde projecten van Van Kerkhoven: houten ramen, deuren, trappen en poorten op maat, gemaakt in eigen werkhuis.',
        'index_heading'          => 'Realisaties',
        'index_intro'            => 'Een selectie van projecten die we van opmeting tot plaatsing hebben uitgevoerd.',

        'index_empty_heading' => 'Nog geen uitgewerkte projecten online',
        'index_empty_text'    => 'We zijn de projectpagina\'s aan het samenstellen. Ondertussen vindt u foto\'s van ons werk op de pagina\'s per dienst en in onze werkplaats.',
        'index_empty_cta'     => 'Bekijk onze werkplaats',

        'pagination_aria' => 'Paginering realisaties',
        'pagination_prev' => 'Vorige',
        'pagination_next' => 'Volgende',
        'pagination_page' => 'Pagina :page van :total',

        // Projectpagina
        'overview_heading'  => 'Projectgegevens',
        'label_service'     => 'Dienst',
        'label_subservice'  => 'Specialisatie',
        'label_region'      => 'Gemeente',
        'label_year'        => 'Uitgevoerd',
        'label_materials'   => 'Materiaal',
        'label_work_type'   => 'Type werk',
        'work_type_renovation' => 'Renovatie',
        'work_type_new_build'  => 'Nieuwbouw',

        'challenge_heading' => 'Uitgangssituatie',
        'approach_heading'  => 'Aanpak',
        'execution_heading' => 'Uitvoering',
        'result_heading'    => 'Resultaat',
        'gallery_heading'   => 'Foto\'s van dit project',
        'faq_heading'       => 'Veelgestelde vragen',

        'services_heading' => 'Diensten bij dit project',
        'related_heading'  => 'Andere realisaties',
        'back_to_index'    => 'Alle realisaties',

        'cta_contact'  => 'Neem contact op',
        'cta_heading'  => 'Iets gelijkaardigs in gedachten?',
        'cta_text'     => 'Elk project vertrekt van een eigen situatie en eigen maten. Beschrijf kort wat u voor ogen hebt, dan bekijken we samen wat er mogelijk is.',

        // Compacte sectie op dienst- en regiopagina's
        'section_heading'  => 'Gerelateerde realisaties',
        'section_link'     => 'Bekijk dit project',
        'section_more'     => 'Alle realisaties',
    ],

    /*
     * Per project:
     *   title, intro, hero_alt, meta_title, meta_description,
     *   challenge[], approach[], execution[] (optioneel), result[],
     *   highlights[] (optioneel), gallery_alts[] (optioneel), faq[] (optioneel)
     *
     * Zolang er geen project op `published` staat, blijft dit leeg.
     */
    'items' => [],

];

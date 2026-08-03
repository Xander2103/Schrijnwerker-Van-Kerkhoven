<?php

/*
 * Réalisations. `common` contient les libellés partagés ; sous `items` se
 * trouve le texte de chaque projet, par clé de config/projects.php.
 *
 * Un projet en `draft` n'a pas encore besoin de bloc `items`. Un projet
 * `published` en a besoin — les tests exigent titre, intro, hero_alt, situation
 * de départ, approche et résultat dans les trois langues.
 */

return [

    'common' => [
        'eyebrow'          => 'Réalisation',
        'breadcrumb_aria'  => 'Fil d\'Ariane',
        'breadcrumb_home'  => 'Accueil',
        'breadcrumb_index' => 'Réalisations',

        // Index
        'index_meta_title'       => 'Réalisations — menuiseries exécutées | Van Kerkhoven',
        'index_meta_description' => 'Une sélection de projets réalisés par Van Kerkhoven : fenêtres, portes, escaliers et portails en bois sur mesure, fabriqués dans notre atelier.',
        'index_heading'          => 'Réalisations',
        'index_intro'            => 'Une sélection de projets que nous avons menés du relevé jusqu\'à la pose.',

        'index_empty_heading' => 'Pas encore de projets détaillés en ligne',
        'index_empty_text'    => 'Nous sommes en train de constituer les pages de projets. En attendant, vous trouverez des photos de notre travail sur les pages par service et dans notre atelier.',
        'index_empty_cta'     => 'Voir notre atelier',

        'pagination_aria' => 'Pagination des réalisations',
        'pagination_prev' => 'Précédent',
        'pagination_next' => 'Suivant',
        'pagination_page' => 'Page :page sur :total',

        // Page projet
        'overview_heading' => 'Fiche du projet',
        'label_service'    => 'Service',
        'label_subservice' => 'Spécialité',
        'label_region'     => 'Commune',
        'label_year'       => 'Réalisé en',
        'label_materials'  => 'Matériau',
        'label_work_type'  => 'Type de chantier',
        'work_type_renovation' => 'Rénovation',
        'work_type_new_build'  => 'Construction neuve',

        'challenge_heading' => 'Situation de départ',
        'approach_heading'  => 'Approche',
        'execution_heading' => 'Exécution',
        'result_heading'    => 'Résultat',
        'gallery_heading'   => 'Photos de ce projet',
        'faq_heading'       => 'Questions fréquentes',

        'services_heading' => 'Services liés à ce projet',
        'related_heading'  => 'Autres réalisations',
        'back_to_index'    => 'Toutes les réalisations',

        'cta_contact' => 'Nous contacter',
        'cta_heading' => 'Un projet similaire en tête ?',
        'cta_text'    => 'Chaque chantier part d\'une situation et de cotes qui lui sont propres. Décrivez brièvement ce que vous envisagez, nous examinerons ensemble ce qui est possible.',

        // Section compacte sur les pages de service et de région
        'section_heading' => 'Réalisations liées',
        'section_link'    => 'Voir ce projet',
        'section_more'    => 'Toutes les réalisations',
    ],

    'items' => [],

];

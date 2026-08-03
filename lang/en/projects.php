<?php

/*
 * Projects. `common` holds the shared labels; `items` holds the per-project
 * copy, keyed the same way as config/projects.php.
 *
 * A draft project does not need an `items` block yet. A published one does —
 * the tests require title, intro, hero_alt, challenge, approach and result in
 * all three languages.
 */

return [

    'common' => [
        'eyebrow'          => 'Project',
        'breadcrumb_aria'  => 'Breadcrumb',
        'breadcrumb_home'  => 'Home',
        'breadcrumb_index' => 'Projects',

        // Index
        'index_meta_title'       => 'Projects — joinery we have carried out | Van Kerkhoven',
        'index_meta_description' => 'A selection of projects carried out by Van Kerkhoven: wooden windows, doors, staircases and gates made to measure in our own workshop.',
        'index_heading'          => 'Projects',
        'index_intro'            => 'A selection of projects we carried out from measuring through to installation.',

        'index_empty_heading' => 'No detailed projects online yet',
        'index_empty_text'    => 'We are putting the project pages together. In the meantime you will find photos of our work on the service pages and in our workshop.',
        'index_empty_cta'     => 'See our workshop',

        'pagination_aria' => 'Project pagination',
        'pagination_prev' => 'Previous',
        'pagination_next' => 'Next',
        'pagination_page' => 'Page :page of :total',

        // Project page
        'overview_heading' => 'Project details',
        'label_service'    => 'Service',
        'label_subservice' => 'Speciality',
        'label_region'     => 'Municipality',
        'label_year'       => 'Carried out',
        'label_materials'  => 'Material',
        'label_work_type'  => 'Type of work',
        'work_type_renovation' => 'Renovation',
        'work_type_new_build'  => 'New build',

        'challenge_heading' => 'Starting point',
        'approach_heading'  => 'Approach',
        'execution_heading' => 'Execution',
        'result_heading'    => 'Result',
        'gallery_heading'   => 'Photos of this project',
        'faq_heading'       => 'Frequently asked questions',

        'services_heading' => 'Services involved',
        'related_heading'  => 'Other projects',
        'back_to_index'    => 'All projects',

        'cta_contact' => 'Get in touch',
        'cta_heading' => 'Something similar in mind?',
        'cta_text'    => 'Every job starts from its own situation and its own dimensions. Describe briefly what you have in mind and we will look at what is possible.',

        // Compact section on service and region pages
        'section_heading' => 'Related projects',
        'section_link'    => 'View this project',
        'section_more'    => 'All projects',
    ],

    'items' => [],

];

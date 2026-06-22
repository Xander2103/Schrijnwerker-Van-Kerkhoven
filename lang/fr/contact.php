<?php

return [
    // Section headings
    'eyebrow' => 'Contact',
    'heading' => 'Nous vous aidons volontiers',
    'intro'   => 'De la première question à la livraison — nous guidons chaque projet personnellement.',

    // Contact card
    'appointment' => 'Nous travaillons sur rendez-vous.',
    'label_appt'  => 'Rendez-vous',

    // Form labels
    'name_label'      => 'Nom',
    'phone_label'     => 'Numéro de téléphone',
    'email_label'     => 'Adresse e-mail',
    'email_optional'  => '(optionnel)',
    'type_label'      => 'Type de demande',
    'message_label'   => 'Message',
    'required_suffix' => '*',

    // Form placeholders
    'name_placeholder'  => 'Votre nom',
    'phone_placeholder' => 'Votre numéro de téléphone',
    'email_placeholder' => 'votre@email.be',
    'type_placeholder'  => 'Choisir une option',
    'msg_placeholder'   => 'Décrivez votre demande...',

    // Privacy
    'privacy_text' => 'J\'accepte que mes données soient utilisées pour répondre à ma demande.',
    'privacy_more' => 'Plus d\'info',

    // Submit
    'submit' => 'Envoyer la demande',

    // Request type labels
    'request_types' => [
        'buitenschrijnwerk' => 'Menuiserie extérieure',
        'ramen_op_maat'     => 'Fenêtres sur mesure',
        'trappen_op_maat'   => 'Escaliers sur mesure',
        'maatwerk'          => 'Travail sur mesure',
        'poorten'           => 'Portes et portails',
        'andere_vraag'      => 'Autre demande',
    ],

    // Validation messages
    'validation' => [
        'name_required'    => 'Veuillez indiquer votre nom.',
        'phone_required'   => 'Veuillez indiquer votre numéro de téléphone.',
        'email_invalid'    => 'Veuillez indiquer une adresse e-mail valide.',
        'type_required'    => 'Veuillez choisir un type de demande.',
        'type_invalid'     => 'Veuillez choisir un type de demande valide.',
        'message_required' => 'Veuillez indiquer un message.',
        'message_max'      => 'Votre message ne peut pas dépasser 2000 caractères.',
        'privacy_accepted' => 'Vous devez accepter la politique de confidentialité.',
    ],

    // Flash messages
    'success'    => 'Merci, votre demande a bien été reçue. Nous vous contacterons dans les plus brefs délais.',
    'rate_error' => 'Vous avez déjà envoyé le nombre maximum de messages aujourd\'hui. Réessayez demain ou appelez-nous directement au :phone.',

    // Email template labels (owner-facing)
    'email_subject'     => 'Nouvelle demande via le site web',
    'email_locale_name' => 'Français (FR)',
    'email_lbl_locale'  => 'Langue du formulaire',
    'email_lbl_name'    => 'Nom',
    'email_lbl_email'   => 'E-mail',
    'email_lbl_phone'   => 'Téléphone',
    'email_lbl_type'    => 'Type de demande',
    'email_lbl_message' => 'Message',
    'email_lbl_source'  => 'Reçu via',
    'email_lbl_consent' => 'Politique de confidentialité',
    'email_consent_yes' => 'Accepté le :datetime',
    'email_website'     => 'site web',
    'email_greeting'    => 'Une nouvelle demande a été reçue via le site web.',
];

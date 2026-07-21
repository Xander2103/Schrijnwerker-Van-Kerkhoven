<?php

return [
    // Section headings
    'eyebrow' => 'Contact',
    'heading' => 'Wij helpen u graag',
    'intro'   => 'Van eerste vraag tot oplevering — wij begeleiden elk project persoonlijk.',

    // Contact card
    'appointment' => 'Wij werken op afspraak.',
    'label_appt'  => 'Afspraken',

    // Form labels
    'name_label'       => 'Naam',
    'phone_label'      => 'Telefoonnummer',
    'phone_optional'   => '(optioneel)',
    'email_label'      => 'E-mailadres',
    'type_label'       => 'Type aanvraag',
    'message_label'    => 'Bericht',
    'required_suffix'  => '*',

    // Form placeholders
    'name_placeholder'  => 'Uw naam',
    'phone_placeholder' => 'Uw telefoonnummer',
    'email_placeholder' => 'uw@email.be',
    'type_placeholder'  => 'Kies een optie',
    'msg_placeholder'   => 'Beschrijf uw aanvraag...',

    // Privacy
    'privacy_text' => 'Ik ga akkoord dat mijn gegevens gebruikt worden om mijn aanvraag te beantwoorden.',
    'privacy_more' => 'Meer info',

    // Submit
    'submit'  => 'Verstuur aanvraag',
    'sending' => 'Bezig met verzenden...',

    // Request type labels (key = machine value stored in DB/mail)
    'request_types' => [
        'buitenschrijnwerk' => 'Buitenschrijnwerk',
        'ramen_op_maat'     => 'Ramen op maat',
        'trappen_op_maat'   => 'Trappen op maat',
        'maatwerk'          => 'Maatwerk',
        'poorten'           => 'Poorten',
        'andere_vraag'      => 'Andere vraag',
    ],

    // Validation messages
    'validation' => [
        'name_required'    => 'Vul uw naam in.',
        'email_required'   => 'Vul uw e-mailadres in.',
        'email_invalid'    => 'Vul een geldig e-mailadres in.',
        'phone_max'        => 'Uw telefoonnummer is te lang.',
        'type_required'    => 'Kies een type aanvraag.',
        'type_invalid'     => 'Kies een geldig type aanvraag.',
        'message_required' => 'Vul een bericht in.',
        'message_min'      => 'Uw bericht moet minstens :min tekens bevatten.',
        'message_max'      => 'Uw bericht mag maximaal 2000 tekens bevatten.',
        'privacy_accepted' => 'U moet akkoord gaan met het privacybeleid.',
    ],

    // Flash messages
    'success'    => 'Bedankt, uw aanvraag werd ontvangen. We nemen zo snel mogelijk contact op.',
    'send_error' => 'Er ging iets mis bij het versturen van uw aanvraag. Probeer het later opnieuw.',

    // Email template labels (owner-facing)
    'email_subject'     => 'Nieuwe aanvraag via de website',
    'email_locale_name' => 'Nederlands (NL)',
    'email_lbl_locale'  => 'Formuliertaal',
    'email_lbl_name'    => 'Naam',
    'email_lbl_email'   => 'E-mail',
    'email_lbl_phone'   => 'Telefoon',
    'email_lbl_type'    => 'Type aanvraag',
    'email_lbl_message' => 'Bericht',
    'email_lbl_source'  => 'Ontvangen via',
    'email_lbl_consent' => 'Privacyverklaring',
    'email_consent_yes' => 'Akkoord gegaan op :datetime',
    'email_website'     => 'website',
    'email_greeting'    => 'Er is een nieuwe aanvraag binnengekomen via de website.',
];

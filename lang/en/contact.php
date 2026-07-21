<?php

return [
    // Section headings
    'eyebrow' => 'Contact',
    'heading' => 'We\'re happy to help',
    'intro'   => 'From first question to delivery — we guide every project personally.',

    // Contact card
    'appointment' => 'We work by appointment.',
    'label_appt'  => 'Appointments',

    // Form labels
    'name_label'      => 'Name',
    'phone_label'     => 'Phone number',
    'phone_optional'  => '(optional)',
    'email_label'     => 'E-mail address',
    'type_label'      => 'Type of request',
    'message_label'   => 'Message',
    'required_suffix' => '*',

    // Form placeholders
    'name_placeholder'  => 'Your name',
    'phone_placeholder' => 'Your phone number',
    'email_placeholder' => 'your@email.com',
    'type_placeholder'  => 'Choose an option',
    'msg_placeholder'   => 'Describe your request...',

    // Privacy
    'privacy_text' => 'I agree that my data will be used to respond to my request.',
    'privacy_more' => 'More info',

    // Submit
    'submit'  => 'Submit request',
    'sending' => 'Sending...',

    // Request type labels
    'request_types' => [
        'buitenschrijnwerk' => 'Exterior joinery',
        'ramen_op_maat'     => 'Custom windows',
        'trappen_op_maat'   => 'Custom stairs',
        'maatwerk'          => 'Custom-made work',
        'poorten'           => 'Doors and gates',
        'andere_vraag'      => 'Other request',
    ],

    // Validation messages
    'validation' => [
        'name_required'    => 'Please enter your name.',
        'email_required'   => 'Please enter your e-mail address.',
        'email_invalid'    => 'Please enter a valid e-mail address.',
        'phone_max'        => 'Your phone number is too long.',
        'type_required'    => 'Please choose a type of request.',
        'type_invalid'     => 'Please choose a valid type of request.',
        'message_required' => 'Please enter a message.',
        'message_min'      => 'Your message must be at least :min characters.',
        'message_max'      => 'Your message may not exceed 2000 characters.',
        'privacy_accepted' => 'You must agree to the privacy policy.',
    ],

    // Flash messages
    'success'    => 'Thank you, your request has been received. We will get back to you as soon as possible. You will also receive a confirmation by e-mail.',
    'send_error' => 'Something went wrong while sending your request. Please try again later.',

    // Confirmation e-mail to the visitor
    'confirm_subject'       => 'We have received your request – Van Kerkhoven',
    'confirm_greeting'      => 'Dear :name,',
    'confirm_intro'         => 'Thank you for your request. We have received your message and will contact you as soon as possible.',
    'confirm_type_label'    => 'Type of request',
    'confirm_message_label' => 'Your message',
    'confirm_signoff'       => 'Kind regards,',
    'confirm_auto_notice'   => 'This is an automatically sent confirmation. Please do not reply to this e-mail.',

    // Email template labels (owner-facing)
    'email_subject'     => 'New enquiry via the website',
    'email_locale_name' => 'English (EN)',
    'email_lbl_locale'  => 'Form language',
    'email_lbl_name'    => 'Name',
    'email_lbl_email'   => 'E-mail',
    'email_lbl_phone'   => 'Phone',
    'email_lbl_type'    => 'Type of request',
    'email_lbl_message' => 'Message',
    'email_lbl_source'  => 'Received via',
    'email_lbl_consent' => 'Privacy policy',
    'email_consent_yes' => 'Agreed on :datetime',
    'email_website'     => 'website',
    'email_greeting'    => 'A new enquiry has been received via the website.',
];

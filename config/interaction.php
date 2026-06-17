<?php

return [
    // Client feedback: hammer cursor felt too playful — disabled site-wide.
    // Body never gets the 'custom-cursor-enabled' class, so the JS cursor
    // bootstrap no-ops and cursorhammer.png is never requested.
    'custom_cursor' => [
        'enabled' => false,
    ],

    'scroll_reveal' => [
        'enabled' => true,
    ],
];

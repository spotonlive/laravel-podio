<?php

return [
    // Authorization
    'clientId' => env('PODIO_CLIENT_ID', null),
    'clientSecret' => env('PODIO_CLIENT_SECRET', null),

    // Podio username / password (optional)
    'username' => env('PODIO_USERNAME', null),
    'password' => env('PODIO_PASSWORD', null),

    'options' => [
        // session_manager => '',
        // curl_options => '',
    ],

    // Apps
    'apps' => [
        [
            // Select an alias for your application
            'name' => '',

            // Application credentials
            'id' => '',
            'token' => '',
        ],
    ],
];

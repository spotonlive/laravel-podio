<?php

namespace SpotOnLive\LaravelPodio\Options;

class PodioOptions extends Options implements OptionsInterface
{
    /** @var array */
    protected $defaults = [
        // Authorization
        'clientId' => null,
        'clientSecret' => null,

        // Podio username / password (optional)
        'username' => null,
        'password' => null,

        'options' => [
            // session_manager => '',
            // curl_options => '',
        ],

        // Applications
        'apps' => [],
    ];
}

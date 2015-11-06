<?php

namespace SpotOnLive\LaravelPodio\Options;

class PodioOptions extends Options implements OptionsInterface
{
    /** @var array */
    protected $defaults = [
        // Authorization
        'clientId' => null,
        'clientSecret' => null,

        // Applications
        'apps' => [],
    ];
}

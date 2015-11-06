<?php

namespace SpotOnLive\LaravelPodio\Services;

use SpotOnLive\LaravelPodio\Options\PodioOptions;

class PodioService
{
    /** @var PodioOptions */
    protected $options;

    public function __construct(array $config)
    {
        $this->options = new PodioOptions($config);
    }

    /**
     * @return PodioOptions
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param PodioOptions $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }
}

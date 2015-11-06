<?php

namespace SpotOnLive\LaravelPodio\Providers\Services;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use SpotOnLive\LaravelPodio\Exception\ConfigurationException;
use SpotOnLive\LaravelPodio\Services\PodioService;

class PodioServiceProvider extends ServiceProvider
{
    /**
     * Register service
     */
    public function register()
    {
        $this->app->bind('SpotOnLive\LaravelPodio\Services\PodioService', function (Application $app) {
            /** @var array $config */
            $config = config('podio');

            if (!$config) {
                ConfigurationException::message('Please provide a podio configuration');
            }

            return new PodioService($config);
        });
    }
}

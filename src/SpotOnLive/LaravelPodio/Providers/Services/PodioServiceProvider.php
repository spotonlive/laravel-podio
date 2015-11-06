<?php

namespace SpotOnLive\LaravelPodio\Providers\Services;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;

class PodioServiceProvider extends ServiceProvider
{
    /**
     * Register service
     */
    public function register()
    {
        $this->app->bind('SpotOnLive\LaravelPodio\Services\PodioService', function (Application $app) {
            return new \SpotOnLive\LaravelPodio\Services\PodioService();
        });
    }
}

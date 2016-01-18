<?php

/**
 * Podio integration for Laravel 5.1
 *
 * @license MIT
 * @package SpotOnLive\LaravelPodio
 */

namespace SpotOnLive\LaravelPodio;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use SpotOnLive\LaravelPodio\Exception\ConfigurationException;
use SpotOnLive\LaravelPodio\Services\PodioService;

class LaravelPodioProvider extends ServiceProvider
{
    /**
     * Publish config
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('podio.php'),
        ]);

        // Require podio api
        require_once(__DIR__ . '/../../../../../podio/podio-php/PodioAPI.php');
    }

    /**
     * Register package
     */
    public function register()
    {
        $this->mergeConfig();
        $this->registerServices();
    }

    /**
     * Merge config
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php',
            'podio'
        );
    }

    /**
     * Register services
     */
    protected function registerServices()
    {
        // PodioService
        $this->app->bind(PodioService::class, function (Application $app) {
            /** @var array $config */
            $config = config('podio');

            if (!$config) {
                ConfigurationException::message('Please provide a podio configuration');
            }

            return new PodioService($config);
        });
    }
}

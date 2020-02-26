<?php

/**
 * Podio integration for Laravel 5.1
 *
 * @license MIT
 * @package SpotOnLive\LaravelPodio
 */

namespace Repasse\LaravelPodio;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use Repasse\LaravelPodio\Exceptions\ConfigurationException;
use Repasse\LaravelPodio\Services\PodioService;

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

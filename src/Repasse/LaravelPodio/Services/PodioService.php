<?php

namespace Repasse\LaravelPodio\Services;

use Podio;
use Repasse\LaravelPodio\Options\PodioOptions;
use Repasse\LaravelPodio\Exceptions\ConfigurationException;

class PodioService
{
    /** @var PodioOptions */
    protected $options;

    public function __construct(array $config)
    {
        $this->options = new PodioOptions($config);
        $this->setUp();
    }

    /**
     * Authenticate with application
     *
     * @param string $appName
     */
    public function authenticateWithApp($appName)
    {
        $app = $this->getApp($appName);

        Podio::authenticate_with_app($app['id'], $app['token']);
    }

    /**
     * Authenticate with password
     */
    public function authenticateWithPassword()
    {
        Podio::authenticate_with_password(
            $this->options->get('username'),
            $this->options->get('password')
        );
    }

    /**
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return Podio::is_authenticated();
    }

    /**
     * Setup
     *
     * @throws ConfigurationException
     */
    public function setUp()
    {
        $options = $this->getOptions();

        /** @var string $clientId */
        $clientId = $options->get('clientId');

        /** @var string $clientSecret */
        $clientSecret = $options->get('clientSecret');

        /** @var array $config */
        $config = $options->get('options');

        if (!$clientId || !$clientSecret) {
            ConfigurationException::message('Please provide a client id & client secret for Podio');
        }

        Podio::setup($clientId, $clientSecret, $config);
    }

    /**
     * Get application from name
     *
     * @param string $appName
     * @return null
     * @throws ConfigurationException
     */
    public function getApp($appName)
    {
        /** @var array $apps */
        $apps = $this->options->get('apps');

        if (!is_array($apps)) {
            ConfigurationException::message('Please provide configuration for your podio application');
        }

        $matchedApp = null;

        foreach ($apps as $app) {
            if (!isset($app['name']) || $app['name'] != $appName) {
                continue;
            }

            $matchedApp = $app;
        }

        if (!$matchedApp) {
            ConfigurationException::missingApp($appName);
        }

        return $matchedApp;
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

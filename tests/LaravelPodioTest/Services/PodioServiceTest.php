<?php

namespace LaravelPodioTest\Services;

use Podio;
use Mockery;
use PHPUnit_Framework_TestCase;
use SpotOnLive\LaravelPodio\Options\PodioOptions;
use SpotOnLive\LaravelPodio\Services\PodioService;
use SpotOnLive\LaravelPodio\Exceptions\ConfigurationException;

class PodioServiceTest extends PHPUnit_Framework_TestCase
{
    /** @var PodioService */
    protected $service;

    /** @var Podio */
    protected $podio;

    /** @var array */
    protected $config = [
        // Authorization
        'clientId' => 'demo-client-id',
        'clientSecret' => 'demo-client-secret',

        'options' => [],

        'username' => 'demo-username',
        'password' => 'demo-password',

        // Apps
        'apps' => [
            [
                // Select an alias for your application
                'name' => 'demo-app',

                // Application credentials
                'id' => 'demo-id',
                'token' => 'demo-token',
            ],
        ],
    ];

    public function setUp()
    {
        $podio = Mockery::mock('overload:' . Podio::class);
        $this->podio = $podio;

        $this->podio->shouldReceive('setup')->with(
            $this->config['clientId'],
            $this->config['clientSecret'],
            $this->config['options']
        );

        $this->service = new PodioService($this->config);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testGetAppInvalidConfiguration()
    {
        $appName = 'demo-app-invalid-name';

        $newOptions = new PodioOptions([
            'apps' => 'string',
        ]);

        $this->service->setOptions($newOptions);

        $this->expectException(ConfigurationException::class);
        $this->expectExceptionMessage('Please provide configuration for your podio application');

        $this->service->getApp($appName);
    }

    public function testGetAppInvalidAppName()
    {
        $appName = 'demo-app-invalid-name';

        $this->expectException(ConfigurationException::class);

        $this->service->getApp($appName);
    }

    public function testGetApp()
    {
        $appName = 'demo-app';

        $result = $this->service->getApp($appName);

        $this->assertSame(
            $this->config['apps'][0],
            $result
        );
    }

    public function testOptions()
    {
        $options = new PodioOptions();

        $this->service->setOptions($options);

        $this->assertSame(
            $options,
            $this->service->getOptions()
        );
    }

    public function testSetUpMissingConfiguration()
    {
        $options = new PodioOptions([]);

        $this->service->setOptions($options);

        $this->expectException(ConfigurationException::class);
        $this->expectExceptionMessage('Please provide a client id & client secret for Podio');

        $this->service->setUp();
    }

    public function testAuthenticateWithApp()
    {
        $appName = 'demo-app';
        $id = 'demo-id';
        $token = 'demo-token';

        $this->podio->shouldReceive('authenticate_with_app')
            ->once()
            ->with($id, $token);

        $this->service->authenticateWithApp($appName);
    }

    public function testAuthenticateWithPassword()
    {
        $username = 'demo-username';
        $password = 'demo-password';

        $this->podio->shouldReceive('authenticate_with_password')
            ->once()
            ->with($username, $password);

        $this->service->authenticateWithPassword();
    }
}

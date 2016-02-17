<?php

namespace LaravelPodioTest\Options;

use PHPUnit_Framework_TestCase;
use SpotOnLive\LaravelPodio\Options\PodioOptions;

class PodioOptionsTest extends PHPUnit_Framework_TestCase
{
    /** @var \SpotOnLive\LaravelPodio\Options\PodioOptions */
    protected $options;

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

    protected $demoOptions = [
        'a' => 'b'
    ];

    public function setUp()
    {
        $options = new PodioOptions($this->demoOptions);
        $this->options = $options;
    }

    public function testGetDefaults()
    {
        $result = $this->options->getDefaults();

        $this->assertSame($this->defaults, $result);
    }

    public function testSetDefaults()
    {
        $defaults = [
            'a' => 'b'
        ];

        $this->options->setDefaults($defaults);
        $result = $this->options->getDefaults();

        $this->assertSame($defaults, $result);
    }

    public function testGetOptions()
    {
        $options = [
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
            'a' => 'b'
        ];

        $result = $this->options->getOptions();

        $this->assertSame($options, $result);
    }

    public function testSetOptions()
    {
        $newOptions = [
            'new' => 'options',
        ];

        $this->options->setOptions($newOptions);

        $result = $this->options->getOptions();

        $this->assertSame($newOptions, $result);
    }

    public function testGetOfNotExistingEntry()
    {
        $key = 'non-existing';

        $result = $this->options->get($key);

        $this->assertNull($result);
    }

    public function testGet()
    {
        $key = 'a';

        $result = $this->options->get($key);

        $this->assertSame($this->demoOptions[$key], $result);
    }
}

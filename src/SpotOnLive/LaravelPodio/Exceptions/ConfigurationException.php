<?php

namespace SpotOnLive\LaravelPodio\Exceptions;

use Exception;

class ConfigurationException extends Exception
{
    /**
     * Throw new exception with message
     *
     * @param string $message
     * @throws ConfigurationException
     */
    public static function message($message)
    {
        throw new ConfigurationException($message);
    }

    /**
     * No configuration for application
     *
     * @param string $appName
     * @throws ConfigurationException
     */
    public static function missingApp($appName)
    {
        throw new ConfigurationException(
            sprintf(
                'No configuration for application %s',
                $appName
            )
        );
    }
}

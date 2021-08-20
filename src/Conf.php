<?php

namespace Chat;


/**
 * Describes configuration parameters of Chat application and provides its
 * default values.
 */
class Conf
{
    /**
     * Corresponds if application is running under debug mode or not.
     *
     * @var bool
     */
    public static $isDebugMode = false;


    /**
     * Contains credentials and settings of MySQL databases used by application.
     *
     * @var array
     */
    public static $MySQL = [
        'name' => '',
        'host' => 'localhost',
        'user' => '',
        'pass' => '',
    ];

    /**
     * Contains credentials and settings of memcached server
     * used by application.
     *
     * Each server must be specified in format "<host>[:<port>]".
     * If no port is specified then port is considered to be default
     * memcached port.
     *
     * @var array
     */
    public static $Memcached = [
        'servers' => ['localhost'],
        'prefix' => 'chat_',
    ];


    /**
     * Parses external configuration file and overrides configuration
     * parameters that were defined there.
     *
     * @param string $file  Relative path (from project root)
     *                      to external configuration file.
     */
    public static function parseFromFile($file = 'conf/application.php')
    {
        if (file_exists($fullPath = PROJECT_ROOT.'/'.$file)) {
            require_once $fullPath;
        }
    }
}

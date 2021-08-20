<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_STRICT);
set_error_handler(  // converts all errors to exceptions
    function ($errno, $errstr, $errfile, $errline, $errcontext) {
        if (0 === error_reporting()) {
            return false;  // error was suppressed with the @-operator
        }
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    },
    E_ALL ^ E_NOTICE ^ E_STRICT
);

mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

date_default_timezone_set('Etc/UTC');

/** Absolute path to project root. */
define('PROJECT_ROOT', dirname(__DIR__));

require_once __DIR__.'/Conf.php';
\Chat\Conf::parseFromFile();

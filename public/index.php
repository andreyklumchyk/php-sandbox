<?php

# TODO: move to *.ini file
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

require_once dirname(__DIR__).'/vendor/autoload.php';

(new \Chat\Application())->run();

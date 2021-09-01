<?php

/** Absolute path to project root. */
define('PROJECT_ROOT', dirname(__DIR__));

require_once __DIR__.'/Conf.php';
\Chat\Conf::parseFromFile();

<?php

self::$isDebugMode = true;

self::$MySQL = [
    'host' => $_ENV['CONF_MYSQL_HOST'],
    'name' => $_ENV['CONF_MYSQL_DB'],
    'user' => $_ENV['CONF_MYSQL_USER'],
    'pass' => $_ENV['CONF_MYSQL_PASS'],
];

<?php

self::$isDebugMode = true;

self::$MySQL = [
    'name' => 'chat',
    'host' => 'localhost',
    'user' => 'admin',
    'pass' => 'qwerty',
];

self::$Memcached = [
    'servers' => ['localhost'],
    'prefix' => 'chat_',
];

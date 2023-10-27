<?php
return [
    'driver' => 'mysql',
    'host' => isset($_ENV['HOST']) ? $_ENV['HOST'] : 'localhost',
    'database' => isset($_ENV['DATABASE']) ? $_ENV['DATABASE'] : 'projects',
    'username' => isset($_ENV['USERNAME']) ? $_ENV['USERNAME'] : 'root',
    'password' => isset($_ENV['PASSWORD']) ? $_ENV['PASSWORD'] : '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
];

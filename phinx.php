<?php

declare(strict_types=1);

Dotenv\Dotenv::createImmutable(__DIR__)->load();

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => $_SERVER['DB_ADAPTER'],
            'host' => $_SERVER['DB_HOST'],
            'name' => 'shortly',
            'user' => $_SERVER['DB_USER'],
            'pass' => $_SERVER['DB_PWD'],
            'port' => $_SERVER['DB_PORT'],
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => $_SERVER['DB_ADAPTER'],
            'host' => $_SERVER['DB_HOST'],
            'name' => 'shortly',
            'user' => $_SERVER['DB_USER'],
            'pass' => $_SERVER['DB_PWD'],
            'port' => $_SERVER['DB_PORT'],
            'charset' => 'utf8',
        ],
    ],
    'version_order' => 'creation',
];

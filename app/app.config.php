<?php

/*
|--------------------------------------------------------------------------
| Swilen application config
|--------------------------------------------------------------------------
*/

return [
    // -------------------------------------------------------------------
    // | BASE APPLICATION CONFIG
    // -------------------------------------------------------------------
    'app' => [
        // APPLICATION SECRET KEY
        'secret' => env('APP_SECRET', ''),

        // APPLICATION ENVIRONMENT
        'env' => env('APP_ENV', 'production'),

        // APPLICATION DEBUG
        'debug' => env('APP_DEBUG', false),
    ],

    // ------------------------------------------------------------------
    // | DATABASE CONNECTION CONFIG
    // ------------------------------------------------------------------
    'database' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'schema' => env('DB_SCHEMA', 'swilen'),
        'username' => env('DB_USERNAME', ''),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8mb4',
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8_unicode_ci;',
        ]) : [],
    ],

    // ------------------------------------------------------------------
    // | CORS CONFIG
    // ------------------------------------------------------------------
    'cors' => [
        'Allow-Origin' => '*',
        'Allow-Headers' => 'X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method',
        'Allow-Methods' => 'GET, POST, OPTIONS, PUT, DELETE',
        'Allow-Credentials' => true,
        'Max-Age' => 600,
    ],

    // ------------------------------------------------------------------
    // | BASE APPLICATION PROVIDERS
    // ------------------------------------------------------------------
    'providers' => [
        \Swilen\Database\DatabaseServiceProvider::class,
        \Swilen\Security\SecurityServiceProvider::class,
        \App\Shared\Providers\RouteServiceProvider::class,
    ],
];

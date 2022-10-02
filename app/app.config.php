<?php

/* ------------------------------------------------------------------- */
/*  Swilen configuration rules                                         */
/* ------------------------------------------------------------------- */

return [

    'database' => [
        'driver'    => env('DB_DRIVER'),
        'host'      => env('DB_HOST'),
        'schema'    => env('DB_SCHEMA'),
        'username'  => env('DB_USERNAME'),
        'password'  => env('DB_PASSWORD'),
        'charset'   => env('DB_CHARSET', 'utf8mb4'),
        'collation' => env('DB_COLLATION', 'utf8_unicode_ci'),
        'prefix'    => env('DB_PREFIX', '')
    ],
];

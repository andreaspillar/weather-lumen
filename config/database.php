<?php

use Illuminate\Support\Str;

return [    
    'default' => 'pgsql',
    'connections' => [
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'unknown'),
            'username' => env('DB_USERNAME', 'unknown'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            // 'prefix' => '',
            // 'prefix_indexes' => true,
            'schema' => 'public',
            // 'sslmode' => 'prefer',
        ],

    ],

    'migrations' => 'migrations',
];
<?php

require_once __DIR__ . '/dotenv.php';

return [
    'db' => [
        'host' => $_ENV['DB_HOST'] ?? 'localhost',
        'name' => $_ENV['DB_NAME'] ?? 'app_meteo',
        'user' => $_ENV['DB_USER'] ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? '',
        'charset' => 'utf8mb4'
    ],
    'app' => [
        'debug' => $_ENV['APP_DEBUG'] ?? true,
        'base_url' => $_ENV['BASE_URL'] ?? 'http://localhost:8000'
    ]
];

?>
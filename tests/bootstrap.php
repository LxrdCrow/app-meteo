<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/database.php';

$pdo = getDatabaseConnection();

// Configuration for testing environment
putenv('APP_ENV=test');
putenv('DB_NAME=app_meteo_test'); 

// Enable error reporting for debug during testing
error_reporting(E_ALL);
ini_set('display_errors', 1);

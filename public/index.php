<?php

require_once __DIR__ . '/Helpers/ErrorHandler.php';


if ($_ENV['APP_ENV'] === 'local') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../config/dotenv.php';

require_once __DIR__ . '/../config/routes.php';


$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];

$router->handle($requestUri, $requestMethod);


?>
<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/ForecastController.php';
require_once __DIR__ . '/controllers/LocationController.php';

header('Content-Type: application/json'); 

$pdo = getDatabaseConnection();

$userController = new UserController($pdo);
$forecastController = new ForecastController($pdo);
$locationController = new LocationController($pdo);

$requestMethod = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


$path = str_replace('/api', '', $path);

// Router
switch (true) {
    case preg_match('/^\/user\/register$/', $path) && $requestMethod === 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $userController->registerUser($data['username'] ?? '', $data['password'] ?? '');
        break;

    case preg_match('/^\/user\/login$/', $path) && $requestMethod === 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $userController->loginUser($data['username'] ?? '', $data['password'] ?? '');
        break;

    case preg_match('/^\/user\/logout$/', $path) && $requestMethod === 'POST':
        $userController->logoutUser();
        break;

    case preg_match('/^\/user\/authenticated$/', $path) && $requestMethod === 'GET':
        $userController->isAuthenticated();
        break;

    case preg_match('/^\/forecast\/(.+)$/', $path, $matches) && $requestMethod === 'GET':
        $forecastController->getForecast($matches[1]); 
        break;

    case preg_match('/^\/location\/add$/', $path) && $requestMethod === 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $locationController->addLocation($data['cityName'] ?? '', $data['latitude'] ?? '', $data['longitude'] ?? '');
        break;

    default:
        http_response_code(404);
        echo json_encode(["error" => "Route not found"]);
        break;
}

?>



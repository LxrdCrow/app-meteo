<?php

require_once __DIR__ . '/../services/UserService.php';

class UserController {
    private $userService;

    public function __construct($pdo) {
        $this->userService = new UserService($pdo);
    }

    public function registerUser($username, $password) {
        $response = $this->userService->registerUser($username, $password);
        echo json_encode($response);
    }

    public function loginUser($username, $password) {
        $response = $this->userService->loginUser($username, $password);
        echo json_encode($response);
    }

    public function isAuthenticated() {
        $authenticated = $this->userService->isAuthenticated();
        echo json_encode(["authenticated" => $authenticated]);
    }

    public function logoutUser() {
        $response = $this->userService->logoutUser();
        echo json_encode($response);
    }
}


?>


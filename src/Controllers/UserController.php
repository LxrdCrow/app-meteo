<?php

require_once __DIR__ . '/../models/User.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
        session_start(); 
    }

    
    public function registerUser($username, $password) {
        
        if (empty($username) || empty($password)) {
            http_response_code(400);
            echo json_encode(["error" => "Username and password are required"]);
            return;
        }

        
        if ($this->userModel->getUserByUsername($username)) {
            http_response_code(409); // 409 = Conflict
            echo json_encode(["error" => "User already exists"]);
            return;
        }

        
        if ($this->userModel->addUser($username, $password)) {
            http_response_code(201); // 201 = Created
            echo json_encode(["message" => "User registered successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Registration failed"]);
        }
    }

    public function isAuthenticated() {
        if (isset($_SESSION['user_id'])) {
            echo json_encode(["authenticated" => true, "user" => $_SESSION['username']]);
        } else {
            http_response_code(401);
            echo json_encode(["authenticated" => false, "error" => "Not logged in"]);
        }
    }

    
    public function loginUser($username, $password) {
        
        if (empty($username) || empty($password)) {
            http_response_code(400);
            echo json_encode(["error" => "Username and password are required"]);
            return;
        }

        // Check if user exists and password is correct
        $user = $this->userModel->getUserByUsername($username);
        if (!$user || !password_verify($password, $user['password'])) {
            http_response_code(401); // 401 = Unauthorized
            echo json_encode(["error" => "Invalid credentials"]);
            return;
        }

        // Login user  and store user data in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        echo json_encode(["message" => "Login successful"]);
    }

    // Logout user 
    public function logoutUser() {
        session_destroy();
        echo json_encode(["message" => "Logged out successfully"]);
    }
}

?>


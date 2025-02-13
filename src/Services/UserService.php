<?php

require_once __DIR__ . '/../models/User.php';

class UserService {

    private $userModel;

    public function _construct ($pdo) {
        $this->userModel = new User($pdo);
    }

    // Registration user after validation
    public function registerUser($username, $password) {
        require_once __DIR__ . '/../Helpers/validator.php';

        if (!validateUsername($username)) {
            return ["error" => "Invalid username"];
        }
        if (!validatePassword($password)) {
            return ["error" => "Weak password"];
        }

        if ($this->userModel->getUserByUsername($username)) {
            return ["error" => "User already exists"];
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($this->userModel->addUser($username, $hashedPassword)) {
            return ["message" => "User registered successfully"];
        }

        return ["error" => "Registration failed"];
    }

    //Autentification and start session
    public function loginUser($username, $password) {
        if (empty($username) || empty($password)) {
            return ["error" => "Username and password are required"];
        }

        $user = $this->userModel->getUserByUsername($username);
        if (!$user || !password_verify($password, $user['password'])) {
            return ["error" => "Invalid credentials"];
        }

        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        return ["message" => "Login successful"];
    }


    public function isAuthenticated() {
        session_start();
        return isset($_SESSION['user_id']);
    }

    // Logout user
    public function logoutUser() {
        session_start();
        session_destroy();
        return ["message" => "Logged out successfully"];
    }
}






?>








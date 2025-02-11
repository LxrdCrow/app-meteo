<?php

require_once __DIR__ . '/../Models/location.php';

class LocationController {
    private $locationModel;

    public function __construct($pdo) {
        $this->locationModel = new Location($pdo);
    }

    public function getAllLocations() {
        $location = $this->locationModel->getAllLocations();
        echo json_encode($location);
    }

    
    public function addLocation($cityName, $latitude, $longitude) {
        if ($this->locationModel->addLocation($cityName, $latitude, $longitude)) {
            echo json_encode(["message" => "Location added successfully"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Location already exists"]);
        }
    }
        
}



?>
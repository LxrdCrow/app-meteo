<?php

require_once __DIR__ . '/../models/Location.php';

class LocationController {
    private $locationModel;

    public function __construct($pdo) {
        $this->locationModel = new Location($pdo);
    }

    
    public function getAllLocations() {
        $locations = $this->locationModel->getAllLocations();
        echo json_encode($locations);
    }

    
    public function getLocationByName($cityName) {
        $location = $this->locationModel->getLocationByName($cityName);
        
        if ($location) {
            echo json_encode($location);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Location not found"]);
        }
    }

    
    public function addLocation($cityName, $latitude, $longitude) {
        
        if (empty($cityName) || empty($latitude) || empty($longitude)) {
            http_response_code(400);
            echo json_encode(["error" => "Missing required fields"]);
            return;
        }

        
        $existingLocation = $this->locationModel->getLocationByName($cityName);
        if ($existingLocation) {
            http_response_code(409); // 409 = Conflict
            echo json_encode(["error" => "Location already exists"]);
            return;
        }

        // Add the new location to the database
        if ($this->locationModel->addLocation($cityName, $latitude, $longitude)) {
            http_response_code(201); // 201 = Created
            echo json_encode(["message" => "Location added successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to add location"]);
        }
    }
}

?>

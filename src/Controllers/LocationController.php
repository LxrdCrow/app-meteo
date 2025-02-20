<?php

require_once __DIR__ . '/../services/LocationService.php';

class LocationController {
    private $locationService;

    public function __construct($pdo) {
        $this->locationService = new LocationService($pdo);
    }

    public function getAllLocations() {
        try {
            $locations = $this->locationService->getLocations();
            echo json_encode($locations);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function getLocationByName($cityName) {
        try {
            $location = $this->locationService->searchLocation($cityName);
            if ($location) {
                echo json_encode($location);
            } else {
                http_response_code(404);
                echo json_encode(["error" => "Location not found"]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function addLocation($cityName, $latitude, $longitude) {
        try {
            if (empty($cityName) || empty($latitude) || empty($longitude)) {
                throw new Exception("Missing required fields");
            }
            
            $this->locationService->addLocation($cityName, $latitude, $longitude);
            http_response_code(201);
            echo json_encode(["message" => "Location added successfully"]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function deleteLocation($cityName) {
        try {
            $this->locationService->deleteLocation($cityName);
            echo json_encode(["message" => "Location deleted successfully"]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function updateLocation($cityName, $latitude, $longitude) {
        try {
            $this->locationService->updateLocation($cityName, $latitude, $longitude);
            echo json_encode(["message" => "Location updated successfully"]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    public function toggleFavoriteLocation($cityName) {
        try {
            $this->locationService->toggleFavoriteLocation($cityName);
            echo json_encode(["message" => "Favorite status updated"]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}

?>

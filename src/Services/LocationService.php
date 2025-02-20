<?php

require_once __DIR__ . '/../models/location.php';

class LocationService {
    private $locationModel;

    public function __construct($pdo) {
        $this->locationModel = new Location($pdo);
    }

    public function searchLocation($cityName) {
        return $this->locationModel->getLocationByName($cityName);
    }

    public function addLocation($cityName, $latitude, $longitude) {
        if ($this->locationModel->getLocationByName($cityName)) {
            throw new Exception("Location already exists.");
        }
        return $this->locationModel->addLocation($cityName, $latitude, $longitude);
    }

    public function getLocations() {
        return $this->locationModel->getAllLocations();
    }

    public function deleteLocation($cityName) {
        if (!$this->locationModel->getLocationByName($cityName)) {
            throw new Exception("Location not found.");
        }
        return $this->locationModel->deleteLocation($cityName);
    }

    public function updateLocation($cityName, $latitude, $longitude) {
        if (!$this->locationModel->getLocationByName($cityName)) {
            throw new Exception("Location not found.");
        }
        return $this->locationModel->updateLocation($cityName, $latitude, $longitude);
    }

    public function toggleFavoriteLocation($cityName) {
        if (!$this->locationModel->getLocationByName($cityName)) {
            throw new Exception("Location not found.");
        }
        return $this->locationModel->toggleFavoriteLocation($cityName);
    }
}

?>
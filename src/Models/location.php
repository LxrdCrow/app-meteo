<?php

require_once __DIR__ . '/../config/config.php';

class Location {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllLocations() {
        $stmt = $this->pdo->prepare("SELECT * FROM locations");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLocationByName($cityName) {
        $stmt = $this->pdo->prepare("SELECT * FROM locations WHERE city_name = ?");
        $stmt->execute([$cityName]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addLocation($cityName, $latitude, $longitude) {
        $stmt = $this->pdo->prepare("INSERT INTO locations (city_name, latitude, longitude) VALUES (?, ?, ?)");
        return $stmt->execute([$cityName, $latitude, $longitude]);
    }

    public function deleteLocation($cityName) {
        $stmt = $this->pdo->prepare("DELETE FROM locations WHERE city_name = ?");
        return $stmt->execute([$cityName]);
    }

    public function updateLocation($cityName, $latitude, $longitude) {
        $stmt = $this->pdo->prepare("UPDATE locations SET latitude = ?, longitude = ? WHERE city_name = ?");
        return $stmt->execute([$latitude, $longitude, $cityName]);
    }

    public function toggleFavoriteLocation($cityName) {
        $stmt = $this->pdo->prepare("UPDATE locations SET is_favorite = NOT is_favorite WHERE city_name = ?");
        return $stmt->execute([$cityName]);
    }
}

?>




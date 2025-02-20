<?php

require_once __DIR__ . '/../config/config.php';

class Forecast {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    
    public function getForecastByLocation($locationId) {
        $stmt = $this->pdo->prepare("SELECT * FROM forecasts WHERE location_id = ?");
        $stmt->execute([$locationId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function addForecast($locationId, $date, $temperature, $description) {
        $formattedDate = date('Y-m-d', strtotime($date));

        $stmt = $this->pdo->prepare("INSERT INTO forecasts (location_id, date, temperature, description) 
                                     VALUES (?, ?, ?, ?)");
        return $stmt->execute([$locationId, $formattedDate, $temperature, $description]);
    }
}
?>



<?php

require_once __DIR__ . '/../config/config.php';

class Forecast {
    private $pdo;
    private $apiKey;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->apiKey = getenv('API_KEY'); 
    }

    public function getForecastByLocation($locationId) {
        $stmt = $this->pdo->prepare("SELECT * FROM forecasts WHERE location_id = ?");
        $stmt->execute([$locationId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWeather($cityName) {
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$cityName}&appid={$this->apiKey}&units=metric";
        
        $response = @file_get_contents($url);
        
        if ($response === FALSE) {
            return ["error" => "Impossible to retrieve weather data"];
        }

        return json_decode($response, true);
    }

    public function addForecast($locationId, $date, $temperature, $description) {
        $formattedDate = date('Y-m-d', strtotime($date)); 
        
        $stmt = $this->pdo->prepare("INSERT INTO forecasts (location_id, date, temperature, description) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$locationId, $formattedDate, $temperature, $description]);
    }
}

?>


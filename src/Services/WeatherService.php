<?php

require_once __DIR__ . '/../models/forecast.php';

class WeatherService {
    private $pdo;
    private $forecastModel;
    private $apiKey;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        $this->forecastModel = new Forecast($pdo);
        $this->apiKey = getenv('API_KEY'); // API Key for OpenWeatherMap
    }

    // Obtain current weather data from OpenWeatherMap
    public function getCurrentWeather($cityName) {
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$cityName}&appid={$this->apiKey}&units=metric";
        
        $response = @file_get_contents($url);
        
        if ($response === FALSE) {
            return ["error" => "Impossible to retrieve weather data"];
        }

        return json_decode($response, true);
    }

    
    
    public function saveForecast($cityName) {
        
        $stmt = $this->pdo->prepare("SELECT id FROM locations WHERE city_name = ?");
        $stmt->execute([$cityName]);
        $location = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$location) {
            return ["error" => "Location not found"];
        }

        
        $weatherData = $this->getCurrentWeather($cityName);

        if (isset($weatherData['error'])) {
            return $weatherData;
        }

        $locationId = $location['id'];
        $date = date('Y-m-d');
        $temperature = $weatherData['main']['temp'];
        $description = $weatherData['weather'][0]['description'];

        
        if ($this->forecastModel->addForecast($locationId, $date, $temperature, $description)) {
            return ["message" => "Forecast saved successfully"];
        } else {
            return ["error" => "Failed to save forecast"];
        }
    }

    // Obtain saved forecasts
    public function getSavedForecasts($cityName) {
        // Controlliamo se la città esiste nel database
        $stmt = $this->pdo->prepare("SELECT id FROM locations WHERE city_name = ?");
        $stmt->execute([$cityName]);
        $location = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$location) {
            return ["error" => "Location not found"];
        }

        return $this->forecastModel->getForecastByLocation($location['id']);
    }
}
?>

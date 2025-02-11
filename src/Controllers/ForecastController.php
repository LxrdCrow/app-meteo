<?php

require_once __DIR__ . '/../models/Forecast.php';
require_once __DIR__ . '/../models/Location.php';

class ForecastController {
    private $forecastModel;
    private $locationModel;

    public function __construct($pdo) {
        $this->forecastModel = new Forecast($pdo);
        $this->locationModel = new Location($pdo);
    }

    public function getForecast($cityName) {
        $weatherData = $this->forecastModel->getWeather($cityName);
        
        if (!$weatherData) {
            http_response_code(404);
            echo json_encode(["error" => "City not found"]);
            return;
        }

        echo json_encode($weatherData);
    }

    public function addForecast($locationId, $date, $temperature, $description) {
        if ($this->forecastModel->addForecast($locationId, $date, $temperature, $description)) {
            http_response_code(201);
            echo json_encode(["message" => "Forecast added successfully"]);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Forecast already exists or invalid data"]);
        }
    }

    public function saveForecast($cityName) {
        
        $location = $this->locationModel->getLocationByName($cityName);

        if (!$location) {
            http_response_code(404);
            echo json_encode(["error" => "Location not found. Add it first."]);
            return;
        }

        $locationId = $location['id'];

        
        $weatherData = $this->forecastModel->getWeather($cityName);

        if (!$weatherData) {
            http_response_code(404);
            echo json_encode(["error" => "Weather data not available"]);
            return;
        }

        
        $date = date('Y-m-d');
        $temperature = $weatherData['main']['temp'];
        $description = $weatherData['weather'][0]['description'];

        
        if ($this->forecastModel->addForecast($locationId, $date, $temperature, $description)) {
            http_response_code(201);
            echo json_encode(["message" => "Forecast saved successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Failed to save forecast"]);
        }
    }
}

?>






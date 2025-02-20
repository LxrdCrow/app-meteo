<?php

require_once __DIR__ . '/../services/ForecastService.php';
require_once __DIR__ . '/../models/location.php';

class ForecastController {
    private $forecastService;
    private $locationModel;

    public function __construct($pdo) {
        $this->forecastService = new ForecastService();
        $this->locationModel = new Location($pdo);
    }

    // Get forecast for a location
    public function getForecast($cityName) {
        try {
            $weatherData = $this->forecastService->getWeatherForecast($cityName);
            echo json_encode($weatherData);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }

    // Save forecast for a location
    public function saveForecast($cityName) {
        try {
            // Check if location exists
            $location = $this->locationModel->getLocationByName($cityName);
            if (!$location) {
                throw new Exception("Location not found. Add it first.");
            }

            // Weather data from API
            $weatherData = $this->forecastService->getWeatherForecast($cityName);
            
            $locationId = $location['id'];
            $date = date('Y-m-d');
            $temperature = $weatherData['temperature'];
            $description = $weatherData['weather'];

            
            if ($this->forecastModel->addForecast($locationId, $date, $temperature, $description)) {
                http_response_code(201);
                echo json_encode(["message" => "Forecast saved successfully"]);
            } else {
                throw new Exception("Failed to save forecast.");
            }
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}
?>







<?php

require_once __DIR__ . '/../config/config.php';

class ForecastService {
    private $apiKey;
    private $apiUrl = "https://api.openweathermap.org/data/2.5/weather";

    public function __construct() {
        $this->apiKey = WEATHER_API_KEY; 
    }

    public function getWeatherForecast($cityName) {
        $url = "{$this->apiUrl}?q={$cityName}&appid={$this->apiKey}&units=metric";

        $response = file_get_contents($url);
        if (!$response) {
            throw new Exception("Failed to retrieve weather data.");
        }

        $data = json_decode($response, true);
        if ($data['cod'] !== 200) {
            throw new Exception("Error: " . $data['message']);
        }

        return [
            "city" => $data["name"],
            "temperature" => $data["main"]["temp"],
            "humidity" => $data["main"]["humidity"],
            "weather" => $data["weather"][0]["description"],
            "wind_speed" => $data["wind"]["speed"]
        ];
    }
}


?>
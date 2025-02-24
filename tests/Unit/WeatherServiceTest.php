<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../services/WeatherService.php';
require_once __DIR__ . '/../../models/forecast.php';

class WeatherServiceTest extends TestCase {
    private $mockPdo;
    private $mockForecast;
    private $weatherService;

    protected function setUp(): void {
        // Mock PDO
        $this->mockPdo = $this->createMock(PDO::class);

        $this->mockForecast = $this->createMock(Forecast::class);

        $this->weatherService = new WeatherService($this->mockPdo);
        
        $this->weatherService->forecastModel = $this->mockForecast;
    }

    public function testGetWeatherByCity() {
        $cityName = "Messina";
        $expectedWeather = [
            "main" => ["temp" => 15.5],
            "weather" => [["description" => "clear sky"]]
        ];

        
        $this->mockForecast->method('getWeather')
            ->with($cityName)
            ->willReturn($expectedWeather);

        
        $weatherData = $this->weatherService->forecastModel->getWeather($cityName);

        // Verified the results
        $this->assertNotEmpty($weatherData, "Weather data not found.");
        $this->assertEquals(15.5, $weatherData['main']['temp']);
        $this->assertEquals("clear sky", $weatherData['weather'][0]['description']);
    }
}

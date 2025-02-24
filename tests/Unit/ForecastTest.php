<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../models/forecast.php';

class ForecastTest extends TestCase {
    private $mockPdo;
    private $forecast;

    protected function setUp(): void {
        $this->mockPdo = $this->createMock(PDO::class);
        $this->forecast = new Forecast($this->mockPdo);
    }

    public function testGetWeatherReturnsData() {
        $mockResponse = ['main' => ['temp' => 22], 'weather' => [['description' => 'Clear sky']]];
        $forecastMock = $this->getMockBuilder(Forecast::class)
                             ->setConstructorArgs([$this->mockPdo])
                             ->onlyMethods(['getWeather'])
                             ->getMock();

        $forecastMock->expects($this->once())
                     ->method('getWeather')
                     ->with('Messina')
                     ->willReturn($mockResponse);

        $result = $forecastMock->getWeather('Messina');
        $this->assertEquals(22, $result['main']['temp']);
        $this->assertEquals('Clear sky', $result['weather'][0]['description']);
    }
}

<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../controllers/ForecastController.php';
require_once __DIR__ . '/../../models/forecast.php';
require_once __DIR__ . '/../../config/database.php';

class ForecastControllerTest extends TestCase {
    private $pdo;
    private $controller;

    protected function setUp(): void {
        $this->pdo = getDatabaseConnection(); 
        $this->controller = new ForecastController($this->pdo);
    }

    public function testGetForecastReturnsData() {
        ob_start(); 
        $this->controller->getForecast('Messina');
        $output = ob_get_clean();

        $decodedOutput = json_decode($output, true);
        $this->assertArrayHasKey('main', $decodedOutput);
        $this->assertArrayHasKey('temp', $decodedOutput['main']);
    }
}

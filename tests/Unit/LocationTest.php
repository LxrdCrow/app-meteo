<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../models/location.php';

class LocationTest extends TestCase {
    private $mockPdo;
    private $mockStmt;
    private $locationModel;

    protected function setUp(): void {
        
        $this->mockPdo = $this->createMock(PDO::class);
        $this->mockStmt = $this->createMock(PDOStatement::class);
        $this->mockPdo->method('prepare')->willReturn($this->mockStmt);
        $this->locationModel = new Location($this->mockPdo);
    }

    public function testGetLocationByName() {
        $cityName = "Messina";
        $expectedLocation = ['id' => 1, 'city_name' => 'Messina', 'country_code' => 'IT'];

        // Configuration mock PDOStatement
        $this->mockStmt->method('execute')->willReturn(true);
        $this->mockStmt->method('fetch')->willReturn($expectedLocation);

        // Call the method
        $location = $this->locationModel->getLocationByName($cityName);

        // Verify the results
        $this->assertNotEmpty($location, "Location not found.");
        $this->assertEquals($expectedLocation['city_name'], $location['city_name']);
        $this->assertEquals($expectedLocation['country_code'], $location['country_code']);
    }
}

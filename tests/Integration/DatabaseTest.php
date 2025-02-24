<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../config/database.php';

class DatabaseTest extends TestCase {
    private $pdo;

    protected function setUp(): void {
        $this->pdo = getDatabaseConnection();
    }

    public function testDatabaseConnectionIsSuccessful() {
        $this->assertInstanceOf(PDO::class, $this->pdo, "Connection failed to the database.");
    }

    public function testCanInsertAndRetrieveData() {
        
        $this->pdo->exec("DELETE FROM forecasts");

        
        $stmt = $this->pdo->prepare("INSERT INTO forecasts (location_id, date, temperature, description) VALUES (?, ?, ?, ?)");
        $stmt->execute([1, '2025-02-21', 15.5, 'Sunny']);

        
        $stmt = $this->pdo->query("SELECT * FROM forecasts WHERE location_id = 1");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($result, "No dates were found in the database.");
        $this->assertEquals(15.5, $result['temperature'], "Temperature not found in the database.");
        $this->assertEquals('Sunny', $result['description'], "Description not found in the database.");
    }
}

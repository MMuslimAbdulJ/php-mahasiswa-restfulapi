<?php 

namespace muslim\restfulapi\Config;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase {
    
    // test connection
    public function testConnection() {
        $connection = Database::getConnection();
        self::assertNotNull($connection);
    }

    // test for singleton
    public function testSingleton() {
        $connection1 = Database::getConnection();
        $connection2 = Database::getConnection();
        self::assertSame($connection1, $connection2);
    }

}

?>
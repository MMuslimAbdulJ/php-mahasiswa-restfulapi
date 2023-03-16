<?php 

namespace muslim\restfulapi\Config;

use PDO;
/**
 * The database is using singleton design pattern
 */
class Database {
    private static ?PDO $pdo = null;

    public static function getConnection($env = 'test') : PDO {
        if(self::$pdo == null) {
            require_once __DIR__ . './../../config/database.php';
            $config = getConfig(); // Get  the database config
            self::$pdo = new PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password']
            );
        }
        return self::$pdo;
    }

    public static function beginTransaction() {
        self::$pdo->beginTransaction();
    }

    public static function commitTransaction() {
        self::$pdo->commit();
    }

    public static function rollbackTransaction() {
        self::$pdo->rollBack();
    }
}

?>
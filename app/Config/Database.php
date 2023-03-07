<?php 

namespace muslim\restfulapi\Config;

use PDO;

class Database {
    private static ?PDO $pdo = null;

    public static function getConnection($env = 'test') : PDO {
        if(self::$pdo == null) {
            require_once __DIR__ . './../../config/database.php';
            $config = getConfig();
            self::$pdo = new PDO(
                $config['database'][$env]['url'],
                $config['database'][$env]['username'],
                $config['database'][$env]['password']
            );
        }
        return self::$pdo;
    }
}

?>
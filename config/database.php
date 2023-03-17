<?php 
/**
 * prod = for production
 * test = for unit test purpose
 */
function getConfig() : array {
    return [
        'database' => [
            'prod' => [
                'url' => 'mysql:host=localhost:3306;dbname=restapi',
                'username' => 'your_database_username',
                'password' => 'your_database_password'
            ],
            'test' => [
                'url' => 'mysql:host=localhost:3306;dbname=restapi_test',
                'username' => 'your_database_username',
                'password' => 'your_database_password'
            ]
        ]
    ];
}

?>
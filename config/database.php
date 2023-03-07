<?php 

function getConfig() : array {
    return [
        'database' => [
            'prod' => [
                'url' => 'mysql:host=localhost:3306;dbname=restapi',
                'username' => 'mmuslimabdulj',
                'password' => 'Babang_030'
            ],
            'test' => [
                'url' => 'mysql:host=localhost:3306;dbname=restapi_test',
                'username' => 'mmuslimabdulj',
                'password' => 'Babang_030'
            ]
        ]
    ];
}

?>
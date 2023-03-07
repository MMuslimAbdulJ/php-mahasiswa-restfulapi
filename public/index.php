<?php 
require_once __DIR__ . './../vendor/autoload.php';
use muslim\restfulapi\App\Router;
use muslim\restfulapi\Controller\MahasiswaController;

Router::add('GET', '/', MahasiswaController::class, 'index', []);
Router::add('GET', '/', MahasiswaController::class, 'index', []);
Router::add('GET', '/', MahasiswaController::class, 'index', []);
Router::add('GET', '/', MahasiswaController::class, 'index', []);

Router::run();
?>
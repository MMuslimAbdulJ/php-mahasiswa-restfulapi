<?php 
require_once __DIR__ . './../vendor/autoload.php';
use muslim\restfulapi\App\Router;
use muslim\restfulapi\Config\Database;
use muslim\restfulapi\Controller\MahasiswaController;

// Database::getConnection('prod'); // turn off for unit-test, turn on for production

// Create Mahasiswa
Router::add('POST', '/api/mahasiswa', MahasiswaController::class, 'createMahasiswa', []);

// Get Mahasiswa
Router::add('GET', '/api/mahasiswa/([0-9]*)', MahasiswaController::class, 'getMahasiswa', []);

// Update Mahasiswa
Router::add('PUT', '/api/mahasiswa/([0-9]*)', MahasiswaController::class, 'updateMahasiswa', []);

// Delete Mahasiswa
Router::add('DELETE', '/api/mahasiswa/([0-9]*)', MahasiswaController::class, 'deleteMahasiswa', []);

header('Content-type: application/json; charset=UTF-8');

Router::run();

?>
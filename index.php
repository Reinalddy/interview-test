<?php
// index.php
require_once 'controllers/KaryawanController.php';

// Database Connection
$host = 'localhost';
$db = 'db_sefas_karyawan';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

$controller = new KaryawanController($pdo);
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'add':
        $controller->add();
        break;
    case 'edit':
        $controller->edit($id);
        break;
    case 'delete':
        $controller->delete($id);
        break;
    default:
        $controller->index();
        break;
}
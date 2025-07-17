<?php
// usuarios.php - Devuelve usuarios por rol
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'No autorizado']);
    exit;
}

$host = 'localhost';
$db = 'empresa_dev';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error de conexión a la base de datos']);
    exit;
}

$rol = $_GET['rol'] ?? '';
if (!$rol) {
    http_response_code(400);
    echo json_encode(['error' => 'Rol requerido']);
    exit;
}
$stmt = $pdo->prepare('SELECT id, nombre FROM users WHERE rol = ?');
$stmt->execute([$rol]);
echo json_encode($stmt->fetchAll());

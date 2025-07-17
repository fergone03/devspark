<?php
// register.php - Registro de nuevos usuarios
session_start();
header('Content-Type: application/json');

// Configuración de conexión
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

$input = json_decode(file_get_contents('php://input'), true);
$nombre = trim($input['nombre'] ?? '');
$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';
$rol = $input['rol'] ?? 'trabajador'; // Por defecto trabajador

if (!$nombre || !$email || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'Todos los campos son obligatorios']);
    exit;
}

// Comprobar si ya existe el email
$stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
$stmt->execute([$email]);
if ($stmt->fetch()) {
    http_response_code(409);
    echo json_encode(['error' => 'El correo ya está registrado']);
    exit;
}

// Crear usuario
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare('INSERT INTO users (nombre, email, password, rol) VALUES (?, ?, ?, ?)');
$stmt->execute([$nombre, $email, $hash, $rol]);

// Login automático tras registro
$_SESSION['user_id'] = $pdo->lastInsertId();
$_SESSION['user_name'] = $nombre;
$_SESSION['user_role'] = $rol;

echo json_encode(['success' => true, 'nombre' => $nombre, 'rol' => $rol]);

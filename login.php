<?php
// login.php - Valida usuario y crea sesión
session_start();
header('Content-Type: application/json');

// Configuración de conexión (ajusta según tu entorno)
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

// Obtener datos JSON del body
$input = json_decode(file_get_contents('php://input'), true);
$email = $input['email'] ?? '';
$password = $input['password'] ?? '';

if (!$email || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'Email y contraseña requeridos']);
    exit;
}

// Buscar usuario
$stmt = $pdo->prepare('SELECT id, email, password, nombre, rol FROM users WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Credenciales incorrectas']);
    exit;
}

// Crear sesión
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['nombre'];
$_SESSION['user_role'] = $user['rol'];

// Responder con datos del usuario (sin contraseña)
echo json_encode([
    'id' => $user['id'],
    'nombre' => $user['nombre'],
    'rol' => $user['rol']
]);

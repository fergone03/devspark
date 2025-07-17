<?php
// proyectos.php - API CRUD para proyectos
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'No autenticado']);
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

$method = $_SERVER['REQUEST_METHOD'];
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];

switch ($method) {
    case 'GET':
        if ($user_role === 'admin') {
            $stmt = $pdo->query('SELECT p.id, p.nombre, p.descripcion, u.nombre AS trabajador FROM proyectos p LEFT JOIN users u ON p.trabajador_id = u.id');
            $proyectos = $stmt->fetchAll();
        } else {
            $stmt = $pdo->prepare('SELECT p.id, p.nombre, p.descripcion, u.nombre AS trabajador FROM proyectos p LEFT JOIN users u ON p.trabajador_id = u.id WHERE p.trabajador_id = ?');
            $stmt->execute([$user_id]);
            $proyectos = $stmt->fetchAll();
        }
        echo json_encode($proyectos);
        break;
    case 'POST':
        if ($user_role !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'No autorizado']);
            exit;
        }
        $input = json_decode(file_get_contents('php://input'), true);
        $nombre = $input['nombre'] ?? '';
        $descripcion = $input['descripcion'] ?? '';
        $trabajador_id = $input['trabajador_id'] ?? null;
        if (!$nombre || !$descripcion || !$trabajador_id) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos']);
            exit;
        }
        $stmt = $pdo->prepare('INSERT INTO proyectos (nombre, descripcion, trabajador_id) VALUES (?, ?, ?)');
        $stmt->execute([$nombre, $descripcion, $trabajador_id]);
        echo json_encode(['success' => true]);
        break;
    case 'PUT':
        if ($user_role !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'No autorizado']);
            exit;
        }
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;
        $nombre = $input['nombre'] ?? '';
        $descripcion = $input['descripcion'] ?? '';
        $trabajador_id = $input['trabajador_id'] ?? null;
        if (!$id || !$nombre || !$descripcion || !$trabajador_id) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos incompletos']);
            exit;
        }
        $stmt = $pdo->prepare('UPDATE proyectos SET nombre = ?, descripcion = ?, trabajador_id = ? WHERE id = ?');
        $stmt->execute([$nombre, $descripcion, $trabajador_id, $id]);
        echo json_encode(['success' => true]);
        break;
    case 'DELETE':
        if ($user_role !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'No autorizado']);
            exit;
        }
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID requerido']);
            exit;
        }
        $stmt = $pdo->prepare('DELETE FROM proyectos WHERE id = ?');
        $stmt->execute([$id]);
        echo json_encode(['success' => true]);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
}

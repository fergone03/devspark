<?php
// dashboard.php - Panel principal de proyectos
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit;
}
$nombre = $_SESSION['user_name'];
$rol = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DevSpark - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="styles.css" rel="stylesheet">
</head>
<body data-user-role="<?php echo htmlspecialchars($rol); ?>">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container">
    <span class="navbar-brand fs-3 fw-bold text-primary">DevSpark</span>
    <div class="ms-auto d-flex align-items-center gap-3">
      <span class="fw-semibold text-dark"><?php echo htmlspecialchars($nombre); ?> <span class="badge bg-secondary ms-1 text-capitalize"><?php echo htmlspecialchars($rol); ?></span></span>
      <button id="logoutBtn" class="btn btn-outline-danger btn-sm rounded-pill px-4">Cerrar sesión</button>
    </div>
  </div>
</nav>
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Proyectos</h2>
    <?php if ($rol === 'admin'): ?>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#proyectoModal">Crear proyecto</button>
    <?php endif; ?>
  </div>
  <div id="alertContainer"></div>
  <div id="spinner" class="text-center my-4" style="display:none;">
    <div class="spinner-border" role="status"><span class="visually-hidden">Cargando...</span></div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped align-middle" id="proyectosTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Trabajador</th>
          <?php if ($rol === 'admin'): ?><th>Acciones</th><?php endif; ?>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>
<!-- Modal para crear/editar proyecto -->
<div class="modal fade" id="proyectoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="proyectoForm">
        <div class="modal-header">
          <h5 class="modal-title" id="proyectoModalLabel">Nuevo proyecto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="proyectoId">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" required>
          </div>
          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" required></textarea>
          </div>
          <div class="mb-3">
            <label for="trabajador" class="form-label">Trabajador asignado</label>
            <select class="form-select" id="trabajador" required></select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="app.js"></script>
</body>
</html>

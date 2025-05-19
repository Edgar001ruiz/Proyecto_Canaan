<?php
session_start();
require_once(__DIR__ . '/../config/auth.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h1 class="mb-4">👋 Bienvenido, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></h1>

    <p><strong>Rol:</strong> <?php echo isset($_SESSION['admin_role']) ? htmlspecialchars($_SESSION['admin_role']) : 'No definido'; ?></p>

    <!-- Sección de Administradores -->
    <div class="mb-4">
      <h3 class="text-primary">👤 Administradores</h3>
      <div class="row g-3">
        <div class="col-md-6">
          <a href="administradores/crear_admin.php" class="btn btn-success w-100">➕ Crear nuevo administrador</a>
        </div>
        <div class="col-md-6">
          <a href="administradores/listar_admins.php" class="btn btn-primary w-100">📋 Ver administradores</a>
        </div>
      </div>
    </div>

    <!-- Sección de Gestión del Sitio -->
    <div class="mb-4">
      <h3 class="text-primary">🛠️ Gestión del Sitio</h3>
      <div class="row g-3">
        <div class="col-md-4">
          <a href="eventos/gestionar_evento.php" class="btn btn-outline-primary w-100">📅 Gestionar eventos</a>
        </div>
        <div class="col-md-4">
          <a href="pastores/gestionar_pastores.php" class="btn btn-outline-primary w-100">👥 Gestionar pastores</a>
        </div>
        <div class="col-md-4">
          <a href="ministerios/gestionar_ministerio.php" class="btn btn-outline-primary w-100">⛪ Gestionar ministerios</a>
        </div>
      </div>
    </div>

    <!-- Cerrar sesión -->
    <div class="mt-4">
      <a href="logout.php" class="btn btn-outline-danger">Cerrar sesión</a>
    </div>
  </div>
</body>
</html>

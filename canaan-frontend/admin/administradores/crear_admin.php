<?php
session_start();
require_once(__DIR__ . '/../../config/auth.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">

    <h2 class="mb-4">➕ Crear Nuevo Administrador</h2>

    <!-- Formulario de creación -->
    <form action="registrar_admin.php" method="POST" class="bg-white p-4 rounded shadow-sm">
      <div class="mb-3">
        <label for="username" class="form-label">Nombre de usuario</label>
        <input type="text" name="username" id="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <!-- El rol se asigna automáticamente como "administrador" -->

      <button type="submit" class="btn btn-success">Crear Administrador</button>
    </form>

    <!-- Navegación -->
    <div class="mt-4">
      <a href="listar_admins.php" class="btn btn-outline-primary">📋 Ver todos los administradores</a>
      <a href="../dashboard.php" class="btn btn-outline-secondary">⬅️ Volver al Panel</a>
    </div>

  </div>
</body>
</html>

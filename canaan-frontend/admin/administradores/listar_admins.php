<?php
session_start();
require_once(__DIR__ . '/../../config/auth.php');
require_once(__DIR__ . '/../../config/db.php');

// Obtener todos los administradores
$stmt = $pdo->query("SELECT * FROM administradores");
$admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Administradores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">📋 Lista de Administradores</h2>

    <?php if (count($admins) > 0): ?>
      <table class="table table-bordered table-hover bg-white">
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($admins as $admin): ?>
            <tr>
              <td><?php echo htmlspecialchars($admin['id']); ?></td>
              <td><?php echo htmlspecialchars($admin['username']); ?></td>
              <td>
                <a href="editar_admin.php?id=<?php echo $admin['id']; ?>" class="btn btn-sm btn-warning">✏️ Editar</a>
                <a href="eliminar_admin.php?id=<?php echo $admin['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminar este administrador?');">🗑️ Eliminar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-muted">No hay administradores registrados aún.</p>
    <?php endif; ?>

    <!-- Navegación -->
    <div class="mt-4">
      <a href="crear_admin.php" class="btn btn-success">➕ Crear nuevo administrador</a>
      <a href="../dashboard.php" class="btn btn-outline-secondary">⬅️ Volver al Panel</a>
    </div>
  </div>
</body>
</html>

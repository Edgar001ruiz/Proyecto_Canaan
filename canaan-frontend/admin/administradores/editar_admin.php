<?php
session_start();
require_once(__DIR__ . '/../../config/auth.php');
require_once(__DIR__ . '/../../config/db.php');

// Validar que viene el ID
if (!isset($_GET['id'])) {
  header('Location: listar_admins.php');
  exit();
}

$id = $_GET['id'];

// Obtener datos del administrador
$stmt = $pdo->prepare("SELECT * FROM administradores WHERE id = ?");
$stmt->execute([$id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
  echo "<p class='text-danger'>Administrador no encontrado.</p>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Administrador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">

    <h2 class="mb-4">✏️ Editar Administrador</h2>

    <form action="procesar_editar_admin.php" method="POST" class="bg-white p-4 rounded shadow-sm">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($admin['id']); ?>">

      <div class="mb-3">
        <label for="username" class="form-label">Nombre de usuario</label>
        <input type="text" name="username" id="username" class="form-control"
               value="<?php echo htmlspecialchars($admin['username']); ?>" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Nueva Contraseña (dejar en blanco si no se desea cambiar)</label>
        <input type="password" name="password" id="password" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>

    <!-- Navegación -->
    <div class="mt-4">
      <a href="listar_admins.php" class="btn btn-outline-primary">📋 Ver todos los administradores</a>
      <a href="../dashboard.php" class="btn btn-outline-secondary">⬅️ Volver al Panel</a>
    </div>

  </div>
</body>
</html>

<?php
require_once '../../config/auth.php';
require_once '../../config/db.php';

if (!isset($_GET['id'])) {
    header('Location: gestionar_pastores.php');
    exit();
}

$id = intval($_GET['id']);

try {
    // Obtener datos actuales del pastor
    $stmt = $pdo->prepare("SELECT * FROM pastores WHERE id = ?");
    $stmt->execute([$id]);
    $pastor = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pastor) {
        header('Location: gestionar_pastores.php');
        exit();
    }
} catch (PDOException $e) {
    die("Error al obtener pastor: " . $e->getMessage());
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre_completo'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $tiempo_pastorado = $_POST['tiempo_pastorado'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    // Validar mínimo básico (puedes extender validaciones)
    if (!$nombre || !$fecha_nacimiento || !$tiempo_pastorado) {
        $error = "Por favor completa todos los campos obligatorios.";
    } else {
        // Manejar subida de imagen (si hay)
        $imagenNombre = $pastor['imagen']; // mantener imagen actual si no se cambia

        if (!empty($_FILES['imagen']['name'])) {
            $file = $_FILES['imagen'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (in_array($file['type'], $allowedTypes) && $file['size'] <= 2 * 1024 * 1024) {
                // Subir imagen
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $imagenNombre = 'pastor_' . time() . '.' . $ext;
                $destino = '../../uploads/pastores/' . $imagenNombre;
                if (!move_uploaded_file($file['tmp_name'], $destino)) {
                    $error = "Error al subir la imagen.";
                }
            } else {
                $error = "Formato o tamaño de imagen no válido (máx 2MB).";
            }
        }

        if (!isset($error)) {
            try {
                $updateStmt = $pdo->prepare("UPDATE pastores SET nombre_completo = ?, fecha_nacimiento = ?, tiempo_pastorado = ?, descripcion = ?, imagen = ? WHERE id = ?");
                $updateStmt->execute([$nombre, $fecha_nacimiento, $tiempo_pastorado, $descripcion, $imagenNombre, $id]);
                header('Location: gestionar_pastores.php?success=edit');
                exit();
            } catch (PDOException $e) {
                $error = "Error al actualizar pastor: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Pastor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <h2>Editar Pastor</h2>
  <a href="gestionar_pastores.php" class="btn btn-secondary mb-3">← Volver a la lista</a>

  <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form action="" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
    <div class="mb-3">
      <label for="nombre_completo" class="form-label">Nombre completo *</label>
      <input type="text" id="nombre_completo" name="nombre_completo" class="form-control" required value="<?= htmlspecialchars($pastor['nombre_completo']) ?>">
    </div>

    <div class="mb-3">
      <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento *</label>
      <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required value="<?= htmlspecialchars($pastor['fecha_nacimiento']) ?>">
    </div>

    <div class="mb-3">
      <label for="tiempo_pastorado" class="form-label">Tiempo de pastorado *</label>
      <input type="text" id="tiempo_pastorado" name="tiempo_pastorado" class="form-control" required value="<?= htmlspecialchars($pastor['tiempo_pastorado']) ?>" placeholder="Ejemplo: 10 años">
    </div>

    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripción</label>
      <textarea id="descripcion" name="descripcion" rows="4" class="form-control"><?= htmlspecialchars($pastor['descripcion']) ?></textarea>
    </div>

    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen (dejar vacío para mantener actual)</label>
      <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*">
      <small class="form-text text-muted">Formatos permitidos: jpg, jpeg, png, gif. Máx 2MB.</small>
      <div class="mt-2">
        <img src="../../uploads/pastores/<?= htmlspecialchars($pastor['imagen']) ?>" alt="Imagen actual" style="height: 100px; object-fit: cover;">
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

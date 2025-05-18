<?php
require_once '../../config/auth.php';
require_once '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre_completo'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $tiempo_pastorado = $_POST['tiempo_pastorado'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    if (!$nombre || !$fecha_nacimiento || !$tiempo_pastorado) {
        $error = "Por favor completa todos los campos obligatorios.";
    } else {
        // Validar y subir imagen
        if (empty($_FILES['imagen']['name'])) {
            $error = "La imagen es obligatoria.";
        } else {
            $file = $_FILES['imagen'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

            if (!in_array($file['type'], $allowedTypes)) {
                $error = "Formato de imagen no válido. Solo jpg, jpeg, png, gif.";
            } elseif ($file['size'] > 2 * 1024 * 1024) {
                $error = "La imagen supera el tamaño máximo permitido (2MB).";
            } else {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $imagenNombre = 'pastor_' . time() . '.' . $ext;
                $destino = '../../uploads/pastores/' . $imagenNombre;

                if (!move_uploaded_file($file['tmp_name'], $destino)) {
                    $error = "Error al subir la imagen.";
                }
            }
        }

        if (!isset($error)) {
            try {
                $insertStmt = $pdo->prepare("INSERT INTO pastores (nombre_completo, fecha_nacimiento, tiempo_pastorado, descripcion, imagen) VALUES (?, ?, ?, ?, ?)");
                $insertStmt->execute([$nombre, $fecha_nacimiento, $tiempo_pastorado, $descripcion, $imagenNombre]);
                header('Location: gestionar_pastores.php?success=add');
                exit();
            } catch (PDOException $e) {
                $error = "Error al agregar pastor: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Pastor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <h2>Agregar Nuevo Pastor</h2>
  <a href="gestionar_pastores.php" class="btn btn-secondary mb-3">← Volver a la lista</a>

  <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form action="" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
    <div class="mb-3">
      <label for="nombre_completo" class="form-label">Nombre completo *</label>
      <input type="text" id="nombre_completo" name="nombre_completo" class="form-control" required value="<?= isset($nombre) ? htmlspecialchars($nombre) : '' ?>">
    </div>

    <div class="mb-3">
      <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento *</label>
      <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required value="<?= isset($fecha_nacimiento) ? htmlspecialchars($fecha_nacimiento) : '' ?>">
    </div>

    <div class="mb-3">
      <label for="tiempo_pastorado" class="form-label">Tiempo de pastorado *</label>
      <input type="text" id="tiempo_pastorado" name="tiempo_pastorado" class="form-control" required placeholder="Ejemplo: 10 años" value="<?= isset($tiempo_pastorado) ? htmlspecialchars($tiempo_pastorado) : '' ?>">
    </div>

    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripción</label>
      <textarea id="descripcion" name="descripcion" rows="4" class="form-control"><?= isset($descripcion) ? htmlspecialchars($descripcion) : '' ?></textarea>
    </div>

    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen *</label>
      <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*" required>
      <small class="form-text text-muted">Formatos permitidos: jpg, jpeg, png, gif. Máx 2MB.</small>
    </div>

    <button type="submit" class="btn btn-primary">Agregar Pastor</button>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

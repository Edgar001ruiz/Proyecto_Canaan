<?php
require_once '../../config/auth.php';
require_once '../../config/db.php';

function calcularEdad($fechaNacimiento) {
    $hoy = new DateTime();
    $nacimiento = new DateTime($fechaNacimiento);
    $edad = $hoy->diff($nacimiento);
    return $edad->y;
}

try {
    $stmt = $pdo->query("SELECT * FROM pastores ORDER BY id DESC");
    $pastores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener los pastores: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestionar Pastores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestión de Pastores</h2>
    <a href="agregar_pastor.php" class="btn btn-success">+ Agregar Pastor</a>
  </div>

  <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">¡Pastor agregado correctamente!</div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Edad</th>
          <th>Tiempo de pastorado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pastores as $pastor): ?>
          <tr>
            <td style="width: 120px;">
              <?php
                $rutaImagen = '../../uploads/pastores/' . htmlspecialchars($pastor['imagen']);
                $imagenValida = !empty($pastor['imagen']) && file_exists(__DIR__ . '/../../uploads/pastores/' . $pastor['imagen']);
              ?>
              <img src="<?= $imagenValida ? $rutaImagen : '../../uploads/pastores/default.png' ?>" 
                   alt="Imagen de pastor" 
                   class="img-fluid rounded" 
                   style="height: 80px; object-fit: cover;">
            </td>
            <td><?= htmlspecialchars($pastor['nombre_completo']) ?></td>
            <td><?= calcularEdad($pastor['fecha_nacimiento']) ?> años</td>
            <td><?= htmlspecialchars($pastor['tiempo_pastorado']) ?></td>
            <td>
              <a href="editar_pastor.php?id=<?= $pastor['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="eliminar_pastor.php?id=<?= $pastor['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este pastor?')">Eliminar</a>
              <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalPastor<?= $pastor['id'] ?>">Ver más</button>
            </td>
          </tr>

          <!-- Modal -->
          <div class="modal fade" id="modalPastor<?= $pastor['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $pastor['id'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel<?= $pastor['id'] ?>"><?= htmlspecialchars($pastor['nombre_completo']) ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                  <p><strong>Edad:</strong> <?= calcularEdad($pastor['fecha_nacimiento']) ?> años</p>
                  <p><strong>Tiempo de pastorado:</strong> <?= htmlspecialchars($pastor['tiempo_pastorado']) ?></p>
                  <p><strong>Descripción:</strong><br><?= nl2br(htmlspecialchars($pastor['descripcion'])) ?></p>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

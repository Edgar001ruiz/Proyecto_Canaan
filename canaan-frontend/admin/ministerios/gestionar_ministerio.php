<?php
require_once '../../config/auth.php';
require_once '../../config/db.php';

try {
    $stmt = $pdo->query("SELECT * FROM ministerios ORDER BY id DESC");
    $ministerios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener los ministerios: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestionar Ministerios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>📚 Gestión de Ministerios</h2>
    <div>
      <a href="../dashboard.php" class="btn btn-secondary me-2">← Volver al panel</a>
      <a href="agregar_ministerio.php" class="btn btn-success">+ Agregar Ministerio</a>
    </div>
  </div>

  <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">¡Ministerio agregado correctamente!</div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($ministerios as $ministerio): ?>
          <tr>
            <td style="width: 120px;">
  <?php
    $rutaImagen = '../../uploads/ministerios/' . htmlspecialchars($ministerio['imagen_url']);
    $imagenValida = !empty($ministerio['imagen_url']) && file_exists($rutaImagen);
  ?>
  <img src="<?= $imagenValida ? $rutaImagen : '../../uploads/ministerios/default.png' ?>" 
       alt="Imagen del ministerio" 
       class="img-fluid rounded" 
       style="height: 80px; object-fit: cover;">
</td>


            <td><?= htmlspecialchars($ministerio['nombre']) ?></td>
            <td><?= nl2br(htmlspecialchars($ministerio['descripcion'])) ?></td>
            <td>
              <a href="editar_ministerio.php?id=<?= $ministerio['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="eliminar_ministerio.php?id=<?= $ministerio['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este ministerio?')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

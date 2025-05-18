<?php
session_start();
require_once(__DIR__ . '/../../config/auth.php');
require_once(__DIR__ . '/../../config/db.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestionar Eventos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h1 class="mb-4">📅 Gestión de Eventos</h1>

    <?php if (isset($_GET['mensaje'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($_GET['mensaje']) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>


    <div class="mb-3">
      <a href="agregar_evento.php" class="btn btn-success">➕ Agregar evento</a>
    </div>

    <?php
    try {
      $stmt = $pdo->query("SELECT * FROM eventos ORDER BY fecha DESC");
      $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($eventos) > 0): ?>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="table-dark">
              <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Lugar</th>
                <th>Imagen</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($eventos as $evento): ?>
                <tr>
                  <td><?= htmlspecialchars($evento['titulo']) ?></td>
                  <td><?= htmlspecialchars($evento['descripcion']) ?></td>
                  <td><?= htmlspecialchars($evento['fecha']) ?></td>
                  <td><?= htmlspecialchars($evento['hora']) ?></td>
                  <td><?= htmlspecialchars($evento['lugar']) ?></td>
                  <td>
                    <?php if (!empty($evento['imagen'])): ?>
                    <img src="/Proyecto Canaan/canaan-frontend/uploads/eventos/<?php echo htmlspecialchars($evento['imagen']); ?>" alt="Imagen del evento" width="120">
                    <?php else: ?>
                      Sin imagen
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="editar_evento.php?id=<?= $evento['id'] ?>" class="btn btn-sm btn-primary">✏️ Editar</a>
                    <a href="eliminar_evento.php?id=<?= $evento['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este evento?')">🗑️ Eliminar</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p class="alert alert-info">No hay eventos registrados aún.</p>
      <?php endif;
    } catch (PDOException $e) {
      echo '<p class="alert alert-danger">Error al cargar los eventos: ' . $e->getMessage() . '</p>';
    }
    ?>

    <div class="mt-4">
      <a href="../dashboard.php" class="btn btn-secondary">⬅ Volver al panel</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
session_start();
require_once(__DIR__ . '/../../config/auth.php');
require_once(__DIR__ . '/../../config/db.php');

if (!isset($_GET['id'])) {
  die('ID de evento no proporcionado');
}

$id = $_GET['id'];

// Obtener datos del evento actual
$stmt = $pdo->prepare("SELECT * FROM eventos WHERE id = ?");
$stmt->execute([$id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
  die('Evento no encontrado');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Evento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4">✏️ Editar Evento</h2>

    <form action="procesar_editar_evento.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $evento['id'] ?>">

      <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control" value="<?= htmlspecialchars($evento['titulo']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" required><?= htmlspecialchars($evento['descripcion']) ?></textarea>
      </div>

      <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" value="<?= $evento['fecha'] ?>" required>
      </div>

      <div class="mb-3">
        <label for="hora" class="form-label">Hora</label>
        <input type="time" name="hora" id="hora" class="form-control" value="<?= $evento['hora'] ?>" required>
      </div>

      <div class="mb-3">
        <label for="lugar" class="form-label">Lugar</label>
        <input type="text" name="lugar" id="lugar" class="form-control" value="<?= htmlspecialchars($evento['lugar']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="imagen" class="form-label">Imagen (opcional)</label><br>
        <?php if ($evento['imagen']): ?>
          <img src="/Proyecto Canaan/uploads/eventos/<?= $evento['imagen'] ?>" width="100" class="mb-2"><br>
        <?php endif; ?>
        <input type="file" name="imagen" id="imagen" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary">💾 Guardar cambios</button>
      <a href="gestionar_evento.php" class="btn btn-secondary">⬅ Cancelar</a>
    </form>
  </div>
</body>
</html>

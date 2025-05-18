<?php
require_once(__DIR__ . '/../../config/auth.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Agregar Evento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>
<body class="bg-light">

  <div class="container py-5">
    <div class="card shadow rounded-4">
      <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">➕ Agregar Nuevo Evento</h4>
        <a href="gestionar_evento.php" class="btn btn-outline-light btn-sm">← Volver</a>
      </div>
      <div class="card-body">
        <form action="procesar_agregar_evento.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="titulo" class="form-label">Título del evento</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required />
          </div>

          <div class="row mb-4">
            <div class="col-md-6  ">
              <label for="fecha" class="form-label">Fecha</label>
              <input type="date" name="fecha" id="fecha" class="form-control" required />
            </div>
            <div class="col-md-6">
              <label for="hora" class="form-label">Hora</label>
              <input type="time" class="form-control" id="hora" name="hora" required>
            </div>

          </div>

          <div class="mb-3">
            <label for="lugar" class="form-label">Lugar</label>
            <input type="text" name="lugar" id="lugar" class="form-control" required />
          </div>

          <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" class="form-control" required></textarea>
          </div>

          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen del evento (opcional)</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" />
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-success btn-lg rounded-pill">Crear Evento</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  flatpickr("#hora", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "h:i K", // formato 12 horas con AM/PM
    time_24hr: false
  });
</script>


</body>
</html>

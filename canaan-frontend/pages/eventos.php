<?php
include('../components/header.php');
include('../config/db.php');

// Obtener eventos
$stmt = $pdo->query("SELECT * FROM eventos ORDER BY fecha ASC");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Función para traducir meses
function traducirMes($fecha) {
  $meses = [
    'January' => 'enero', 'February' => 'febrero', 'March' => 'marzo',
    'April' => 'abril', 'May' => 'mayo', 'June' => 'junio',
    'July' => 'julio', 'August' => 'agosto', 'September' => 'septiembre',
    'October' => 'octubre', 'November' => 'noviembre', 'December' => 'diciembre'
  ];
  
  $fechaFormateada = date('d F, Y', strtotime($fecha));
  return strtr($fechaFormateada, $meses);
}
?>

<section class="py-5 text-center" style="background-color: #004987;">
  <div class="container text-white">
    <h2 class="mb-4 text-warning">Eventos Próximos</h2>
    <p>Estos son los eventos que se aproximan en nuestra iglesia. ¡Estás cordialmente invitado!</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      <?php foreach ($eventos as $evento): ?>
        <div class="col">
          <div class="card h-100 border-0 shadow-sm">
            <img src="../uploads/eventos/<?= htmlspecialchars($evento['imagen']) ?>" class="card-img-top" alt="Imagen del evento" style="height: 180px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-primary"><?= htmlspecialchars($evento['titulo']) ?></h5>
              <p class="card-text small"><?= htmlspecialchars($evento['descripcion']) ?></p>
              <p class="text-muted small mb-0"><strong>📅 Fecha:</strong> <?= traducirMes($evento['fecha']) ?></p>
              <p class="text-muted small mb-0"><strong>🕒 Hora:</strong> <?= date('h:i A', strtotime($evento['hora'])) ?></p>
              <p class="text-muted small"><strong>📍 Lugar:</strong> <?= htmlspecialchars($evento['lugar']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include('../components/footer.php'); ?>

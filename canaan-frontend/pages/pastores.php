<?php 
include('../components/header.php');
require_once(__DIR__ . '/../config/db.php');

try {
    $stmt = $pdo->query("SELECT * FROM pastores ORDER BY nombre_completo ASC");
    $pastores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error al obtener pastores: " . $e->getMessage());
}

function calcularEdad($fechaNacimiento) {
    $fechaNac = new DateTime($fechaNacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fechaNac);
    return $edad->y;
}
?>

<section class="py-5 text-center" style="background-color: #004987;">
  <div class="container text-white">
    <h2 class="text-warning">Nuestros Pastores</h2>
    <p class="lead">Conoce a quienes guían espiritualmente nuestra congregación.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      <?php foreach ($pastores as $pastor): ?>
        <div class="col">
          <div class="card h-100 shadow-sm border-0 text-center">
            <?php 
              $rutaImagen = __DIR__ . '/../uploads/pastores/' . $pastor['imagen'];
              $rutaWebImagen = '../uploads/pastores/' . htmlspecialchars($pastor['imagen']);
              if (!empty($pastor['imagen']) && file_exists($rutaImagen)) {
                echo '<img src="' . $rutaWebImagen . '" class="card-img-top" alt="Imagen de ' . htmlspecialchars($pastor['nombre_completo']) . '">';
              } else {
                echo '<img src="../uploads/pastores/default.png" class="card-img-top" alt="Imagen por defecto">';
              }
            ?>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-primary"><?php echo htmlspecialchars($pastor['nombre_completo']); ?></h5>
              <button type="button" class="btn btn-warning mt-auto" data-bs-toggle="modal" data-bs-target="#modalPastor<?php echo $pastor['id']; ?>">
                Ver más información
              </button>
            </div>
          </div>
        </div>

        <!-- Modal con info ampliada -->
        <div class="modal fade" id="modalPastor<?php echo $pastor['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $pastor['id']; ?>" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel<?php echo $pastor['id']; ?>"><?php echo htmlspecialchars($pastor['nombre_completo']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body text-start">
                <p><strong>Descripción:</strong></p>
                <p><?php echo nl2br(htmlspecialchars($pastor['descripcion'])); ?></p>
                <p><strong>Tiempo de pastorado:</strong> <?php echo htmlspecialchars($pastor['tiempo_pastorado']); ?></p>
                <p><strong>Edad:</strong> <?php echo calcularEdad($pastor['fecha_nacimiento']); ?> años</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include('../components/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


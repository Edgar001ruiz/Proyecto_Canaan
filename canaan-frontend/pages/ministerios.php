<?php
require_once '../config/db.php';
include('../components/header.php');

try {
    $stmt = $pdo->query("SELECT * FROM ministerios ORDER BY id DESC");
    $ministerios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener los ministerios: " . $e->getMessage());
}
?>

<section class="py-5 text-center" style="background-color: #00263e;">
  <div class="container text-white">
    <h2 class="text-warning display-5 fw-bold">Nuestros Ministerios</h2>
    <p class="lead">Conoce cada uno de los ministerios que forman parte de la iglesia Canaán.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">

    <?php foreach ($ministerios as $index => $ministerio): ?>
      <?php
        $rutaImagen = '../uploads/ministerios/' . htmlspecialchars($ministerio['imagen_url']);
        $ordenReverso = $index % 2 !== 0;
      ?>

      <div class="card mb-5 shadow rounded-4 border-0 overflow-hidden">
        <div class="row g-0">
          <?php if (!$ordenReverso): ?>
            <div class="col-md-6">
              <img src="<?= $rutaImagen ?>" class="d-block w-100 h-100 object-fit-cover" alt="<?= htmlspecialchars($ministerio['nombre']) ?>">
            </div>
            <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
              <h3 class="text-primary fw-bold mb-3"><?= htmlspecialchars($ministerio['nombre']) ?></h3>
              <p class="mb-0"><?= nl2br(htmlspecialchars($ministerio['descripcion'])) ?></p>
            </div>
          <?php else: ?>
            <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
              <h3 class="text-primary fw-bold mb-3"><?= htmlspecialchars($ministerio['nombre']) ?></h3>
              <p class="mb-0"><?= nl2br(htmlspecialchars($ministerio['descripcion'])) ?></p>
            </div>
            <div class="col-md-6">
              <img src="<?= $rutaImagen ?>" class="d-block w-100 h-100 object-fit-cover" alt="<?= htmlspecialchars($ministerio['nombre']) ?>">
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>

<?php include('../components/footer.php'); ?>

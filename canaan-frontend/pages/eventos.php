<?php include('../components/header.php'); ?>

<section class="py-5 text-center" style="background-color: #004987;">
  <div class="container text-white">
    <h2 class="mb-4 text-warning">Eventos Próximos</h2>
    <p>Estos son los eventos que se aproximan en nuestra iglesia. ¡Estás cordialmente invitado!</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      <!-- Evento 1 -->
      <div class="col">
        <div class="card h-100 border-0 shadow-sm">
          <img src="../assets/img/evento1.png" class="card-img-top" alt="Evento 1" style="height: 180px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-primary">Aniversario</h5>
            <p class="card-text small">No faltes a nuestro segúndo día de celebración de nuestro aniversario 43, ¡Te esperamos!</p>
            <p class="text-muted small mb-2"><strong>Fecha:</strong> 26 de abril, 2025</p>
            <a href="#" class="btn btn-warning mt-auto btn-sm">Ver más</a>
          </div>
        </div>
      </div>

      <!-- Evento 2 -->
      <div class="col">
        <div class="card h-100 border-0 shadow-sm">
          <img src="../assets/img/evento2.png" class="card-img-top" alt="Evento 2" style="height: 180px; object-fit: cover;">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-primary">Celebración de Aniversario</h5>
            <p class="card-text small">Ultimo día de celebración de nuestro aniversario 43, ¡Te esperamos!</p>
            <p class="text-muted small mb-2"><strong>Fecha:</strong> 27 de abril, 2025</p>
            <a href="#" class="btn btn-warning mt-auto btn-sm">Ver más</a>
          </div>
        </div>
      </div>

      <!-- Más eventos aquí -->
    </div>
  </div>
</section>

<?php include('../components/footer.php'); ?>

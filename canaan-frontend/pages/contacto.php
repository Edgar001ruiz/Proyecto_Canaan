<?php include('../components/header.php'); ?>

<!-- Banner superior -->
<section class="py-5 text-center" style="background-color: #004987;">
  <div class="container text-white">
    <h2 class="text-warning">Contáctanos</h2>
    <p class="lead">Estamos aquí para servirte y responder a tus preguntas.</p>
  </div>
</section>

<!-- Contacto con texto + mapa lado a lado -->
<section class="bg-light py-5" id="contacto">
  <div class="container">
    <h2 class="text-center text-primary mb-5">Contáctanos</h2>
    <div class="row align-items-center">
      
      <!-- Columna: Información de contacto -->
      <div class="col-md-6 mb-4 mb-md-0">
        <h4 class="text-dark">Iglesia Canaán Central</h4>
        <p class="mb-2">
          <i class="bi bi-geo-alt-fill text-primary me-2"></i>
          Calle antigua a Tonacatepeque, frente al polideportivo España, Soyapango
        </p>
        <p>
          <i class="bi bi-telephone-fill text-primary me-2"></i>
          +503 2292 9551
        </p>
        <p>
          <i class="bi bi-envelope-fill text-primary me-2"></i>
          info.canaancentral@gmail.com
        </p>
        <p>
          <i class="bi bi-facebook text-primary me-2"></i>
          <a href="https://www.facebook.com/iglesiacanaancentral" target="_blank" class="text-decoration-none">Facebook</a>
        </p>

        <a href="https://wa.me/50322929551" class="btn btn-success mt-3">
          <i class="bi bi-whatsapp me-2"></i> Escríbenos por WhatsApp
        </a>
      </div>

      <!-- Columna: Mapa -->
      <div class="col-md-6">
        <div class="ratio ratio-4x3 rounded shadow-sm">
          <iframe 
            src="https://www.google.com/maps?q=Ministerio+Cristiano+Canaán+A.D.,+Soyapango,+El+Salvador&output=embed"
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include('../components/footer.php'); ?>

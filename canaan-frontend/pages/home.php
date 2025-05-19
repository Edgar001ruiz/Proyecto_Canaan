<?php include('../components/header.php'); ?>

<!-- Sección de bienvenida -->
<section class="bg-dark text-white text-center py-4">
  <div class="container">
    <h1 class="display-5 text-warning">Bienvenido a Iglesia Canaán Central</h1>
    <p class="lead">"Una iglesia que transforma vidas"</p>
  </div>
</section>

<!-- Video resumen -->
<section class="bg-light py-5 text-center">
  <div class="container">
    <h2 class="mb-4 text-primary">Resumen de todo lo que hacemos</h2>

    <!-- Versión grande -->
    <div class="ratio ratio-16x9 d-none d-md-block mx-auto" style="max-width: 700px;">
      <iframe src="https://www.youtube.com/embed/D0O7Ppy9Eng"
              title="Video resumen"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen></iframe>
    </div>

    <!-- Alternativa móvil -->
    <div class="d-block d-md-none mt-3">
      <a href="https://www.youtube.com/watch?v=D0O7Ppy9Eng" target="_blank">
        <img src="https://img.youtube.com/vi/D0O7Ppy9Eng/hqdefault.jpg"
             class="img-fluid rounded shadow"
             alt="Video resumen">
        <div class="mt-2">
          <button class="btn btn-primary">Ver video en YouTube</button>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- Quiénes somos -->
<section class="py-4 text-white text-center" style="background-color: #004987;">
  <div class="container">
    <h2 class="mb-4">¿Quiénes somos?</h2>
    <p class="lead">Somos una comunidad cristiana apasionada por servir, transformar y discipular vidas para el Reino de Dios.</p>
  </div>
</section>

<!-- Nuestra congregación, metas, misión y visión -->
<section class="py-5 bg-white text-center">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-6">
        <h3 class="text-primary">Nuestra Congregación</h3>
        <p>Una iglesia activa, con cultos, células y ministerios comprometidos con la obra de Dios.</p>
      </div>
      <div class="col-md-6">
        <h3 class="text-primary">Nuestras Metas</h3>
        <p>Evangelizar, capacitar y apoyar espiritualmente a cada miembro de la comunidad.</p>
      </div>
      <div class="col-md-6">
        <h3 class="text-primary">Misión</h3>
        <p>Ser el instrumento por el cual el Espíritu Santo transforme la vida del ser humano a través de la palabra. Discipulando y consolidando.</p>
      </div>
      <div class="col-md-6">
        <h3 class="text-primary">Visión</h3>
        <p>Ser un modelo de iglesia en predicar, doctrinar, amar y anunciar el evangelio.</p>
      </div>
    </div>
  </div>
</section>

<?php include('../components/footer.php'); ?>

<?php include('../components/header.php'); ?>

<section class="py-5 text-center" style="background-color: #00263e;">
  <div class="container text-white">
    <h2 class="text-warning">Nuestros Ministerios</h2>
    <p class="lead">Conoce cada uno de los ministerios que forman parte de la iglesia Canaán.</p>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">

    <!-- Ministerio 1 -->
    <div class="mb-5">
      <h4 class="text-primary">Ministerio de Alabanza</h4>
      <p>Responsables de dirigir la adoración durante los cultos. Inspiran a la congregación a conectarse con Dios a través de la música.</p>
      
      <div id="carruselAlabanza1" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner rounded overflow-hidden" style="max-height: 400px;">
          <div class="carousel-item active">
            <img src="../assets/img/alabanza.jpg" class="d-block w-100 object-fit-cover" alt="Alabanza 1">
          </div>
          <div class="carousel-item">
            <img src="../assets/img/alabanza.jpg" class="d-block w-100 object-fit-cover" alt="Alabanza 2">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carruselAlabanza1" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carruselAlabanza1" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>

    <!-- Ministerio 2 -->
    <div class="mb-5">
      <h4 class="text-primary">Ministerio de Evangelismo</h4>
      <p>Encargados de llevar el mensaje del evangelio a la comunidad, apoyando con actividades, oraciones y visitas.</p>
      
      <div id="carruselEvangelismo" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner rounded overflow-hidden" style="max-height: 400px;">
          <div class="carousel-item active">
            <img src="../assets/img/cuanti.png" class="d-block w-100 object-fit-cover" alt="Evangelismo 1">
          </div>
          <div class="carousel-item">
            <img src="../assets/img/alabanza.jpg" class="d-block w-100 object-fit-cover" alt="Evangelismo 2">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carruselEvangelismo" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carruselEvangelismo" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>

  </div>
</section>

<?php include('../components/footer.php'); ?>

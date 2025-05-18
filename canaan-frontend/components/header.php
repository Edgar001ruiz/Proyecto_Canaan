<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iglesia Canaán Central</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #00263e;">
  <div class="container">
    
    <!-- Logo y nombre -->
    <img src="../assets/img/logo canaan_angeles.png" style="width: 35px;" alt="logo canaan">
    <a class="navbar-brand text-warning ms-2" href="home.php">Canaán Central</a>

    <!-- Botón de colapso para móviles -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido colapsable -->
    <div class="collapse navbar-collapse justify-content-between" id="menu">
      
      <!-- Buscador centrado -->
      <form class="d-flex mx-auto" style="width: 40%;">
  <input class="form-control me-2" 
         type="search" 
         placeholder="Buscar" 
         aria-label="Buscar"
         style="background-color:rgb(254, 254, 255); color: #00263e; border-color:rgb(151, 214, 255);">
  
  <button class="btn" 
          type="submit"
          style="background-color: #ffc107; color: #00263e; border-color: #00263e;">
    Buscar
  </button>
</form>

      <!-- Menú de navegación -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link text-white" href="eventos.php">Eventos</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="sermones.php">Sermones</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="ministerios.php">Ministerios</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="pastores.php">Pastores</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="predicaciones.php">Predicaciones</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="contacto.php">Contacto</a></li>
      </ul>

    </div>
  </div>
</nav>


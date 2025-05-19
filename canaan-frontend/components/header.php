<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iglesia Canaán Central </title>
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

   

    <!-- Contenido colapsable -->
    <div class="collapse navbar-collapse justify-content-between" id="menu">
         <!-- Buscador centrado -->
     <form class="d-flex mx-auto position-relative" style="width: 60%;" id="searchForm">
        <input class="form-control me-2 w-100" 
               type="search" 
               name="q"
               id="searchInput"
               placeholder="Buscar"
               aria-label="Buscar"
               style="background-color: rgb(254, 254, 255); color: #00263e; border-color: rgb(25, 144, 223);">
        
        <button class="btn" 
                type="submit"
                style="background-color: #ffc107; color: #00263e; border-color: #00263e;">
          Buscar
        </button>
        <div id="searchResults" class="position-absolute w-100 mt-1 d-none" style="top: 100%; z-index: 1000;"></div>
     </form>

     <ul>
     </ul>

     <!-- Script para la búsqueda -->
     <script>
     document.getElementById('searchForm').addEventListener('submit', function(e) {
         e.preventDefault();
         performSearch();
     });

     document.getElementById('searchInput').addEventListener('input', function() {
         if (this.value.length >= 2) {
             performSearch();
         } else {
             document.getElementById('searchResults').classList.add('d-none');
         }
     });

     function performSearch() {
         const searchTerm = document.getElementById('searchInput').value;
         const resultsDiv = document.getElementById('searchResults');
         
         if (searchTerm.length < 2) return;

         fetch('../../components/search.php?q=' + encodeURIComponent(searchTerm))
             .then(response => response.text())
             .then(data => {
                 resultsDiv.innerHTML = data;
                 resultsDiv.classList.remove('d-none');
             })
             .catch(error => {
                 console.error('Error:', error);
                 resultsDiv.innerHTML = '<div class="alert alert-danger">Error al realizar la búsqueda</div>';
                 resultsDiv.classList.remove('d-none');
             });
     }

     // Cerrar resultados al hacer clic fuera
     document.addEventListener('click', function(e) {
         const searchResults = document.getElementById('searchResults');
         const searchForm = document.getElementById('searchForm');
         
         if (!searchForm.contains(e.target)) {
             searchResults.classList.add('d-none');
         }
     });
     </script>
 <ul class="navbar-nav ms-auto d-flex align-items-center gap-3">

        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="eventos.php">
            <i class="bi bi-calendar3 me-1"></i> Eventos
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="sermones.php">
            <i class="bi bi-journal-text me-1"></i> Sermones
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="ministerios.php">
            <i class="bi bi-house-fill me-1"></i> Ministerios
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="pastores.php">
            <i class="bi bi-person-lines-fill me-1"></i> Pastores
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="predicaciones.php">
            <i class="bi bi-journal-text me-1"></i> Predicaciones
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="contacto.php">
            <i class="bi bi-telephone-fill me-1"></i> Contacto
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white d-flex align-items-center" href="login.php">
            <i class="bi bi-person-fill me-1"></i>Login
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>


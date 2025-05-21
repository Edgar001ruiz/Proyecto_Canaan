<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Footer Fijo Adaptativo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    /* Para pantallas grandes: sticky footer */
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    main {
      flex: 1;
    }

    /* Para pantallas pequeñas: footer fijo */
    @media (max-width: 768px) {
      footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 999;
      }
    }
  </style>
</head>
<body>

  <main>
    <!-- Aquí va tu contenido principal -->
  </main>

  <!-- Footer -->
  <footer class="bg-dark text-light py-3">
    <div class="container text-center">
      <div class="mb-2">
        <a href="https://www.facebook.com/iglesiacanaancentral" target="_blank" class="text-light me-3">
          <i class="bi bi-facebook mb-0 small"> Facebook</i>
        </a>
        <a href="https://wa.me/50370112233" target="_blank" class="text-light me-3">
          <i class="bi bi-whatsapp mb-0 small"> WhatsApp</i>
        </a>
        <a href="mailto:contacto@iglesiacanaan.org" class="text-light">
          <i class="bi bi-envelope-fill mb-0 small"> Email</i>
        </a>
      </div>
      <p class="mb-0 small">&copy; 2025 Iglesia Canaán Central. Todos los derechos reservados.</p>
    </div>
  </footer>

</body>
</html>

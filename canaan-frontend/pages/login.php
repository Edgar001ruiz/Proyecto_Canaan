<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Iglesia Canaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>    <div style="background-color: #00263e;" class="py-4 mb-4">
        <div class="container">
            <h1 class="text-white text-center m-0">Iglesia Canaan</h1>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: calc(100vh - 140px);">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <img src="../assets/img/logo canaan_angeles.png" alt="Logo Iglesia Canaan" class="img-fluid mb-4" style="max-width: 200px;">
                            <h2 class="text-primary mb-3">Iniciar Sesión</h2>
                        </div>
                        
                        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                            <div class="alert alert-danger" role="alert">
                                Usuario o contraseña incorrectos
                            </div>
                        <?php endif; ?>

                        <form action="../admin/login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Ingresar</button>
                            </div>
                        </form><br>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-danger btn-lg"><a class="links" href="home.php">Regresar</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include_once('../components/footer.php');
?>

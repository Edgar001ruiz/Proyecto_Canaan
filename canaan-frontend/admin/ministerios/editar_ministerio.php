<?php
require_once(__DIR__ . '/../../config/auth.php');
require_once(__DIR__ . '/../../config/db.php');

if (!isset($_GET['id'])) {
    header("Location: gestionar_ministerio.php");
    exit;
}

$id = intval($_GET['id']);

// Obtener los datos actuales del ministerio
$stmt = $pdo->prepare("SELECT * FROM ministerios WHERE id = ?");
$stmt->execute([$id]);
$ministerio = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ministerio) {
    die("Ministerio no encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagenNueva = $_FILES['imagen']['name'];

    $directorio = __DIR__ . '/../../uploads/ministerios/';
    $nuevaImagenUrl = $ministerio['imagen_url'];

    // Verificar si se subió una nueva imagen
    if (!empty($imagenNueva) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Eliminar imagen anterior si existe
        if (!empty($ministerio['imagen_url'])) {
            $rutaAnterior = $directorio . $ministerio['imagen_url'];
            if (file_exists($rutaAnterior)) {
                unlink($rutaAnterior);
            }
        }

        // Guardar nueva imagen
        $nombreArchivo = uniqid() . '_' . basename($_FILES['imagen']['name']);
        $rutaDestino = $directorio . $nombreArchivo;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            $nuevaImagenUrl = $nombreArchivo;
        }
    }

    // Actualizar los datos
    $stmt = $pdo->prepare("UPDATE ministerios SET nombre = ?, descripcion = ?, imagen_url = ? WHERE id = ?");
    $stmt->execute([$nombre, $descripcion, $nuevaImagenUrl, $id]);

    header("Location: gestionar_ministerio.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Ministerio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Editar Ministerio</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Ministerio</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($ministerio['nombre']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?= htmlspecialchars($ministerio['descripcion']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen (opcional)</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                    <?php if (!empty($ministerio['imagen_url'])): ?>
                        <div class="mt-2">
                            <small>Imagen actual:</small><br>
                            <img src="../../uploads/ministerios/<?= htmlspecialchars($ministerio['imagen_url']) ?>" alt="Imagen actual" style="max-width: 100%; height: auto;">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="gestionar_ministerio.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>

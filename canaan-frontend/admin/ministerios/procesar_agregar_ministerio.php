<?php
require_once(__DIR__ . '/../../config/auth.php');
require_once(__DIR__ . '/../../config/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $imagen_url = null;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $rutaBase = __DIR__ . '/../../uploads/ministerios/';
        if (!is_dir($rutaBase)) {
            mkdir($rutaBase, 0777, true);
        }

        $nombreOriginal = basename($_FILES['imagen']['name']);
        $nombreUnico = uniqid() . '_' . $nombreOriginal;
        $rutaDestino = $rutaBase . $nombreUnico;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            // ✅ Solo guardamos el nombre del archivo
            $imagen_url = $nombreUnico;
        }
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO ministerios (nombre, descripcion, imagen_url) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $descripcion, $imagen_url]);

        header("Location: gestionar_ministerio.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al agregar ministerio: " . $e->getMessage();
    }
} else {
    echo "Acceso no autorizado.";
}
?>

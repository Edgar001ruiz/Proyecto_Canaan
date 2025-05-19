<?php
require_once(__DIR__ . '/../../config/auth.php');
require_once(__DIR__ . '/../../config/db.php');

if (!isset($_GET['id'])) {
    header("Location: gestionar_ministerio.php");
    exit;
}

$id = intval($_GET['id']);

try {
    // Obtener el nombre del archivo de imagen para eliminarlo físicamente
    $stmt = $pdo->prepare("SELECT imagen_url FROM ministerios WHERE id = ?");
    $stmt->execute([$id]);
    $ministerio = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($ministerio && !empty($ministerio['imagen_url'])) {
        $imagenPath = __DIR__ . '/../../uploads/ministerios/' . $ministerio['imagen_url'];
        if (file_exists($imagenPath)) {
            unlink($imagenPath); // Eliminar imagen del sistema
        }
    }

    // Eliminar ministerio
    $stmt = $pdo->prepare("DELETE FROM ministerios WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: gestionar_ministerio.php");
    exit;
} catch (PDOException $e) {
    die("Error al eliminar ministerio: " . $e->getMessage());
}

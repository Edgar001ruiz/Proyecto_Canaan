<?php
require_once '../../config/auth.php';
require_once '../../config/db.php';

if (!isset($_GET['id'])) {
    header('Location: gestionar_pastores.php');
    exit();
}

$id = intval($_GET['id']);

try {
    // Obtener la imagen para borrar archivo físico
    $stmt = $pdo->prepare("SELECT imagen FROM pastores WHERE id = ?");
    $stmt->execute([$id]);
    $pastor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($pastor) {
        $imagenPath = '../../uploads/pastores/' . $pastor['imagen'];
        if (file_exists($imagenPath)) {
            unlink($imagenPath);
        }

        // Eliminar el registro
        $deleteStmt = $pdo->prepare("DELETE FROM pastores WHERE id = ?");
        $deleteStmt->execute([$id]);
    }

    header('Location: gestionar_pastores.php?success=delete');
    exit();

} catch (PDOException $e) {
    die("Error al eliminar pastor: " . $e->getMessage());
}
?>

<?php
session_start();
require_once(__DIR__ . '/../../config/db.php');
require_once(__DIR__ . '/../../config/auth.php');

if (!isset($_GET['id'])) {
    header("Location: listar_admins.php");
    exit;
}

$id = intval($_GET['id']);

try {
    $stmt = $pdo->prepare("DELETE FROM administradores WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: listar_admins.php?success=Administrador eliminado correctamente");
    exit;

} catch (PDOException $e) {
    header("Location: listar_admins.php?error=Error al eliminar: " . urlencode($e->getMessage()));
    exit;
}

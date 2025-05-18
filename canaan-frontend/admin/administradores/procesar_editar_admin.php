<?php
session_start();
require_once(__DIR__ . '/../../config/db.php');
require_once(__DIR__ . '/../../config/auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username)) {
        header("Location: editar_admin.php?id=$id&error=El usuario es obligatorio");
        exit;
    }

    try {
        if (!empty($password)) {
            // Actualizar usuario y contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE administradores SET username = ?, password = ? WHERE id = ?");
            $stmt->execute([$username, $hashedPassword, $id]);
        } else {
            // Actualizar solo usuario
            $stmt = $pdo->prepare("UPDATE administradores SET username = ? WHERE id = ?");
            $stmt->execute([$username, $id]);
        }

        header("Location: listar_admins.php?success=Administrador actualizado correctamente");
        exit;
    } catch (PDOException $e) {
        header("Location: editar_admin.php?id=$id&error=Error al actualizar: " . urlencode($e->getMessage()));
        exit;
    }
} else {
    header('Location: listar_admins.php');
    exit;
}

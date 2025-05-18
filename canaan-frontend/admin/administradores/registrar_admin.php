<?php
session_start();

require_once(__DIR__ . '/../../config/db.php');
require_once(__DIR__ . '/../../config/auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validar datos básicos
    if (empty($username) || empty($password)) {
        header("Location: crear_admin.php?error=Datos incompletos");
        exit;
    }

    // Hashear contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO administradores (username, password, rol) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hashedPassword, 'administrador']);

        header("Location: crear_admin.php?success=Administrador creado");
        exit;
    } catch (PDOException $e) {
        header("Location: crear_admin.php?error=Error al crear administrador");
        exit;
    }
} else {
    header("Location: crear_admin.php");
    exit;
}
?>

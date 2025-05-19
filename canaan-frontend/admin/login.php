<?php
session_start();
require_once(__DIR__ . '/../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        // Comparación sensible a mayúsculas con BINARY
        $stmt = $pdo->prepare("SELECT * FROM administradores WHERE BINARY username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_role'] = $admin['role'];

            header('Location: dashboard.php');
            exit();
        } else {
            header('Location: ../pages/login.php?error=1');
            exit();
        }
    } catch (PDOException $e) {
        header('Location: ../pages/login.php?error=1');
        exit();
    }
}
?>

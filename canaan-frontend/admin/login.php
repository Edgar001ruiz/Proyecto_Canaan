<?php
session_start();

require_once(__DIR__ . '/../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $stmt = $pdo->prepare("SELECT * FROM administradores WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin['password'])) {
            // Guardar datos en sesión
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_role'] = $admin['role']; // <<--- ESTA LÍNEA ES IMPORTANTE

            header('Location: ../admin/dashboard.php');
            exit();
        } else {
            echo "Credenciales incorrectas.";
        }
    } catch (PDOException $e) {
        echo "Error al intentar iniciar sesión: " . $e->getMessage();
    }
}
?>

<?php
require_once(__DIR__ . '/../../config/auth.php');
require_once(__DIR__ . '/../../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $lugar = trim($_POST['lugar']);
    $descripcion = trim($_POST['descripcion']);

    // Procesar imagen (si se subió)
    $imagen_nombre = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $directorio_destino = __DIR__ . '/../../uploads/eventos/';
        if (!is_dir($directorio_destino)) {
            mkdir($directorio_destino, 0777, true); // Crear carpeta si no existe
        
        }

        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $imagen_nombre = uniqid('evento_') . '.' . $extension;
        $ruta_destino = $directorio_destino . $imagen_nombre;

        if (!move_uploaded_file($imagen_tmp, $ruta_destino)) {
            die("Error al subir la imagen.");
        }
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO eventos (titulo, fecha, hora, lugar, descripcion, imagen)
                               VALUES (:titulo, :fecha, :hora, :lugar, :descripcion, :imagen)");
        $stmt->execute([
            ':titulo' => $titulo,
            ':fecha' => $fecha,
            ':hora' => $hora,
            ':lugar' => $lugar,
            ':descripcion' => $descripcion,
            ':imagen' => $imagen_nombre
        ]);

        header("Location: gestionar_evento.php?mensaje= Evento creado con éxito");
        exit;
    } catch (PDOException $e) {
        echo "Error al guardar evento: " . $e->getMessage();
    }
} else {
    header("Location: agregar_evento.php");
    exit;
}

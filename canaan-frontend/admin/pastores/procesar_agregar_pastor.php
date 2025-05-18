<?php
require_once '../../config/auth.php';
require_once '../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre_completo'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $tiempo_pastorado = $_POST['tiempo_pastorado'];
    $descripcion = $_POST['descripcion'];

    // Validar y subir imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $imagenNombre = basename($_FILES['imagen']['name']);
        $rutaDestino = '../../../uploads/pastores/' . $imagenNombre;

        // Asegurarse de que no se sobrescriban archivos
        $contador = 1;
        $nombreSinExtension = pathinfo($imagenNombre, PATHINFO_FILENAME);
        $extension = pathinfo($imagenNombre, PATHINFO_EXTENSION);
        while (file_exists($rutaDestino)) {
            $imagenNombre = $nombreSinExtension . '_' . $contador . '.' . $extension;
            $rutaDestino = '../../../uploads/pastores/' . $imagenNombre;
            $contador++;
        }

        if (move_uploaded_file($imagenTmp, $rutaDestino)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO pastores 
                    (nombre_completo, fecha_nacimiento, tiempo_pastorado, descripcion, imagen) 
                    VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$nombre, $fecha_nacimiento, $tiempo_pastorado, $descripcion, $imagenNombre]);

                header('Location: gestionar_pastores.php?success=1');
                exit();
            } catch (PDOException $e) {
                die("Error al guardar en la base de datos: " . $e->getMessage());
            }
        } else {
            die("Error al subir la imagen.");
        }
    } else {
        die("Imagen no válida.");
    }
} else {
    header('Location: agregar_pastor.php');
    exit();
}

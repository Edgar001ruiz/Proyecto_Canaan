<?php
require_once(__DIR__ . '/../../config/auth.php');
require_once(__DIR__ . '/../../config/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $descripcion = $_POST['descripcion'];

  try {
    // Actualizar datos principales del ministerio
    $stmt = $pdo->prepare("UPDATE ministerios SET nombre = ?, descripcion = ? WHERE id = ?");
    $stmt->execute([$nombre, $descripcion, $id]);

    // Subir nuevas imágenes si se agregaron
    if (!empty($_FILES['imagenes']['name'][0])) {
      $rutaBase = 'uploads/ministerios/';
      if (!is_dir(__DIR__ . '/../../' . $rutaBase)) {
        mkdir(__DIR__ . '/../../' . $rutaBase, 0777, true);
      }

      foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) {
        $nombreArchivo = basename($_FILES['imagenes']['name'][$key]);
        $rutaDestino = $rutaBase . uniqid() . '_' . $nombreArchivo;

        if (move_uploaded_file($tmp_name, __DIR__ . '/../../' . $rutaDestino)) {
          $pdo->prepare("INSERT INTO ministerio_imagenes (ministerio_id, imagen_url) VALUES (?, ?)")
              ->execute([$id, $rutaDestino]);
        }
      }
    }

    header("Location: gestionar_ministerio.php");
    exit();
  } catch (PDOException $e) {
    echo "Error al editar ministerio: " . $e->getMessage();
  }
} else {
  echo "Acceso no autorizado.";
}
?>

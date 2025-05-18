<?php
session_start();
require_once(__DIR__ . '/../../config/auth.php');
require_once(__DIR__ . '/../../config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $fecha = $_POST['fecha'];
  $hora = $_POST['hora'];
  $lugar = $_POST['lugar'];

  // Obtener imagen actual para eliminar si se cambia
  $stmt = $pdo->prepare("SELECT imagen FROM eventos WHERE id = ?");
  $stmt->execute([$id]);
  $evento = $stmt->fetch(PDO::FETCH_ASSOC);

  $nombreImagen = $evento['imagen']; // Por defecto se mantiene

  // Procesar nueva imagen si se subió
  if (!empty($_FILES['imagen']['name'])) {
    $carpetaDestino = __DIR__ . '/../../uploads/eventos/';
    
    // Eliminar imagen anterior si existe
    if (!empty($nombreImagen) && file_exists($carpetaDestino . $nombreImagen)) {
      unlink($carpetaDestino . $nombreImagen);
    }

    // Guardar nueva imagen
    $nombreImagen = uniqid() . '_' . basename($_FILES['imagen']['name']);
    $rutaCompleta = $carpetaDestino . $nombreImagen;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaCompleta);
  }

  // Actualizar evento
  $stmt = $pdo->prepare("UPDATE eventos SET titulo = ?, descripcion = ?, fecha = ?, hora = ?, lugar = ?, imagen = ? WHERE id = ?");
  $stmt->execute([$titulo, $descripcion, $fecha, $hora, $lugar, $nombreImagen, $id]);

header('Location: gestionar_evento.php?mensaje=Evento actualizado con éxito');
  exit;
} else {
  echo "Acceso no permitido.";
}

<?php
session_start();
require_once(__DIR__ . '/../../config/auth.php');
require_once(__DIR__ . '/../../config/db.php');

if (!isset($_GET['id'])) {
  die('ID no proporcionado');
}

$id = $_GET['id'];

// Primero se elimina la imagen asociada (si existe)
$stmt = $pdo->prepare("SELECT imagen FROM eventos WHERE id = ?");
$stmt->execute([$id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if ($evento && !empty($evento['imagen'])) {
  $rutaImagen = __DIR__ . '/../../uploads/eventos/' . $evento['imagen'];
  if (file_exists($rutaImagen)) {
    unlink($rutaImagen); // Elimina el archivo
  }
}

// Luego se elimina el evento de la base de datos
$stmt = $pdo->prepare("DELETE FROM eventos WHERE id = ?");
$stmt->execute([$id]);

header('Location: gestionar_evento.php?mensaje=Evento eliminado con éxito');
exit;


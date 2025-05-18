<?php
$host = 'localhost';
$db = 'canaan_db';
$user = 'root';
$pass = '';

try {
$pdo = new PDO("mysql:host=$host;port=3307;dbname=$db;charset=utf8", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error en la conexión: " . $e->getMessage());
}
?>

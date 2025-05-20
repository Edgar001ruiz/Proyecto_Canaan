<?php
$host = getenv('MYSQL_HOST') ?: 'localhost';
$db = getenv('MYSQL_DATABASE') ?: 'canaan_db';
$user = getenv('MYSQL_USER') ?: 'root';
$pass = getenv('MYSQL_PASSWORD') ?: '';
$port = 3306;

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error en la conexión: " . $e->getMessage());
}
?>

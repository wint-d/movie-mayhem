<?php
require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$dsn = 'mysql:host=localhost;dbname=' . $_ENV['DB_DATABASE'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];

try {
  $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
  $error = $e->getMessage();
  echo $error;
}

$sql = 'SELECT * FROM genres';
$result = $db->query($sql);
$genres = $result->fetchAll(PDO::FETCH_COLUMN, 1);

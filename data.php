<?php
$dsn = 'sqlite:movie_mayhem.sqlite';


try {
  $db = new PDO($dsn);
} catch (PDOException $e) {
  $error = $e->getMessage();
  echo $error;
}

$sql = 'SELECT * FROM genres';
$result = $db->query($sql);
$genres = $result->fetchAll(PDO::FETCH_COLUMN, 1);

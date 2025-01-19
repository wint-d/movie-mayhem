<?php
require "data.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $index = array_key_first(array_filter($movies, function ($movie) {
    return $movie['id'] == $_POST['id'];
  }));

  // In PHP 8.4, the array_find_key function can be used instead.
  // $index = array_find_key($movies, function ($movie) {
  //   return $movie['id'] == $_POST['id'];
  // });

  unset($movies[$index]);

  $_SESSION['movies'] = $movies;
}

header("Location: index.php");

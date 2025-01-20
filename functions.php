<?php
function sanitize($data)
{
  return array_map(function ($value) {
    return htmlspecialchars(stripslashes(trim($value)));
  }, $data);
}

// title is required | fewer than 255 characters
// director is required | characters and spaces only
// year is required | numeric only
// genre is required | must be in the list of genres
function validate($movie)
{
  $fields = ['title', 'director', 'year', 'genre'];
  $errors = [];
  global $genres;

  foreach ($fields as $field) {
    switch ($field) {
      case 'title':
        if (empty($movie[$field])) {
          $errors[$field] = 'Title is required';
        } else if (strlen($movie[$field]) > 255) {
          $errors[$field] = 'Title must be fewer than 255 characters';
        }
        break;
      case 'director':
        if (empty($movie[$field])) {
          $errors[$field] = 'Director is required';
        } else if (!preg_match('/^[a-zA-Z\s]+$/', $movie[$field])) {
          $errors[$field] = 'Director must contain only letters and spaces';
        }
        break;
      case 'year':
        if (empty($movie[$field])) {
          $errors[$field] = 'Year is required';
        } else if (filter_var($movie[$field], FILTER_VALIDATE_INT) === false) {
          $errors[$field] = 'Year must contain only numbers';
        }
        break;
      case 'genre':
        if (empty($movie[$field])) {
          $errors[$field] = 'Genre is required';
        } else if (!in_array($movie[$field], $genres)) {
          $errors[$field] = 'Genre must be in the list of genres';
        }
        break;
    }
  }


  return $errors;
}

function getGenreId($genre)
{
  global $genres;

  return array_search($genre, $genres) + 1;
}

function getMovies()
{
  global $db;
  $sql = "SELECT * FROM movies";
  $result = $db->query($sql);
  $movies = $result->fetchAll(PDO::FETCH_ASSOC);
  return $movies;
}

function searchMovies()
{
  global $db;
  $sql = "SELECT * FROM movies WHERE title LIKE :search";
  $stmt = $db->prepare($sql);
  $stmt->execute(['search' => '%' . $_GET['search'] . '%']);
  $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $movies;
}

function getMovie($id)
{
  global $db;

  $sql = "SELECT movies.id, title, director, year, genre FROM movies JOIN genres ON movies.genre_id = genres.id WHERE movies.id = :id";
  $stmt = $db->prepare($sql);
  $stmt->execute(['id' => $id]);
  $movie = $stmt->fetch(PDO::FETCH_ASSOC);
  return $movie;
}

function addMovie($movie)
{
  global $db;
  $genre_id = getGenreId($movie['genre']);

  $sql = "INSERT INTO movies (title, director, year, genre_id) VALUES (:title, :director, :year, :genre_id)";
  $stmt = $db->prepare($sql);
  $stmt->execute([
    'title' => $movie['title'],
    'director' => $movie['director'],
    'year' => $movie['year'],
    'genre_id' => $genre_id
  ]);

  return $db->lastInsertId();
}

function updateMovie($movie)
{
  global $db;
  $genre_id = getGenreId($movie['genre']);

  $sql = "UPDATE movies SET title = :title, director = :director, year = :year, genre_id = :genre_id WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->execute([
    'title' => $movie['title'],
    'director' => $movie['director'],
    'year' => $movie['year'],
    'genre_id' => $genre_id,
    'id' => $movie['id']
  ]);

  return $movie['id'];
}

function deleteMovie($id)
{
  global $db;
  $sql = "DELETE FROM movies WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->execute(['id' => $id]);

  return $stmt->rowCount();
}

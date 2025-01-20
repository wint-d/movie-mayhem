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

function getMovies()
{
  global $movies;

  return $movies;
}

function searchMovies()
{
  global $movies;

  return array_filter($movies, function ($movie) {
    return strpos(strtolower($movie['title']), strtolower($_GET['search'])) !== false;
  });
}

function getMovie($id)
{
  global $movies;

  return current(array_filter($movies, function ($movie) use ($id) {
    return $movie["id"] == $id;
  }));
}

function addMovie($movie)
{
  global $movies;

  array_push($movies, [
    'id' => end($movies)['id'] + 1,
    'title' => $movie['title'],
    'director' => $movie['director'],
    'year' => $movie['year'],
    'genre' => $movie['genre']
  ]);

  $_SESSION['movies'] = $movies;

  return end($movies)['id'];
}

function updateMovie($movie)
{
  global $movies;

  $new = [
    'id' => $movie['id'],
    'title' => $movie['title'],
    'director' => $movie['director'],
    'year' => $movie['year'],
    'genre' => $movie['genre']
  ];

  $movies = array_map(function ($movie) use ($new) {
    if ($movie['id'] == $new['id']) {
      return $new;
    }

    return $movie;
  }, $movies);

  $_SESSION['movies'] = $movies;

  return $movie['id'];
}

function deleteMovie($id)
{
  global $movies;
  $movies = array_filter($movies, function ($movie) use ($id) {
    return $movie['id'] != $id;
  });

  $_SESSION['movies'] = $movies;

  return empty(getMovie($id));
}

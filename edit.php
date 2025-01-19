<?php
require "data.php";
require "functions.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $movie = sanitize($_POST);
  $errors = validate($movie);

  if (count($errors) === 0) {

    $new = [
      'id' => $_POST['id'],
      'title' => $_POST['title'],
      'director' => $_POST['director'],
      'year' => $_POST['year'],
      'genre' => $_POST['genre']
    ];

    $movies = array_map(function ($movie) use ($new) {
      if ($movie['id'] == $new['id']) {
        return $new;
      }

      return $movie;
    }, $movies);

    $_SESSION['movies'] = $movies;

    header("Location: movie.php?id=" . $_POST['id']);
  }
}

if (isset($_GET['id'])) {
  $movie = current(array_filter($movies, function ($movie) {
    return $movie['id'] == $_GET['id'];
  }));

  if (!$movie) {
    header("Location: index.php");
  }
} else {
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Movie</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <main class="main">
    <?php require "header.php"; ?>
    <h2 class="form-title">Edit Movie</h2>
    <ul>
      <?php if (isset($errors)) : ?>
        <?php foreach ($errors as $error) : ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      <?php endif; ?>
    </ul>
    <form class="form" method="post" novalidate>
      <input
        type="hidden"
        name="id"
        value="<?php echo $movie['id']; ?>">
      <div class="form-group">
        <label class="visually-hidden" for="title">Title</label>
        <input
          type="text"
          class="form-control"
          id="title"
          name="title"
          placeholder="Title"
          required
          value="<?php echo $movie['title']; ?>">
      </div>
      <div class="form-group">
        <label class="visually-hidden" for="director">Director</label>
        <input
          type="text"
          class="form-control"
          id="director"
          name="director"
          placeholder="Director"
          required
          value="<?php echo $movie['director']; ?>">
      </div>
      <div class="form-group">
        <label class="visually-hidden" for="year">Year</label>
        <input
          type="number"
          class="form-control"
          id="year"
          name="year"
          placeholder="Year"
          required
          value="<?php echo $movie['year']; ?>">
      </div>
      <div class="form-group">
        <label class="visually-hidden" for="genre">Genre</label>
        <select class="form-select" id="genre" name="genre">
          <option value="">Select a Genre</option>
          <?php foreach ($genres as $genre) : ?>
            <option
              value="<?php echo $genre; ?>"
              <?php if ($genre == $movie['genre']) : ?> selected <?php endif; ?>>
              <?php echo $genre; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="button">Update Movie</button>
    </form>

    <form class="form" method="POST" action="delete.php">
      <input
        type="hidden"
        name="id"
        value="<?php echo $movie['id']; ?>">
      <button type="submit" class="button danger">Delete Movie</button>
    </form>
  </main>
</body>

</html>
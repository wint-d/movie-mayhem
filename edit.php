<?php
require "data.php";

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
    <form class="form" method="post">
      <div class="form-group">
        <label class="visually-hidden" for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title" required value="Labyrinth">
      </div>
      <div class="form-group">
        <label class="visually-hidden" for="director">Director</label>
        <input type="text" class="form-control" id="director" name="director" placeholder="Director" required value="Jim Henson">
      </div>
      <div class="form-group">
        <label class="visually-hidden" for="year">Year</label>
        <input type="number" class="form-control" id="year" name="year" placeholder="Year" required value="1986">
      </div>
      <div class="form-group">
        <label class="visually-hidden" for="genre">Genre</label>
        <select class="form-select" id="genre" name="genre">
          <option value="">Select a Genre</option>
          <?php foreach ($genres as $genre) : ?>
            <option value="<?php echo $genre; ?>">
              <?php echo $genre; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="button">Update Movie</button>
    </form>
  </main>
</body>

</html>
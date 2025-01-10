<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Movies</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<main class="main">
		<?php require "header.php"; ?>
		<form class="form">
			<label class="visually-hidden" for="search">Search</label>
			<input type="search" class="form-control" id="search" name="search" placeholder="Search">
		</form>
		<section class="movies">
			<a class="movie" href="movie.php">Labyrinth</a>
		</section>
	</main>
</body>

</html>
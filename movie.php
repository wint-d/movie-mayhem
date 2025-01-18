<?php
require "data.php";

if (isset($_GET['id'])) {
	$movie = current(array_filter($movies, function ($movie) {
		// Values from a query string are always strings
		// The ID value must be converted to a number.
		return $movie["id"] == $_GET['id'];
		// return $movie["id"] === (int)$_GET['id'];
	}));

	// In PHP 8.4, the array_find function can be used instead.
	// $movie = array_find($movies, function ($movie) {
	// 	return $movie["id"] == $_GET['id'];
	// });

	if (!$movie) {
		header('Location: index.php');
	}
} else {
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $movie['title']; ?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<main class="main">
		<?php require "header.php"; ?>
		<section class="movie-details">
			<a class="movie-edit" href="edit.php">Edit</a>
			<h2 class="movie-title">
				<?php echo $movie['title']; ?>
				<span class="movie-year">(<?php echo $movie['year']; ?>)</span>
			</h2>
			<h4 class="movie-genre"><?php echo $movie['genre']; ?></h4>

			Director<br><strong><?php echo $movie['director']; ?></strong>

		</section>
	</main>
</body>

</html>
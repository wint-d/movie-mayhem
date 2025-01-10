<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>New Movie</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<main class="main">
		<?php require "header.php"; ?>
		<h2 class="form-title">New Movie</h2>
		<form class="form" method="post">
			<div class="form-group">
				<label class="visually-hidden" for="title">Title</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Title" required>
			</div>
			<div class="form-group">
				<label class="visually-hidden" for="director">Director</label>
				<input type="text" class="form-control" id="director" name="director" placeholder="Director" required>
			</div>
			<div class="form-group">
				<label class="visually-hidden" for="year">Year</label>
				<input type="number" class="form-control" id="year" name="year" placeholder="Year" required>
			</div>
			<div class="form-group">
				<label class="visually-hidden" for="genre">Genre</label>
				<select class="form-select" id="genre" name="genre">
					<option value="">Select a Genre</option>
					<option value="Fantasy">Fantasy</option>
				</select>
			</div>
			<button type="submit" class="button">Add Movie</button>
		</form>
	</main>
</body>

</html>
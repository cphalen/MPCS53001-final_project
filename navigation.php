<head>
	<!-- Latest 4.0.0 compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!-- Latest version of Font Awesome from MaxCDN -->
	<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">StarTrek Database</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav">
			<li class="nav-item ">
				<a class="nav-link" href="/roles.php">Characters</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/episodes.php">Episodes</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/seasons.php">Seasons</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/actors.php">Actors</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/writers.php">Writers</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/directors.php">Directors</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/collaborators.php">Collaborators</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Series
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<?php
                        // Load in series to select from
						include "mysql_connect.php";
						$res = mysqli_query($conn, "SELECT SeriesTitle FROM Series ORDER BY YearRange ASC;")
						    or die("Query $query tables failed: " . mysqli_error());
						// Result tuple with only one item that was selected
						while ($row = mysqli_fetch_row($res)) {
							 echo '<a class="dropdown-item" href="/series.php/?SeriesTitle=' . $row[0] . '">' . $row[0] . '</a>';
						}
						include "mysql_close.php";
						?>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Add
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<a class="dropdown-item" href="/insert/role.php">Characters</a>
					<a class="dropdown-item" href="/insert/episode.php">Episodes</a>
					<a class="dropdown-item" href="/insert/season.php">Seasons</a>
					<a class="dropdown-item" href="/insert/actor.php">Actors</a>
					<a class="dropdown-item" href="/insert/writer.php">Writers</a>
					<a class="dropdown-item" href="/insert/director.php">Directors</a>
					<a class="dropdown-item" href="/insert/series.php">Series</a>
				</div>
			</li>
		</ul>
	</div>
</nav>

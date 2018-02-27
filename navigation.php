<head>
	<!-- Latest 4.0.0 compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">StarTrek Database</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav">
			<li class="nav-item ">
				<a class="nav-link" href="schema.php">Schema</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="episodes.php">Episodes</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="actors.php">Actors</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Series
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<?php
                        // Load in series to select from
						$query = "SELECT SeriesTitle FROM Series;";
						include "mysql_connect.php";
						// Result tuple with only one item that was selected
						while ($res = mysqli_fetch_row($result)) {
							 echo '<a class="dropdown-item" href="series.php/?SeriesTitle=' . $res[0] . '">' . $res[0] . '</a>';
						}
						include "mysql_close.php";
						?>
				</div>
			</li>
		</ul>
	</div>
</nav>

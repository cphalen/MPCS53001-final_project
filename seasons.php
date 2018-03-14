<?php

include "navigation.php";

?>

<br>
<div class="container">
<form action="/~cphalen/api/querySeason.php" method="post">
    <h3>
        Search by a season's year, series, and description
    </h3>
    <small>
        All seasons which meet any of the criteria below will be selected
    </small>
    <br>
    <br>
	<div class="form-group col-6">
        <label for="SeriesTitle">Series title</label>
		<input type="text" name="SeriesTitle" class="form-control" placeholder="The Next Generation">
        <br>
        <label for="Year">Year</label>
        <input type="number" name="Year" class="form-control" placeholder="1985" min="1">
        <br>
        <label for="Description">Description</label>
        <input type="text" name="Description" class="form-control" placeholder="Spock saves everyone">
        <small> Any description that contains the value below will be selected </small>
	</div>
	<button type="search" class="btn btn-primary">Search</button>
</form>
</div>

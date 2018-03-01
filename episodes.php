<?php

include "navigation.php";

?>

<br>
<div class="container">
<form action="/~cphalen/api/queryEpisode.php" method="post">
    <h3>
        Search by an episode's title, air date, series/season, and description
    </h3>
    <small>
        All episodes which meet any of the criteria below will be selected
    </small>
    <br>
    <br>
	<div class="form-group col-6">
		<label for="EpisodeTitle">Episode title</label>
		<input type="text" name="EpisodeTitle" class="form-control" placeholder="Balance of Terror">
        <br>
        <label for="SeriesTitle">Series title</label>
		<input type="text" name="SeriesTitle" class="form-control" placeholder="The Next Generation">
        <label for="SeasonNumber">Season Number</label>
        <div class="input-group input-group-sm">
    		<input type="number" name="SeasonNumber" class="form-control" placeholder="1">
        </div>
        <br>
        <label for="AirDate">Air date</label>
        <input type="date" name="AirDate" class="form-control">
        <br>
        <label for="Description">Description</label>
        <input type="text" name="Description" class="form-control" placeholder="Spock saves everyone">
        <small> Any description that contains the value below will be selected </small>
	</div>
	<button type="search" class="btn btn-primary">Search</button>
</form>
</div>

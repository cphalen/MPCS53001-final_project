<?php

include "navigation.php";

?>

<br>
<div class="container">
<form action="/~cphalen/api/queryCollaborator.php" method="post">
    <h3>
        Search by an episode by title and see the staff/crew that worked in that episode's production
    </h3>
    <small>
        Only episodes which matches the given title exactly will be displayed
    </small>
    <br>
    <br>
	<div class="form-group col-6">
		<label for="EpisodeTitle">Episode title</label>
		<input type="text" name="EpisodeTitle" class="form-control" placeholder="Balance of Terror">
        <br>
        <label> Select which collaborators you would like to be displayed </label>
        <br>
        <label class="btn btn-sm btn-secondary">
            <input name="ToggleActors" type="checkbox" autocomplete="off"> Actors </input>
        </label>
        <label class="btn btn-sm btn-secondary">
            <input name="ToggleWriters" type="checkbox" autocomplete="off"> Writers </input>
        </label>
        <label class="btn btn-sm btn-secondary">
            <input name="ToggleDirectors" type="checkbox" autocomplete="off"> Directors </input>
        </label>
        <br>
        <br>
    </div>
	<button type="search" class="btn btn-primary">Search</button>
</form>
</div>

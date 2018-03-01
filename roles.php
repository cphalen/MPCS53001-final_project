<?php

include "navigation.php";

?>

<br>
<div class="container">
<form action="/~cphalen/api/queryRole.php" method="post">
    <h3>
        Search by a characters name or description
    </h3>
    <small>
        Both actors whose name resembles either the name given or the description given will be displayed
    </small>
    <br>
    <br>
	<div class="form-group col-6">
		<label for="RoleName">Character name</label>
		<input type="text" name="RoleName" class="form-control" placeholder="Spock">
        <br>
        <label for="Description">Description</label>
		<input type="text" name="Description" class="form-control" placeholder="Tall pointy ears emotionless captain's assitant">
        <small> Any description that contains the value below will be selected</small>
	</div>
    <br>
	<button type="search" class="btn btn-primary">Search</button>
</form>
</div>

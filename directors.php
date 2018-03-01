<?php

include "navigation.php";

?>

<br>
<div class="container">
<form action="/~cphalen/api/queryDirector.php" method="post">
    <h3>
        Search by an Director's name or the range of their birthday
    </h3>
    <small>
        Both directors whose name resembles the name given and directors whose birthday fall within the range will be displayed
    </small>
    <br>
    <br>
	<div class="form-group col-6">
		<label for="DirectorName">Director name</label>
		<input type="text" name="DirectorName" class="form-control" placeholder="Carl Friedrich Gauss">
	</div>
	<div class="form-group col-4">
		<label for="DirectorBirthdayRange">Birthday range</label>
		<br>
		<small> Begin birthdate range
		<input type="date" name="BeginBirthdayRange" class="form-control">
		<br>
		<small> End birthdate range
		<input type="date" name="EndBirthdayRange" class="form-control">
	</div>
    <br>
	<button type="search" class="btn btn-primary">Search</button>
</form>
</div>

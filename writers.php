<?php

include "navigation.php";

?>

<br>
<div class="container">
<form action="/~cphalen/api/queryWriter.php" method="post">
    <h3>
        Search by an Writer's name or the range of their birthday
    </h3>
    <small>
        Both writers whose name resembles the name given and writers whose birthday fall within the range will be displayed
    </small>
    <br>
    <br>
	<div class="form-group col-6">
		<label for="WriterName">Writer name</label>
		<input type="text" name="WriterName" class="form-control" placeholder="Leonhard Euler">
	</div>
	<div class="form-group col-4">
		<label for="WriterBirthdayRange">Birthday range</label>
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

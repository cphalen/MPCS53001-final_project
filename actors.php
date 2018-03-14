<?php

include "navigation.php";

?>

<br>
<div class="container">
    <form action="/~cphalen/api/queryActor.php" method="post">
        <h3>
            Search by an actor's name or the range of their birthday
        </h3>
        <small>
            Both actors whose name resembles the name given and actors whose birthday fall within the range will be displayed
        </small>
        <br>
        <br>
    	<div class="form-group col-6">
    		<label for="ActorName">Actor name</label>
    		<input type="text" name="ActorName" class="form-control" placeholder="William Shatner">
    	</div>
    	<div class="form-group col-4">
    		<label for="ActorBirthdayRange">Birthday range</label>
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

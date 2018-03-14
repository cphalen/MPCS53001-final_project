<?php
session_start();
include "../navigation.php";

$status = htmlspecialchars($_GET["status"]);

?>

<br>
<div class="container">
    <form action="../api/editRole.php?mode=insert" method="post">
        <?php
            if($status == "alreadySuchName") {
                echo '<div class="alert alert-danger" role="alert"> There seems already to have been a charater with input name. Please check your inputs and try again! </div>';
            } elseif ($status == "noSuchActorName") {
                echo '<div class="alert alert-danger" role="alert"> We did not find an actor with the name specified. Please check your inputs and try again! </div>';
            } elseif ($status == "unknownFailure") {
                echo '<div class="alert alert-danger" role="alert"> There seems to have been an error the system did not exepct. Please contact site administrators and give them your dataset. Our apologies! </div>';
            } elseif ($status == "success") {
                echo '<div class="alert alert-success" role="alert"> Your data was successfully inserted into the database! </div>';
            }
        ?>
        <h3>
            Insert a new character with all of the below information
        </h3>
        <small>
            Only certain inputs are requried
        </small>
        <br>
        <br>
    	<div class="form-group col-6">
    		<label for="RoleName">Character name</label>
    		<input type="text" name="RoleName" class="form-control" placeholder="Kevin Flynn">
    	</div>
        <br>
        <div class="form-group col-6">
    		<label for="ActorName">Actor name</label>
    		<input type="text" name="ActorName" class="form-control" placeholder="William Shatner">
            <small>This must refer to a real actor already in the database</small>
    	</div>
        <br>
        <div class="form-group col-8 input-lg">
            <label for="Description">Description</label>
            <textarea name="Description" class="form-control" rows="4" placeholder="And one day ... I got in"></textarea>
    	</div>
        <br>
    	<button type="search" class="btn btn-primary">Insert</button>
    </form>
</div>

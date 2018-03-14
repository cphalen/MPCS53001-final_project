<?php
session_start();
include "../navigation.php";

$status = htmlspecialchars($_GET["status"]);

?>

<br>
<div class="container">
    <form action="../api/editActor.php?mode=insert" method="post">
        <?php
            if($status == "alreadySuchName") {
                echo '<div class="alert alert-danger" role="alert"> There seems already to have been a actor with input name. Please check your inputs and try again! </div>';
            } elseif ($status == "unknownFailure") {
                echo '<div class="alert alert-danger" role="alert"> There seems to have been an error the system did not exepct. Please contact site administrators and give them your dataset. Our apologies! </div>';
            } elseif ($status == "success") {
                echo '<div class="alert alert-success" role="alert"> Your data was successfully inserted into the database! </div>';
            }
        ?>
        <h3>
            Insert a new actor with all of the below information
        </h3>
        <small>
            Only certain inputs are requried
        </small>
        <br>
        <br>
    	<div class="form-group col-6">
    		<label for="ActorName">Actor name</label>
    		<input type="text" name="ActorName" class="form-control" placeholder="William Shatner" requried>
    	</div>
    	<div class="form-group col-4">
    		<label for="Birthday">Birthday</label>
    		<br>
    		<input type="date" name="Birthday" class="form-control">
    	</div>
        <br>
    	<button type="search" class="btn btn-primary">Insert</button>
    </form>
</div>

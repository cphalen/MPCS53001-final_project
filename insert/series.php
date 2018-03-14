<?php
session_start();
include "../navigation.php";

$status = htmlspecialchars($_GET["status"]);

?>

<br>
<div class="container">
    <form action="../api/editSeries.php?mode=insert" method="post">
        <?php
            if($status == "alreadySuchSeriesTitle") {
                echo '<div class="alert alert-danger" role="alert"> The series title selected seems to already exist. Please check your inputs and try again! </div>';
            } elseif ($status == "unknownFailure") {
                echo '<div class="alert alert-danger" role="alert"> There seems to have been an error the system did not exepct. Please contact site administrators and give them your dataset. Our apologies! </div>';
            } elseif ($status == "success") {
                echo '<div class="alert alert-success" role="alert"> Your data was successfully inserted into the database! </div>';
            }
        ?>
        <h3>
            Insert a new series with all of the below information
        </h3>
        <small>
            Only certain inputs are requried
        </small>
        <br>
        <br>
    	<div class="form-group col-6">
            <label for="SeriesTitle">Series title</label>
            <input type="text" name="SeriesTitle" class="form-control" placeholder="The Next Generation" required>
            <br>
            <label for="YearRange">Year Range</label>
            <input type="text" name="YearRange" class="form-control" placeholder="1985-1986" min="1">
            <br>
            <label for="Description">Description</label>
            <textarea name="Description" class="form-control" rows="4" placeholder="The end of the world"></textarea>
            <br>
    	</div>
    	<button type="search" class="btn btn-primary">Insert</button>
    </form>
</div>

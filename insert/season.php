<?php
session_start();
include "../navigation.php";

$status = htmlspecialchars($_GET["status"]);

?>

<br>
<div class="container">
    <form action="../api/editSeason.php?mode=insert" method="post">
        <?php
            if($status == "alreadySuchSeasonNumberAndSeriesTitle") {
                echo '<div class="alert alert-danger" role="alert"> It seems as though in combination of series title and season number specified in the input alrady exists. Please check your inputs and try again! </div>';
            } elseif ($status == "noSuchSeries") {
                echo '<div class="alert alert-danger" role="alert"> There does not seem to be any series that matches your input. Please check your inputs and try again! </div>';
            } elseif ($status == "unknownFailure") {
                echo '<div class="alert alert-danger" role="alert"> There seems to have been an error the system did not exepct. Please contact site administrators and give them your dataset. Our apologies! </div>';
            } elseif ($status == "success") {
                echo '<div class="alert alert-success" role="alert"> Your data was successfully inserted into the database! </div>';
            }
        ?>
        <h3>
            Insert a new season with all of the below information
        </h3>
        <small>
            Only certain inputs are requried
        </small>
        <br>
        <br>
    	<div class="form-group col-6">
            <label for="SeriesTitle">Series title</label>
            <input type="text" name="SeriesTitle" class="form-control" placeholder="The Next Generation" required>
            <label for="SeasonNumber">Season Number</label>
            <div class="input-group input-group-sm">
                <input type="number" name="SeasonNumber" class="form-control" placeholder="1" min="1" required>
            </div>
            <br>
            <label for="Year">Year</label>
            <input type="number" name="Year" class="form-control" placeholder="1985" min="1">
            <br>
            <label for="Description">Description</label>
            <textarea name="Description" class="form-control" rows="4" placeholder="Spock saves everyone"></textarea>
            <br>
    	</div>
    	<button type="search" class="btn btn-primary">Insert</button>
    </form>
</div>

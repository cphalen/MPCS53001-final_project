<?php
session_start();
include "../navigation.php";

$status = htmlspecialchars($_GET["status"]);

?>

<br>
<div class="container">
    <form action="../api/editEpisode.php?mode=insert" method="post">
        <?php
            if($status == "noSuchSeason") {
                echo '<div class="alert alert-danger" role="alert"> There does not seem to be any season that matches your input. Please check your inputs and try again! </div>';
            } elseif ($status == "alreadySuchEpisodeTitle") {
                echo '<div class="alert alert-danger" role="alert"> There seems to already be an episode with the title you specified. Please check your inputs and try again!</div>';
            } elseif ($status == "alreadySuchEpisodeNumberInSeason") {
                echo '<div class="alert alert-danger" role="alert"> There seems to already be an episode with the season and episode numbers you specified. Please check your inputs and try again!</div>';
            } elseif ($status == "unknownFailure") {
                echo '<div class="alert alert-danger" role="alert"> There seems to have been an error the system did not exepct. Please contact site administrators and give them your dataset. Our apologies! </div>';
            } elseif ($status == "success") {
                echo '<div class="alert alert-success" role="alert"> Your data was successfully inserted into the database! </div>';
            }
        ?>
        <h3>
            Insert a new episode with all of the below information
        </h3>
        <small>
            Only certain inputs are requried
        </small>
        <br>
        <br>
    	<div class="form-group col-6">
    		<label for="EpisodeTitle">Episode title</label>
    		<input type="text" name="EpisodeTitle" class="form-control" placeholder="Balance of Terror" required>
            <label for="EpisodeNumber">Episode Number</label>
            <div class="input-group input-group-sm">
        		<input type="number" name="EpisodeNumber" class="form-control" placeholder="1" min="1" required>
            </div>
            <br>
            <label for="SeriesTitle">Series title</label>
    		<input type="text" name="SeriesTitle" class="form-control" placeholder="The Next Generation" required>
            <label for="SeasonNumber">Season Number</label>
            <div class="input-group input-group-sm">
        		<input type="number" name="SeasonNumber" class="form-control" placeholder="1" min="1" required>
            </div>
            <br>
            <label for="AirDate">Air date</label>
            <input type="date" name="AirDate" class="form-control">
            <br>
            <label for="Description">Description</label>
            <input type="text" name="Description" class="form-control" placeholder="Spock saves everyone">
            <small> Any description that contains the value below will be selected </small>
            <br>
            <br>
            <label class="btn btn-sm btn-secondary">
                <input name="Favorite" type="checkbox" autocomplete="off"> Favorite </input>
            </label>
            <small> Check if this episode is a favorite </small>
            <br>
    	</div>
    	<button type="search" class="btn btn-primary">Insert</button>
    </form>
</div>

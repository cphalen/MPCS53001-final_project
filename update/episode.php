<?php
session_start();
include "../navigation.php";
include "../mysql_connect.php";

$EpisodeID = htmlspecialchars($_GET["id"]);
$status = htmlspecialchars($_GET["status"]);

$stmt = mysqli_stmt_init($conn);
$query = "SELECT EpisodeNumber, Episode.Title, Episode.AirDate, Episode.Description, SeasonNumber, SeriesTitle, Favorite FROM Episode INNER JOIN Season USING (SeasonID) WHERE EpisodeID=?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $EpisodeID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

$row = mysqli_fetch_row($res);

$EpisodeNumber = $row[0];
$EpisodeTitle = $row[1];
$AirDate = $row[2];
$Description = $row[3];
$SeasonNumber= $row[4];
$SeriesTitle = $row[5];
$Favorite = $row[6];

?>

<br>
<div class="container">
<form action="../api/editEpisode.php?mode=update&id=<?php echo $EpisodeID ?>" method="post">
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
            echo '<div class="alert alert-success" role="alert"> Your data was successfully updated on the database! </div>';
        }
    ?>
    <h3>
        Update or delete an already existing episode
    </h3>
    <small>
        All changes will be posted to the database
    </small>
    <br>
    <br>
	<div class="form-group col-6">
		<label for="EpisodeTitle">Episode title</label>
		<input type="text" name="EpisodeTitle" class="form-control" value="<?php echo $EpisodeTitle ?>" required="true">
        <label for="EpisodeNumber">Episode Number</label>
        <div class="input-group input-group-sm">
    		<input type="number" name="EpisodeNumber" class="form-control" value="<?php echo $EpisodeNumber ?>" min="1" required="true">
        </div>
        <br>
        <label for="SeriesTitle">Series title</label>
		<input type="text" name="SeriesTitle" class="form-control" value="<?php echo $SeriesTitle ?>" required="true">
        <label for="SeasonNumber">Season Number</label>
        <div class="input-group input-group-sm">
    		<input type="number" name="SeasonNumber" class="form-control" value="<?php echo $SeasonNumber ?>" min="1" required="true">
        </div>
        <br>
        <label for="AirDate">Air date</label>
        <input type="date" name="AirDate" value="<?php echo $AirDate ?>" class="form-control">
        <br>
        <label for="Description">Description</label>
        <textarea name="Description" class="form-control" rows="4"><?php echo $Description ?></textarea>
        <br>
        <label class="btn btn-sm btn-secondary">
            <input name="Favorite" type="checkbox" <?php if($Favorite == True) { echo "checked"; } ?>> Favorite </input>
        </label>
        <small> Check if this episode is a favorite </small>
        <br>
	</div>
	<button type="search" class="btn btn-primary">Update</button>
    <a class="badge" href='../api/delete/deleteEpisode.php?id=<?php echo $EpisdeID ?>'>
        <button type='button' class='btn btn-danger btn-default btn-md'>
            Delete <i class='fas fa-times-circle'></i>
        </button>
    </a>
</form>
</div>

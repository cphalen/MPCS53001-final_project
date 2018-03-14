<?php
session_start();
include "../navigation.php";
include "../mysql_connect.php";

$SeasonID = htmlspecialchars($_GET["id"]);
$status = htmlspecialchars($_GET["status"]);

$stmt = mysqli_stmt_init($conn);
$query = "SELECT SeriesTitle, SeasonNumber, Year, Description FROM Season WHERE SeasonID=?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $SeasonID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

$row = mysqli_fetch_row($res);

$SeriesTitle = $row[0];
$SeasonNumber = $row[1];
$Year = $row[2];
$Description = $row[3];

?>

<br>
<div class="container">
    <form action="../api/editSeason.php?mode=update&id=<?php echo $SeasonID?>" method="post">
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
            Update or delete an already existing season
        </h3>
        <small>
            All changes will be posted to the database
        </small>
        <br>
        <br>
    	<div class="form-group col-6">
            <label for="SeriesTitle">Series title</label>
            <input type="text" name="SeriesTitle" class="form-control" value="<?php echo $SeriesTitle ?>" required="true">
            <label for="SeasonNumber">Season Number</label>
            <div class="input-group input-group-sm">
                <input type="number" name="SeasonNumber" class="form-control" value="<?php echo $SeasonNumber ?>" min="1" required="true">
            </div>
            <br>
            <label for="Year">Year</label>
            <input type="number" name="Year" class="form-control" value="<?php echo $Year ?>" min="1">
            <br>
            <label for="Description">Description</label>
            <textarea name="Description" class="form-control" rows="4"><?php echo $Description ?></textarea>
            <br>
    	</div>
    	<button type="search" class="btn btn-primary">Update</button>
        <a class="badge" href='../api/delete/deleteSeason.php?id=<?php echo $SeasonID ?>'>
            <button type='button' class='btn btn-danger btn-default btn-md'>
                Delete <i class='fas fa-times-circle'></i>
            </button>
        </a>
    </form>
</div>

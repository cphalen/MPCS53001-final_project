<?php
session_start();
include "../navigation.php";
include "../mysql_connect.php";

$SeriesTitle = htmlspecialchars($_GET["id"]);
$status = htmlspecialchars($_GET["status"]);

$stmt = mysqli_stmt_init($conn);
$query = "SELECT SeriesTitle, YearRange, Description FROM Series WHERE SeriesTitle=?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $SeriesTitle);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

$row = mysqli_fetch_row($res);

$SeriesTitle = $row[0];
$YearRange = $row[1];
$Description = $row[2];


?>

<br>
<div class="container">
    <form action="../api/editSeries.php?mode=update&id=<?php echo $SeriesTitle ?>" method="post">
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
            Update or delete an already existing series
        </h3>
        <small>
            Only certain inputs are required
        </small>
        <br>
        <br>
    	<div class="form-group col-6">
            <label for="SeriesTitle">Series title</label>
            <input type="text" name="SeriesTitle" class="form-control" value="<?php echo $SeriesTitle ?>" required="true">
            <br>
            <label for="YearRange">Year Range</label>
            <input type="text" name="YearRange" class="form-control" value="<?php echo $YearRange ?>" min="1">
            <br>
            <label for="Description">Description</label>
            <textarea name="Description" class="form-control" rows="4"><?php echo $Description ?></textarea>
            <br>
    	</div>
    	<button type="search" class="btn btn-primary">Update</button>
        <a class="badge" href='../api/delete/deleteSeries.php?id=<?php echo $SeriesTitle ?>'>
            <button type='button' class='btn btn-danger btn-default btn-md'>
                Delete <i class='fas fa-times-circle'></i>
            </button>
        </a>
    </form>
</div>

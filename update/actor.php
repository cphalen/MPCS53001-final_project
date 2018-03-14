<?php
session_start();
include "../navigation.php";
include "../mysql_connect.php";

$ActorID = htmlspecialchars($_GET["id"]);
$status = htmlspecialchars($_GET["status"]);

$stmt = mysqli_stmt_init($conn);
$query = "SELECT Name, DateOfBirth FROM Actor WHERE ActorID=?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $ActorID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

$row = mysqli_fetch_row($res);

$ActorName = $row[0];
$DateOfBirth = $row[1];

?>

<br>
<div class="container">
    <form action="../api/editActor.php?mode=update&id=<?php echo $ActorID ?>" method="post">
        <?php
            if($status == "alreadySuchName") {
                echo '<div class="alert alert-danger" role="alert"> There seems already to have been an actor with input name. Please check your inputs and try again! </div>';
            } elseif ($status == "unknownFailure") {
                echo '<div class="alert alert-danger" role="alert"> There seems to have been an error the system did not exepct. Please contact site administrators and give them your dataset. Our apologies! </div>';
            } elseif ($status == "success") {
                echo '<div class="alert alert-success" role="alert"> Your data was successfully updated on the database! </div>';
            }
        ?>
        <h3>
            Update or delete an already existing actor
        </h3>
        <small>
            All changes will be posted to the database
        </small>
        <br>
        <br>
    	<div class="form-group col-6">
    		<label for="ActorName">Actor name</label>
    		<input type="text" name="ActorName" class="form-control" value="<?php echo $ActorName ?>" required="true">
    	</div>
    	<div class="form-group col-4">
    		<label for="Birthday">Birthday</label>
    		<br>
    		<input type="date" name="Birthday" class="form-control" value="<?php echo $DateOfBirth ?>">
    	</div>
        <br>
    	<button type="search" class="btn btn-primary">Update</button>
        <a class="badge" href='../api/delete/deleteActor.php?id=<?php echo $ActorID ?>'>
            <button type='button' class='btn btn-danger btn-default btn-md'>
                Delete <i class='fas fa-times-circle'></i>
            </button>
        </a>
    </form>
    <br>
    <hr>
    <br>
    <h3>
        Update the episodes in which the actor appears
    </h3>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Remove</th>
                <th scope="col">Actor Name</th>
                <th scope="col">Episode Title</th>
                <th scope="col">Series Title</th>
                <th scope="col">Season Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $stmt = mysqli_stmt_init($conn);
                $query = "SELECT Actor.Name, Episode.Title, Season.SeriesTitle, Season.SeasonNumber, Actor.ActorID, Episode.EpisodeID FROM Actor INNER JOIN ActsIn USING (ActorID) INNER JOIN Episode USING (EpisodeID) INNER JOIN Season USING (SeasonID) WHERE ActorID=?;";
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $ActorID);
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);
                }

                $i = 1;
                while ($row = mysqli_fetch_row($res)) {
                    echo "<tr>
                            <th scope='row'>$i</th>
                            <td>
                                <a href='../api/delete/deleteActsIn.php?ActorID=$row[4]&EpisodeID=$row[5]'>
                                    <button type='button' class='btn btn-primary btn-default btn-md'>
                                        <i class='fas fa-minus-circle'></i>
                                    </button>
                                </a>
                            </td>
                            <td>$row[0]</td>
                            <td>$row[1]</td>
                            <td>$row[2]</td>
                            <td>$row[3]</td>
                            </tr>";
                    $i = $i + 1;
                }
            ?>
        </tbody>
    </table>
    <h4 class="col-md-3">
        <a href='../insert/actsIn.php?name=<?php echo $ActorName ?>'>
            <button type='button' class='btn btn-primary btn-default btn-md'>
                Add new row <i class='fas fa-plus-circle'></i>
            </button>
        </a>
    </h4>
</div>

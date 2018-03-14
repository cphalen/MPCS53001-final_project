<?php
session_start();
include "../navigation.php";

$status = htmlspecialchars($_GET["status"]);
$RoleName = htmlspecialchars($_GET["name"]);

?>

<br>
<div class="container">
    <form action="../api/insertAppearsIn.php" method="post">
        <?php
            if($status == "noSuchEpisodeTitle") {
                echo '<div class="alert alert-danger" role="alert"> There does not appear to be any episode matching the input. Please check your inputs and try again! </div>';
            } elseif ($status == "noSuchRoleName") {
                echo '<div class="alert alert-danger" role="alert"> There does not appear to be any character matching the input. Please check your inputs and try again! </div>';
            } elseif ($status == "success") {
                echo '<div class="alert alert-success" role="alert"> Your data was successfully inserted into the database! </div>';
            }
        ?>
        <h3>
            Insert a new row in the appears in table with all of the below information
        </h3>
        <small>
            All inputs are required
        </small>
        <br>
        <br>
    	<div class="form-group col-6">
    		<label for="RoleName">Role name</label>
    		<input type="text" name="RoleName" class="form-control" value="<?php echo $RoleName ?>" required="true">
    	</div>
        <div class="form-group col-6">
            <label for="EpisodeTitle">Episode Title</label>
            <input type="text" name="EpisodeTitle" class="form-control" placeholder="The Balance of Terror" required="true">
        </div>
        <br>
    	<button type="search" class="btn btn-primary">Insert</button>
    </form>
</div>

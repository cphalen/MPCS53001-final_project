<?php

include "../navigation.php";

?>

<br>
<h2>
    Your episode search returned:
</h2>
<br>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Update</th>
            <th scope="col">Title</th>
            <th scope="col">Airdate</th>
            <th scope="col">Episode #</th>
            <th scope="col">Season #</th>
            <th scope="col">SeriesTitle</th>
            <th scope="col">Favorite</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>

        <?php

        include "../mysql_connect.php";

        // This logic prevents the LIKE comparison to "%%"
        // that would occur if the user did not input a value
        // in the form, resulting in a "" form value
        if($_POST[EpisodeTitle] != "") {
            $EpisodeTitle = "%$_POST[EpisodeTitle]%";
        } else {
            $EpisodeTitle = $_POST[EpisodeTitle];
        }
        if($_POST[Description] != "") {
            $Description = "%$_POST[Description]%";
        } else {
            $Description = $_POST[Description];
        }
        $SeriesTitle = $_POST[SeriesTitle];
        $SeasonNumber = $_POST[SeasonNumber];
        $AirDate = $_POST[AirDate];

        $stmt = mysqli_stmt_init($conn);
        $query = "SELECT Episode.Title, Episode.AirDate, EpisodeNumber, SeasonNumber, SeriesTitle, Favorite, Episode.Description, EpisodeID FROM Episode INNER JOIN Season USING (SeasonID) WHERE Title LIKE ? OR (SeriesTitle=? AND SeasonNumber=?) OR AirDate=? OR Episode.Description LIKE ?;";
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
        } else {
            mysqli_stmt_bind_param($stmt, "sssss", $EpisodeTitle, $SeriesTitle, $SeasonNumber, $AirDate, $Description);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
        }

        $i = 1;

        if(mysqli_num_rows($res) == 0) {
            echo '<div class="alert alert-info" role="alert">Your query was correctly processed but did not return a result!</div>';
        }

        while ($row = mysqli_fetch_row($res)) {
            echo " <tr>
                    <th scope='row'>$i</th>
                    <td>
                        <a href='../update/episode.php?id=$row[7]'>
                            <button type='button' class='btn btn-primary btn-default btn-md'>
                                <i class='fas fa-edit'></i>
                            </button>
                        </a>
                    </td>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td>$row[3]</td>
                    <td>$row[4]</td>
                    <td>$row[5]</td>
                    <td>$row[6]</td>
                    </tr>";
            $i = $i + 1;
        }

        include "../mysql_close.php";
        ?>

    </tbody>
</table>

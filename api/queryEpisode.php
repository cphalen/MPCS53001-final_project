<?php

include "../navigation.php";

?>

<br>
<h2>
    Your actor search returned:
</h2>
<br>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
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

        $EpisodeTitle = "%$_POST[EpisodeTitle]%";
        $SeriesTitle = $_POST[SeriesTitle];
        $SeasonNumber = $_POST[SeasonNumber];
        $AirDate = $_POST[AirDate];
        $Description = $_POST[Description];

        $stmt = mysqli_stmt_init($conn);
        $query = "SELECT * FROM Episode INNER JOIN Season USING (SeasonID) WHERE Title LIKE ? OR (SeriesTitle=? AND SeasonNumber=?) OR AirDate=? OR Description LIKE ?;";
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo "SQL statement failed";
        } else {
            mysqli_stmt_bind_param($stmt, "sssss", $EpisodeTitle, $SeriesTitle, $SeasonNumber, $AirDate, $Description);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
        }

        $i = 1;
        while ($row = mysqli_fetch_row($res)) {
            echo " <tr>
                    <th scope='row'>$i</th>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td>$row[3]</td>
                    <td>$row[4]</td>
                    <td>$row[5]</td>
                    </tr>";
            $i = $i + 1;
        }

        include "../mysql_close.php";
        ?>

    </tbody>
</table>
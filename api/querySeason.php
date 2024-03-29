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
            <th scope="col">Series Title</th>
            <th scope="col">Season #</th>
            <th scope="col">Year</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>

        <?php

        include "../mysql_connect.php";

        $SeriesTitle = $_POST[SeriesTitle];
        $Year = $_POST[Year];
        // This logic prevents the LIKE comparison to "%%"
        // that would occur if the user did not input a value
        // in the form, resulting in a "" form value
        if($_POST[Description] != "") {
            $Description = "%$_POST[Description]%";
        } else {
            $Description = $_POST[Description];
        }

        $stmt = mysqli_stmt_init($conn);
        $query = "SELECT SeriesTitle, SeasonNumber, Year, Description, SeasonID FROM Season WHERE SeriesTitle=? OR Year=? OR Description LIKE ?;";
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $SeriesTitle, $Year, $Description);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $i = 1;
            while ($row = mysqli_fetch_row($res)) {
                echo " <tr>
                        <th scope='row'>$i</th>
                        <td>
                            <a href='../update/season.php?id=$row[4]'>
                                <button type='button' class='btn btn-primary btn-default btn-md'>
                                    <i class='fas fa-edit'></i>
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
        }

        if(mysqli_num_rows($res) == 0) {
            echo '<div class="alert alert-info" role="alert">Your query was correctly processed but did not return a result!</div>';
        }

        include "../mysql_close.php";
        ?>

    </tbody>
</table>

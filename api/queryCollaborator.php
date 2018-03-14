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
            <th scope="col">Collaboration</th>
            <th scope="col">Name</th>
            <th scope="col">Birthday</th>
        </tr>
    </thead>
    <tbody>

        <?php

        include "../mysql_connect.php";

        $EpisodeTitle = $_POST[EpisodeTitle];

        $stmt = mysqli_stmt_init($conn);

        $i = 1;

        $rowsNumber = 0;

        if($_POST[ToggleActors] == "on") {
            $query = "SELECT Name, DateOfBirth, ActorID FROM Episode INNER JOIN ActsIn USING (EpisodeID) INNER JOIN Actor USING (ActorID) WHERE Title=?;";
            if (!mysqli_stmt_prepare($stmt, $query)) {
                echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
            } else {
                mysqli_stmt_bind_param($stmt, "s", $EpisodeTitle);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                $rowsNumber += mysqli_num_rows($res);
                while ($row = mysqli_fetch_row($res)) {
                    echo " <tr>
                            <th scope='row'>$i</th>
                            <td>
                                <a href='../update/actor.php?id=$row[2]'>
                                    <button type='button' class='btn btn-primary btn-default btn-md'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                </a>
                            </td>
                            <td>Actor</td>
                            <td>$row[0]</td>
                            <td>$row[1]</td>
                            </tr>";
                    $i = $i + 1;
                }
            }
        }

        if($_POST[ToggleWriters] == "on") {
            $query = "SELECT Name, DateOfBirth, WriterID FROM Episode INNER JOIN Writes USING (EpisodeID) INNER JOIN Writer USING (WriterID) WHERE Title=?;";
            if (!mysqli_stmt_prepare($stmt, $query)) {
                echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
            } else {
                mysqli_stmt_bind_param($stmt, "s", $EpisodeTitle);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                $rowsNumber += mysqli_num_rows($res);
                while ($row = mysqli_fetch_row($res)) {
                    echo " <tr>
                            <th scope='row'>$i</th>
                            <td>
                                <a href='../update/writer.php?id=$row[2]'>
                                    <button type='button' class='btn btn-primary btn-default btn-md'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                </a>
                            </td>
                            <td>Writer</td>
                            <td>$row[0]</td>
                            <td>$row[1]</td>
                            </tr>";
                    $i = $i + 1;
                }
            }
        }

        if($_POST[ToggleDirectors] == "on") {
            $query = "SELECT Name, DateOfBirth, DirectorID FROM Episode INNER JOIN Directs USING (EpisodeID) INNER JOIN Director USING (DirectorID) WHERE Title=?;";
            if (!mysqli_stmt_prepare($stmt, $query)) {
                echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
            } else {
                mysqli_stmt_bind_param($stmt, "s", $EpisodeTitle);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                $rowsNumber += mysqli_num_rows($res);
                while ($row = mysqli_fetch_row($res)) {
                    echo " <tr>
                            <th scope='row'>$i</th>
                            <td>
                                <a href='../update/director.php?id=$row[2]'>
                                    <button type='button' class='btn btn-primary btn-default btn-md'>
                                        <i class='fas fa-edit'></i>
                                    </button>
                                </a>
                            </td>
                            <td>Director</td>
                            <td>$row[0]</td>
                            <td>$row[1]</td>
                            </tr>";
                    $i = $i + 1;
                }
            }
        }

        if($rowsNumber == 0) {
            echo '<div class="alert alert-info" role="alert">Your query was correctly processed but did not return a result!</div>';
        }

        include "../mysql_close.php";
        ?>

    </tbody>
</table>

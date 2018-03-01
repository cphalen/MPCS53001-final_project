<?php

include "../navigation.php";

?>

<br>
<h2>
    Your writer search returned:
</h2>
<br>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Birthdate</th>
        </tr>
    </thead>
    <tbody>

        <?php

        include "../mysql_connect.php";

        // This logic prevents the LIKE comparison to "%%"
        // that would occur if the user did not input a value
        // in the form, resulting in a "" form value
        if($_POST[WriterName] != "") {
            $WriterName = "%$_POST[WriterName]%";
        } else {
            $WriterName = $_POST[WriterName];
        }
        $BeginBirthdayRange = $_POST[BeginBirthdayRange];
        $EndBirthdayRange = $_POST[EndBirthdayRange];

        $stmt = mysqli_stmt_init($conn);
        $query = "SELECT * FROM Writer WHERE Name LIKE ? OR (DateOfBirth > ? AND DateOfBirth < ?);";
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo '<div class="alert alert-danger" role="alert">The server ran into trouble processing the given request -- please double check your inputs and try again!</div>';
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $WriterName, $BeginBirthdayRange, $EndBirthdayRange);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
        }

        if(mysqli_num_rows($res) == 0) {
            echo '<div class="alert alert-info" role="alert">Your query was correctly processed but did not return a result!</div>';
        }

        $i = 1;
        while ($row = mysqli_fetch_row($res)) {
            echo " <tr>
                    <th scope='row'>$i</th>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    </tr>";
            $i = $i + 1;
        }

        include "../mysql_close.php";
        ?>

    </tbody>
</table>

<?php

include "../navigation.php";

?>

<br>
<h2>
    Your character search returned:
</h2>
<br>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Update</th>
            <th scope="col">Character Name</th>
            <th scope="col">Actor Name</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>

        <?php

        include "../mysql_connect.php";

        // This logic prevents the LIKE comparison to "%%"
        // that would occur if the user did not input a value
        // in the form, resulting in a "" form value
        if($_POST[RoleName] != "") {
            $RoleName = "%$_POST[RoleName]%";
        } else {
            $RoleName = $_POST[RoleName];
        }
        if($_POST[Description] != "") {
            $Description = "%$_POST[Description]%";
        } else {
            $Description = $_POST[Description];
        }

        $stmt = mysqli_stmt_init($conn);
        $query = "SELECT Role.Name, Actor.Name, Role.Description, Role.RoleID FROM Role INNER JOIN Actor USING (ActorID) WHERE Role.Name LIKE ? OR Role.Description LIKE ?;";
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $RoleName, $Description);
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
                    <td>
                        <a href='../update/role.php?id=$row[3]'>
                            <button type='button' class='btn btn-primary btn-default btn-md'>
                                <i class='fas fa-edit'></i>
                            </button>
                        </a>
                    </td>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    </tr>";
            $i = $i + 1;
        }

        include "../mysql_close.php";
        ?>

    </tbody>
</table>

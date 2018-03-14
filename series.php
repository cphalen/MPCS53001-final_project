<?php
session_start();

include "navigation.php";

$SeriesTitle = htmlspecialchars($_GET["SeriesTitle"]);

echo "<h1 class='col-10 mx-auto'>" . $SeriesTitle . "</h1>";

include "mysql_connect.php";

$query = "SELECT * FROM Series WHERE SeriesTitle='$SeriesTitle';";
$res = mysqli_query($conn, $query)
    or die("Query $query tables failed: " . mysqli_error());

// Only one response expected
$row = mysqli_fetch_row($res);
echo "<br>";
echo "<h3 class='col-9 mx-auto'>" . $row[1] . "</h3>";
echo "<br><h4 class='col-9 mx-auto'>Description</h4>";
echo "<div class='row'><h5 class='jumbotron col-9 mx-auto'>$row[2]</h5></div>";
echo "
    <div class='col-9 mx-auto'>
        <big>
            Edit
        </big>
        <a href='../update/series.php?id=$row[0]'>
            <button type='button' class='btn btn-primary btn-default btn-md'>
                <i class='fas fa-edit'></i>
            </button>
        </a>
    </div>";

include "../mysql_close.php";
?>

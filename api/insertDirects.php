<?php

include "../navigation.php";
include "../mysql_connect.php";

$DirectorName = $_POST[DirectorName];
$EpisodeTitle = $_POST[EpisodeTitle];

$stmt = mysqli_stmt_init($conn);

$query = "SELECT DirectorID FROM Director WHERE Name = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $DirectorName);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that the director actually
// exists by the name given
if(mysqli_num_rows($res) == 0) {
    echo "<script type='text/javascript'>window.location.href='../insert/directs.php?status=noSuchDirectorName&name=$DirectorName';</script>";
    die();
} else {
    $row = mysqli_fetch_row($res);
    $DirectorID = $row[0];
}

$query = "SELECT EpisodeID FROM Episode WHERE Title = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $EpisodeTitle);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that the director actually
// exists by the name given
if(mysqli_num_rows($res) == 0) {
    echo "<script type='text/javascript'>window.location.href='../insert/directs.php?status=noSuchEpisodeTitle&name=$DirectorName';</script>";
    die();
} else {
    $row = mysqli_fetch_row($res);
    $EpisodeID = $row[0];
}

$query = "INSERT INTO Directs(DirectorID, EpisodeID) VALUES(?, ?);";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ss", $DirectorID, $EpisodeID);
    $res = mysqli_stmt_execute($stmt);
}

echo "<script type='text/javascript'>window.location.href='../update/director.php?status=success&id=$DirectorID';</script>";

include "../mysql_close.php";

?>

<?php

include "../navigation.php";
include "../mysql_connect.php";

$WriterName = $_POST[WriterName];
$EpisodeTitle = $_POST[EpisodeTitle];

$stmt = mysqli_stmt_init($conn);

$query = "SELECT WriterID FROM Writer WHERE Name = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $WriterName);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that the writer actually
// exists by the name given
if(mysqli_num_rows($res) == 0) {
    echo "<script type='text/javascript'>window.location.href='../insert/writes.php?status=noSuchWriterName&name=$WriterName';</script>";
    die();
} else {
    $row = mysqli_fetch_row($res);
    $WriterID = $row[0];
}

$query = "SELECT EpisodeID FROM Episode WHERE Title = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $EpisodeTitle);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that the writer actually
// exists by the name given
if(mysqli_num_rows($res) == 0) {
    echo "<script type='text/javascript'>window.location.href='../insert/writes.php?status=noSuchEpisodeTitle&name=$WriterName';</script>";
    die();
} else {
    $row = mysqli_fetch_row($res);
    $EpisodeID = $row[0];
}

$query = "INSERT INTO Writes(WriterID, EpisodeID) VALUES(?, ?);";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ss", $WriterID, $EpisodeID);
    $res = mysqli_stmt_execute($stmt);
}

echo "<script type='text/javascript'>window.location.href='../update/writer.php?status=success&id=$WriterID';</script>";

include "../mysql_close.php";

?>

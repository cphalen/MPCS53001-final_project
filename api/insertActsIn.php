<?php

include "../navigation.php";
include "../mysql_connect.php";

$ActorName = $_POST[ActorName];
$EpisodeTitle = $_POST[EpisodeTitle];

$stmt = mysqli_stmt_init($conn);

$query = "SELECT ActorID FROM Actor WHERE Name = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $ActorName);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that the actor actually
// exists by the name given
if(mysqli_num_rows($res) == 0) {
    echo "<script type='text/javascript'>window.location.href='../insert/actsIn.php?status=noSuchActorName&name=$ActorName';</script>";
    die();
} else {
    $row = mysqli_fetch_row($res);
    $ActorID = $row[0];
}

$query = "SELECT EpisodeID FROM Episode WHERE Title = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $EpisodeTitle);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that the actor actually
// exists by the name given
if(mysqli_num_rows($res) == 0) {
    echo "<script type='text/javascript'>window.location.href='../insert/actsIn.php?status=noSuchEpisodeTitle&name=$ActorName';</script>";
    die();
} else {
    $row = mysqli_fetch_row($res);
    $EpisodeID = $row[0];
}

$query = "INSERT INTO ActsIn(ActorID, EpisodeID) VALUES(?, ?);";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ss", $ActorID, $EpisodeID);
    $res = mysqli_stmt_execute($stmt);
}

echo "<script type='text/javascript'>window.location.href='../update/actor.php?status=success&id=$ActorID';</script>";

include "../mysql_close.php";

?>

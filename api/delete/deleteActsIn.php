<?php

include "../../navigation.php";
include "../../mysql_connect.php";

$ActorID = htmlspecialchars($_GET["ActorID"]);
$EpisodeID = htmlspecialchars($_GET["EpisodeID"]);

$stmt = mysqli_stmt_init($conn);

$query = "DELETE FROM ActsIn WHERE ActorID=? AND EpisodeID=?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
    die();
} else {
    mysqli_stmt_bind_param($stmt, "ss", $ActorID, $EpisodeID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

if(mysqli_affected_rows($conn) != 0) {
    echo "<script type='text/javascript'>window.location.href='../../update/actor.php?status=success&id=$ActorID';</script>";
} else {
    echo "<script type='text/javascript'>window.location.href='../../update/actor.php?status=unknownFailure&id=$ActorID';</script>";
}

?>

<?php

include "../../navigation.php";
include "../../mysql_connect.php";

$EpisodeID = htmlspecialchars($_GET["id"]);

$stmt = mysqli_stmt_init($conn);

$query = "DELETE FROM Episode WHERE EpisodeID=?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
    die();
} else {
    mysqli_stmt_bind_param($stmt, "s", $EpisodeID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

if(mysqli_affected_rows($conn) != 0) {
    echo "<script type='text/javascript'>window.location.href='../../insert/episode.php?status=success';</script>";
} else {
    echo "<script type='text/javascript'>window.location.href='../../insert/episode.php?status=unknownFailure';</script>";
}

?>

<?php

include "../../navigation.php";
include "../../mysql_connect.php";

$ActorID = htmlspecialchars($_GET["id"]);

$stmt = mysqli_stmt_init($conn);

$query = "DELETE FROM Actor WHERE ActorID=?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
    die();
} else {
    mysqli_stmt_bind_param($stmt, "s", $ActorID);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

if(mysqli_affected_rows($conn) != 0) {
    echo "<script type='text/javascript'>window.location.href='../../insert/actor.php?status=success';</script>";
} else {
    echo "<script type='text/javascript'>window.location.href='../../insert/actor.php?status=unknownFailure';</script>";
}

?>

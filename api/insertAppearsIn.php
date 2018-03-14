<?php

include "../navigation.php";
include "../mysql_connect.php";

$RoleName = $_POST[RoleName];
$EpisodeTitle = $_POST[EpisodeTitle];

$stmt = mysqli_stmt_init($conn);

$query = "SELECT RoleID FROM Role WHERE Name = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $RoleName);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that the role actually
// exists by the name given
if(mysqli_num_rows($res) == 0) {
    echo "<script type='text/javascript'>window.location.href='../insert/appearsIn.php?status=noSuchRoleName&name=$RoleName';</script>";
    die();
} else {
    $row = mysqli_fetch_row($res);
    $RoleID = $row[0];
}

$query = "SELECT EpisodeID FROM Episode WHERE Title = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $EpisodeTitle);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that the role actually
// exists by the name given
if(mysqli_num_rows($res) == 0) {
    echo "<script type='text/javascript'>window.location.href='../insert/appearsIn.php?status=noSuchEpisodeTitle&name=$RoleName';</script>";
    die();
} else {
    $row = mysqli_fetch_row($res);
    $EpisodeID = $row[0];
}

$query = "INSERT INTO AppearsIn(RoleID, EpisodeID) VALUES(?, ?);";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ss", $RoleID, $EpisodeID);
    $res = mysqli_stmt_execute($stmt);
}

echo "<script type='text/javascript'>window.location.href='../update/role.php?status=success&id=$RoleID';</script>";

include "../mysql_close.php";

?>

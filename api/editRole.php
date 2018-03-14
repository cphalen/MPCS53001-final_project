<?php

// One page handles both of the inserts and updates so that we only
// have the run the checks to ensure that data is valid from one location

include "../navigation.php";
include "../mysql_connect.php";

$RoleName = $_POST[RoleName];
$Description = $_POST[Description];
$ActorName = $_POST[ActorName];

$mode = htmlspecialchars($_GET["mode"]);
if($mode == "update") {
    $RoleID = htmlspecialchars($_GET["id"]);
}
$stmt = mysqli_stmt_init($conn);

$query = "SELECT RoleID FROM Role WHERE Name = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
    die();
} else {
    mysqli_stmt_bind_param($stmt, "s", $RoleName);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that there is not already
// an role saved with this same
// name, that would be problematic
if($mode == "insert") {
    if(mysqli_num_rows($res) != 0) {
        echo "<script type='text/javascript'>window.location.href='../insert/role.php?status=alreadySuchName';</script>";
        die();
    }
} elseif ($mode == "update") {
    if(mysqli_num_rows($res) != 0) {
        $row = mysqli_fetch_row($res);
        if($row[0] != $RoleID) {
            echo "<script type='text/javascript'>window.location.href='../update/role.php?status=alreadySuchName&id=$RoleID';</script>";
            die();
        }
        // Only die when inserting if the
        // name is not the original name
        // we cannot throw them an error
        // for not changing the name
    }
}

$query = "SELECT ActorID FROM Actor WHERE Name = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">The server ran into trouble processing the 2nd given request -- please double check your inputs and try again!</div>';
    die();
} else {
    mysqli_stmt_bind_param($stmt, "s", $ActorName);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that there is actually an
// actor saved with this same
// name to check referential
// integrity
if($mode == "insert") {
    if(mysqli_num_rows($res) == 0) {
        echo "<script type='text/javascript'>window.location.href='../insert/role.php?status=noSuchActorName';</script>";
        die();
    }
} elseif ($mode == "update") {
    if(mysqli_num_rows($res) == 0) {
        echo "<script type='text/javascript'>window.location.href='../update/role.php?status=noSuchActorName&id=$RoleID';</script>";
        die();
    }
}

$row = mysqli_fetch_row($res);
$ActorID = $row[0];

if($mode == "insert") {
    $query = "INSERT INTO Role(RoleID, Name, Description, ActorID) VALUES(DEFAULT, ?, ?, ?);";
} elseif ($mode == "update") {
    // We fetch the RoleID ourselves so we know that it cannot be hazardous
    $query = "UPDATE Role SET Name=?, Description=?, ActorID=? WHERE RoleID = $RoleID;";
}
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">The server ran into trouble processing the fourth given request -- please double check your inputs and try again!</div>';
    die();
} else {
    mysqli_stmt_bind_param($stmt, "sss", $RoleName, $Description, $ActorID);
    $res = mysqli_stmt_execute($stmt);
}

if($mode == "insert") {
        if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../insert/role.php?status=success';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../insert/role.php?status=unknownFailure';</script>";
    }
} elseif ($mode == "update") {
    if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../update/role.php?status=success&id=$RoleID';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../update/role.php?status=unknownFailure&id=$RoleID';</script>";
    }
}

include "../mysql_close.php";

?>

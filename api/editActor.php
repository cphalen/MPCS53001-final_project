<?php

// One page handles both of the inserts and updates so that we only
// have the run the checks to ensure that data is valid from one location

include "../navigation.php";
include "../mysql_connect.php";

$ActorName = $_POST[ActorName];
$DateOfBirth = $_POST[Birthday];

$mode = htmlspecialchars($_GET["mode"]);
if($mode == "update") {
    $ActorID = htmlspecialchars($_GET["id"]);
}
$stmt = mysqli_stmt_init($conn);

$query = "SELECT ActorID FROM Actor WHERE Name = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $ActorName);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that there is not already
// an actor saved with this same
// name, that would be problematic
if($mode == "insert") {
    if(mysqli_num_rows($res) != 0) {
        echo "<script type='text/javascript'>window.location.href='../insert/actor.php?status=alreadySuchName';</script>";
        die();
    }
} elseif ($mode == "update") {
    if(mysqli_num_rows($res) != 0) {
        $row = mysqli_fetch_row($res);
        if($row[0] != $ActorID) {
            echo "<script type='text/javascript'>window.location.href='../update/actor.php?status=alreadySuchName&id=$ActorID';</script>";
            die();
        }
        // Only die when inserting if the
        // name is not the original name
        // we cannot throw them an error
        // for not changing the name
    }
}

if($mode == "insert") {
    $query = "INSERT INTO Actor(ActorID, Name, DateOfBirth) VALUES(DEFAULT, ?, ?);";
} elseif ($mode == "update") {
    // We fetch the ActorID ourselves so we know that it cannot be hazardous
    $query = "UPDATE Actor SET Name=?, DateOfBirth=? WHERE ActorID = $ActorID;";
}

if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ss", $ActorName, $DateOfBirth);
    $res = mysqli_stmt_execute($stmt);
}

if($mode == "insert") {
    if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../insert/actor.php?status=success';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../insert/actor.php?status=unknownFailure';</script>";
    }
} elseif ($mode == "update") {
    if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../update/actor.php?status=success&id=$ActorID';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../update/actor.php?status=unknownFailure&id=$ActorID';</script>";
    }
}

include "../mysql_close.php";

?>

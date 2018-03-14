<?php

// One page handles both of the inserts and updates so that we only
// have the run the checks to ensure that data is valid from one location

include "../navigation.php";
include "../mysql_connect.php";

$WriterName = $_POST[WriterName];
$DateOfBirth = $_POST[Birthday];

$mode = htmlspecialchars($_GET["mode"]);
if($mode == "update") {
    $WriterID = htmlspecialchars($_GET["id"]);
}
$stmt = mysqli_stmt_init($conn);

$query = "SELECT WriterID FROM Writer WHERE Name = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $WriterName);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that there is not already
// an writer saved with this same
// name, that would be problematic
if($mode == "insert") {
    if(mysqli_num_rows($res) != 0) {
        echo "<script type='text/javascript'>window.location.href='../insert/writer.php?status=alreadySuchName';</script>";
        die();
    }
} elseif ($mode == "update") {
    if(mysqli_num_rows($res) != 0) {
        $row = mysqli_fetch_row($res);
        if($row[0] != $WriterID) {
            echo "<script type='text/javascript'>window.location.href='../update/writer.php?status=alreadySuchName&id=$WriterID';</script>";
            die();
        }
        // Only die when inserting if the
        // name is not the original name
        // we cannot throw them an error
        // for not changing the name
    }
}

if($mode == "insert") {
    $query = "INSERT INTO Writer(WriterID, Name, DateOfBirth) VALUES(DEFAULT, ?, ?);";
} elseif ($mode == "update") {
    // We fetch the WriterID ourselves so we know that it cannot be hazardous
    $query = "UPDATE Writer SET Name=?, DateOfBirth=? WHERE WriterID = $WriterID;";
}

if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ss", $WriterName, $DateOfBirth);
    $res = mysqli_stmt_execute($stmt);
}

if($mode == "insert") {
    if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../insert/writer.php?status=success';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../insert/writer.php?status=unknownFailure';</script>";
    }
} elseif ($mode == "update") {
    if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../update/writer.php?status=success&id=$WriterID';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../update/writer.php?status=unknownFailure&id=$WriterID';</script>";
    }
}

include "../mysql_close.php";

?>

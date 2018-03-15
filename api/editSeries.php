<?php

// One page handles both of the inserts and updates so that we only
// have the run the checks to ensure that data is valid from one location

include "../navigation.php";
include "../mysql_connect.php";

$SeriesTitle = $_POST[SeriesTitle];
$YearRange = $_POST[YearRange];
$Description = $_POST[Description];

$mode = htmlspecialchars($_GET["mode"]);
// In update mode the SeriesTitle actually does
// not come from the form becuase it must be
// immuatable to satisfy foreign key constraints
if($mode == "update") {
    $SeriesTitle = htmlspecialchars($_GET["id"]);
}
$stmt = mysqli_stmt_init($conn);

$query = "SELECT SeriesTitle FROM Series WHERE SeriesTitle = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $SeriesTitle);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that there is not already
// a series saved with this same
// title, that would be problematic
if($mode == "insert") {
    if(mysqli_num_rows($res) != 0) {
        echo "<script type='text/javascript'>window.location.href='../insert/series.php?status=alreadySuchSeriesTitle';</script>";
        die();
    }
} elseif ($mode == "update") {
    if(mysqli_num_rows($res) != 0) {
        $row = mysqli_fetch_row($res);
        if($row[0] != $SeriesTitle) {
            echo "<script type='text/javascript'>window.location.href='../update/series.php?status=alreadySuchSeriesTitle&id=$SeriesTitle';</script>";
            die();
        }
        // Only die when inserting if the
        // series and season number is not
        // the original series and season number
        // we cannot throw them an error
        // for not changing the name
    }
}


if($mode == "insert") {
    // We fetch the SeriesTitle ourselves so we know that it cannot be hazardous
    $query = "INSERT INTO Series(SeriesTitle, YearRange, Description) VALUES('$SeriesTitle', ?, ?);";
    echo $query;
} elseif ($mode == "update") {
    // We fetch the SeriesTitle ourselves so we know that it cannot be hazardous
    $query = "UPDATE Series SET YearRange=?, Description=? WHERE SeriesTitle = '$SeriesTitle';";
}

if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">ILLLLLLnternal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ss", $YearRange, $Description);
    $res = mysqli_stmt_execute($stmt);
}

if($mode == "insert") {
    if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../insert/series.php?status=success';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../insert/series.php?status=unknownFailure';</script>";
    }
} elseif ($mode == "update") {
    if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../update/series.php?status=success&id=$SeriesTitle';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../update/series.php?status=unknownFailure&id=$SeriesTitle';</script>";
    }
}

include "../mysql_close.php";

?>

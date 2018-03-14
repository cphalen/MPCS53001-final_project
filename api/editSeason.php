<?php

// One page handles both of the inserts and updates so that we only
// have the run the checks to ensure that data is valid from one location

include "../navigation.php";
include "../mysql_connect.php";

$SeriesTitle = $_POST[SeriesTitle];
$SeasonNumber = $_POST[SeasonNumber];
$Year = $_POST[Year];
$Description = $_POST[Description];

$mode = htmlspecialchars($_GET["mode"]);
if($mode == "update") {
    $SeasonID = htmlspecialchars($_GET["id"]);
}
$stmt = mysqli_stmt_init($conn);

$query = "SELECT SeasonID FROM Season WHERE SeasonNumber = ? AND SeriesTitle = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ss", $SeasonNumber, $SeriesTitle);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that there is not already
// a season saved with this same
// serties title and season number
if($mode == "insert") {
    if(mysqli_num_rows($res) != 0) {
        echo "<script type='text/javascript'>window.location.href='../insert/season.php?status=alreadySuchSeasonNumberAndSeriesTitle';</script>";
        die();
    }
} elseif ($mode == "update") {
    if(mysqli_num_rows($res) != 0) {
        $row = mysqli_fetch_row($res);
        if($row[0] != $SeasonID) {
            echo "<script type='text/javascript'>window.location.href='../update/season.php?status=alreadySuchSeasonNumberAndSeriesTitle&id=$SeasonID';</script>";
            die();
        }
        // Only die when inserting if the
        // series and season number is not
        // the original series and season number
        // we cannot throw them an error
        // for not changing the name
    }
}

$query = "SELECT SeriesTitle FROM Series WHERE SeriesTitle = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $SeriesTitle);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that the series begin
// referenced actually exists
if($mode == "insert") {
    if(mysqli_num_rows($res) == 0) {
        echo "<script type='text/javascript'>window.location.href='../insert/season.php?status=noSuchSeries';</script>";
        die();
    }
} elseif ($mode == "update") {
    if(mysqli_num_rows($res) == 0) {
        $row = mysqli_fetch_row($res);
        if($row[0] != $SeasonID) {
            echo "<script type='text/javascript'>window.location.href='../update/season.php?status=noSuchSeries&id=$SeasonID';</script>";
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
    $query = "INSERT INTO Season(SeasonID, SeasonNumber, Year, Description, SeriesTitle) VALUES(DEFAULT, ?, ?, ?, ?);";
} elseif ($mode == "update") {
    // We fetch the SeasonID ourselves so we know that it cannot be hazardous
    $query = "UPDATE Season SET SeasonNumber=?, Year=?, Description=?, SeriesTitle=? WHERE SeasonID = $SeasonID;";
}

if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">Internal server error -- please contact site administrators. Our apologies!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ssss", $SeasonNumber, $Year, $Description, $SeriesTitle);
    $res = mysqli_stmt_execute($stmt);
}

if($mode == "insert") {
    if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../insert/Season.php?status=success';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../insert/Season.php?status=unknownFailure';</script>";
    }
} elseif ($mode == "update") {
    if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../update/Season.php?status=success&id=$SeasonID';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../update/Season.php?status=unknownFailure&id=$SeasonID';</script>";
    }
}

include "../mysql_close.php";

?>

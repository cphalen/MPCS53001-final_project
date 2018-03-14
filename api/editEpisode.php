<?php

// One page handles both of the inserts and updates so that we only
// have the run the checks to ensure that data is valid from one location

include "../navigation.php";
include "../mysql_connect.php";

$EpisodeTitle = $_POST[EpisodeTitle];
$EpisodeNumber = $_POST[EpisodeNumber];
$Description = $_POST[Description];
$SeriesTitle = $_POST[SeriesTitle];
$SeasonNumber = $_POST[SeasonNumber];
$AirDate = $_POST[AirDate];
// Translate radio button responses
// into what we want the backend to see
// in essence 'on' == 1 and '' == 0
if($_POST[Favorite] != "") {
    $Favorite =  1;
} else {
    $Favorite = 0;
}

$mode = htmlspecialchars($_GET["mode"]);
if($mode == "update") {
    $EpisodeID = htmlspecialchars($_GET["id"]);
}
$stmt = mysqli_stmt_init($conn);

$query = "SELECT EpisodeID FROM Episode WHERE Title = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">The server ran into trouble processing the second given request -- please double check your inputs and try again!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "s", $EpisodeTitle);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that there is not already
// an episode saved with this same
// title, that would be problematic
if($mode == "insert") {
    if(mysqli_num_rows($res) != 0) {
        echo "<script type='text/javascript'>window.location.href='../insert/episode.php?status=alreadySuchEpisodeTitle';</script>";
        die();
    }
} elseif ($mode == "update") {
    // Only die if inserting
    // when we upate it is assumed that
    // the episode will already exist
    if(mysqli_num_rows($res) != 0) {
        $row = mysqli_fetch_row($res);
        $EpisodeID = $row[0];
    }
}

$query = "SELECT SeasonID FROM Season WHERE SeriesTitle = ? AND SeasonNumber = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">The server ran into trouble processing the first given request -- please double check your inputs and try again!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ss", $SeriesTitle, $SeasonNumber);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Make sure we get a response otherwise the
// SeasonNumber + SeriesTitle the user
// input was not valid
if($mode == "insert") {
    if(mysqli_num_rows($res) == 0) {
        echo "<script type='text/javascript'>window.location.href='../insert/episode.php?status=noSuchSeason';</script>";
        die();
    } else {
        $row = mysqli_fetch_row($res);
        $SeasonID = $row[0];
    }
} elseif ($mode == "update") {
    if(mysqli_num_rows($res) == 0) {
        echo "<script type='text/javascript'>window.location.href='../update/episode.php?status=noSuchSeason&id=$EpisodeID';</script>";
        die();
    } else {
        $row = mysqli_fetch_row($res);
        $SeasonID = $row[0];
    }
}

$query = "SELECT EpisodeID FROM Episode WHERE SeasonID = ? AND EpisodeNumber = ?;";
if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">The server ran into trouble processing the third given request -- please double check your inputs and try again!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ss", $SeasonID, $EpisodeNumber);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
}

// Ensure that there is not already
// an episode saved with this same
// SeasonID and EpisodeNumber
if($mode == "insert") {
    if(mysqli_num_rows($res) != 0) {
        echo "<script type='text/javascript'>window.location.href='../insert/episode.php?status=alreadySuchEpisodeNumberInSeason';</script>";
        die();
    }
} elseif ($mode == "update") {
    if(mysqli_num_rows($res) != 0) {
        $row = mysqli_fetch_row($res);
        echo $row[0];
        if($row[0] != $EpisodeID) {
            echo "<script type='text/javascript'>window.location.href='../update/episode.php?status=alreadySuchEpisodeNumberInSeason&id=$EpisodeID';</script>";
            die();
        }
    }
}

if($mode == "insert") {
    $query = "INSERT INTO Episode(EpisodeID, Title, EpisodeNumber, Airdate, Description, SeasonID, Favorite) VALUES(DEFAULT, ?, ?, ?, ?, ?, ?);";
} elseif ($mode == "update") {
    // We fetch the EpisodeID ourselves so we know that it cannot be hazardous
    $query = "UPDATE Episode SET Title=? AND EpisodeNumber=? AND Airdate=? AND Description=? AND SeasonID=? AND Favorite=? WHERE EpisodeID = $EpisodeID;";
}

if (!mysqli_stmt_prepare($stmt, $query)) {
    echo '<div class="alert alert-danger" role="alert">The server ran into trouble processing the fourth given request -- please double check your inputs and try again!</div>';
} else {
    mysqli_stmt_bind_param($stmt, "ssssss", $EpisodeTitle, $EpisodeNumber, $AirDate, $Description, $SeasonID, $Favorite);
    $res = mysqli_stmt_execute($stmt);
}

if($mode == "insert") {
    if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../insert/episode.php?status=success';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../insert/episode.php?status=unknownFailure';</script>";
    }
} elseif ($mode == "update") {
    if($res == True) {
        echo "<script type='text/javascript'>window.location.href='../update/episode.php?status=success&id=$EpisodeID';</script>";
    } else {
        echo "<script type='text/javascript'>window.location.href='../update/episode.php?status=unknownFailure&id=$EpisodeID';</script>";
    }
}

include "../mysql_close.php";

?>

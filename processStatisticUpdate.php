<?php
require("sanitize.php");

// create short variable names
$name       = sanitize($_POST['name']);
$time       = sanitize($_POST['time']);
$points     = (int) $_POST['points'];
$assists    = (int) $_POST['assists'];
$rebounds   = (int) $_POST['rebounds'];

if(!empty($name)) {

    require('PlayerStatistic.php');

    $newStat = new PlayerStatistic($name, $time, $points, $assists, $rebounds);

    // create db connection
    $dbhost = "localhost";
    $dbuser = "csufadmin";
    $dbpass = "password";
    $dbname = "db_csuf_bball_team";
    $dbconn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    $query = "
        INSERT INTO
            Statistics
        SET
            PlayingTimeMin = ?,
            PlayingTimeSec = ?,
            Points = ?,
            Assists = ?,
            Rebounds = ?,
            Player = (
            SELECT
                ID
            FROM
                TeamRoster
            WHERE
                Name_Last = ? AND Name_First = ?
        )";

    $stmt = mysqli_prepare($dbconn, $query);

    // Create variables to be bound
    $fullname     = explode(",", $newStat->name());
    $fname    = trim($fullname[1]);
    $lname    = trim($fullname[0]);
    $time     = explode(":", $newStat->playingTime());
    $timeMin  = (int) $time[0];
    $timeSec  = (int) $time[1];
    $points   = $newStat->pointsScored();
    $assists  = $newStat->assists();
    $rebounds = $newStat->rebounds();

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'iiiiiss', $timeMin, $timeSec, $points,
            $assists, $rebounds, $lname, $fname);
        mysqli_stmt_execute($stmt);
    }
}

require('home_page.php');
?>


<?php

require_once("sanitize.php");

// create short variable names
$name    = array(sanitize($_POST['firstName']), sanitize($_POST['lastName']));
$street  = sanitize($_POST['street']);
$city    = sanitize($_POST['city']);
$state   = sanitize($_POST['state']);
$country = sanitize($_POST['country']);
$zip     = (int) $_POST['zipCode'];

if(!empty($name[1])) {

    require('Address.php');

    $newAdder = new Address($name, $street, $city, $state, $country, $zip);

    // create db connection
    $dbhost = "localhost";
    $dbuser = "csufadmin";
    $dbpass = "password";
    $dbname = "db_csuf_bball_team";
    $dbconn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    $query = "INSERT INTO TeamRoster VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($dbconn, $query);

    // Create variables to be bound
    $fullname = explode(",", $newAdder->name());
    $fname    = null;
    if (isset($fullname[1])) {
        $fname = trim($fullname[1]) == "" ? null : trim($fullname[1]);
    }
    $lname    = trim($fullname[0]);
    $street   = $newAdder->street() == "" ? null : $newAdder->street();
    $city     = $newAdder->city() == "" ? null : $newAdder->city();
    $state    = $newAdder->state() == "" ? null : $newAdder->state();
    $country  = $newAdder->country() == "" ? null : $newAdder->country();
    $zip      = $newAdder->zip() == "" ? null : $newAdder->zip();

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssssss', $fname, $lname, $street, $city,
            $state, $country, $zip);
        if (!mysqli_stmt_execute($stmt)) {
            echo "SQL execution failed";
        }
    }
}

require('home_page.php');

?>


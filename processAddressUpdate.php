<?php
require("sanitize.php");

// create short variable names
$name    = array(sanatize($_POST['firstName']), sanatize($_POST['lastName']));
// $lname   =  sanatize($_POST['lastName']);
$street  = sanatize($_POST['street']);
$city    = sanatize($_POST['city']);
$state   = sanatize($_POST['state']);
$country = sanatize($_POST['country']);
$zip     = (int) $_POST['zipCode'];

if(!empty($name[0])) {

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
    $fname   = $newAdder->fname();
    $lname   = $newAdder->lname();
    $street  = $newAdder->street();
    $city    = $newAdder->city();
    $state   = $newAdder->state();
    $country = $newAdder->country();
    $zip     = $newAdder->zip();

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssssss', $fname, $lname, $street, $city,
            $state, $country, $zip);
        mysqli_stmt_execute($stmt);

    }
}

require('home_page.php');
?>


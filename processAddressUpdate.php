<?php

// create short variable names
$name    = array($_POST['firstName'], $_POST['lastName']);
$street  = $_POST['street'];
$city    = $_POST['city'];
$state   = $_POST['state'];
$zip     = (int) $_POST['zipCode'];



require('Address.php');

$newAdder = new Address($name, $street, $city, $state, $zip);

if( ! empty($name) ) {
  file_put_contents('../data/roster.txt', $newAdder->toTSV()."\n", FILE_APPEND | LOCK_EX);
}

require('home_page.php');
?>


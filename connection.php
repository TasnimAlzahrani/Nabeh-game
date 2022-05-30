<?php

$dbhost = "localhost";
$dbuser = "tasneem";
$dbpass = "password";
$dbname = "nabeh";

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

// reuseable connection with database
if (!$con  = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die('<p>Could not connect to MySQL because: <b>' . mysqli_error($dbc) . '</b></p>');
}

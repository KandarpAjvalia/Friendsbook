<?php
ob_start();

$timezone = date_default_timezone_set("America/New_York");

session_start();
$connection = mysqli_connect("localhost", "root", "", "socialmediadatabase");

if(mysqli_connect_errno()) {
    echo "Failed to connect".mysqli_connect_error();
}
?>
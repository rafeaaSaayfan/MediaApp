<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "mediaapp";

$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if(mysqli_connect_errno()) {
    echo "Failed to connect";
    exit();
}
?>

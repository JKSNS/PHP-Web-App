<?php
session_start();

$sname= "mariadb";
$uname= "jackyroo";
$password = "Yabadabadoo";
$db_name = "lab_3";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
    exit(); // Add this line to stop script execution
}

?>

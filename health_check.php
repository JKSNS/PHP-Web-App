<?php
// ./actions/health_check.php

// Read variables and create connection

session_start();
echo "SESSION VARIABLES <br>";
var_dump($_SESSION);

$mysql_servername = getenv("mariadb");
$mysql_user = getenv("jackyroo");
$mysql_password = getenv("Yabadabadoo");
$mysql_database = getenv("lab_3");

// This section for DEBUGGING ONLY! COMMENT-OUT WHEN FINISHED
echo "<p>mysql_servername: $mysql_servername</p>";
echo "<p>mysql_user: $mysql_user</p>";
echo "<p>mysql_password: $mysql_password</p>";
echo "<p>mysql_database: $mysql_database</p>";

$conn = new mysqli($mysql_servername, $mysql_user, $mysql_password, $mysql_database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else {
	echo "Database Connection Success";
}

?>
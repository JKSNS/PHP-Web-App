<?php
// Start the session (if not already started)
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login screen
header("Location: login-screen.php");
exit();
?>

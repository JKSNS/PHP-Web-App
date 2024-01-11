<?php
session_start();
// Database connection code here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function sanitizeInput($input) {
        // Prevents XSS and SQL Inject
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    $username = sanitizeInput($_POST["uname"]);
    $password = sanitizeInput($_POST["password"]);
    $confirmPassword = sanitizeInput($_POST["confirm_password"]);

    // Check if passwords match
    if ($password !== $confirmPassword) {
        header("Location: register.php?error=Passwords do not match");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Database connection parameters
    $servername = "mariadb"; // Change this if your database is hosted elsewhere
    $dbusername = "jackyroo";
    $dbpassword = "Yabadabadoo";
    $dbname = "lab_3";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform a SQL query to check if the username exists
    $checkUsernameQuery = "SELECT * FROM users WHERE user_name='$username'";
    $result = $conn->query($checkUsernameQuery);

    if ($result->num_rows > 0) {
        header("Location: register.php?error=Username already exists");
        exit();
    } else {
        // Insert new user into the database
        $insertUserQuery = "INSERT INTO users (user_name, password, logged_in) VALUES ('$username', '$hashedPassword', 'true')";
        if ($conn->query($insertUserQuery) === TRUE) {
            // Set session variables
            session_start();
            $_SESSION["logged_in"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $conn->insert_id;

            // Redirect to the application's home page (index.php)
            header("Location: login-screen.php");
            exit();
        } else {
            // Log the specific database error
            error_log("Error: " . $insertUserQuery . "<br>" . $conn->error);
            header("Location: register.php?error=Registration failed. Please try again later.");
            exit();
        }
    }

    // Close the database connection
    $conn->close();
} else {
    header("Location: register.php");
    exit();
}
?>

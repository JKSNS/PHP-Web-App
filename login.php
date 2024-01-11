<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
		// preventing JS XSS attacks and SQL Inject
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Added input sanitization
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: login-screen.php?error=User Name is required");
        exit();
    } elseif (empty($pass)) {
        header("Location: login-screen.php?error=Password is required");
        exit();
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_name = ?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($pass, $row['password'])) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: index.php");
                exit();
            } else {
                header("Location: login-screen.php?error=Incorrect User name or password");
                exit();
            }
        } else {
            header("Location: login-screen.php?error=Incorrect User name or password");
            exit();
        }
    }
} else {
    header("Location: login-screen.php");
    exit();
}

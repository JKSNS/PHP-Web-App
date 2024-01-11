<?php
session_start();

if(isset($_POST['title']) && isset($_POST['task_date'])){
    require '../db_conn.php';

    // Sanitize user input
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $taskDate = htmlspecialchars($_POST['task_date'], ENT_QUOTES, 'UTF-8');

    if(empty($title) || empty($taskDate)){
        $_SESSION['message'] = 'error';
        header("Location: ../index.php");
        exit();
    } else {
        // PREPARED STATEMENTS for all user input into the database
        $stmt = $conn->prepare("INSERT INTO todos (title, date_time) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $taskDate);

        if($stmt->execute()){
            $_SESSION['message'] = 'success';
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['message'] = 'error';
            header("Location: ../index.php");
            exit();
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
} else {
    $_SESSION['message'] = 'error';
    header("Location: ../index.php");
    exit();
}
?>

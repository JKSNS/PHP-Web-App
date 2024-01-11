<?php
session_start();
include '../db_conn.php';

if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['date'])) {
    $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
    $title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
    $date = htmlspecialchars($_POST['date'], ENT_QUOTES, 'UTF-8');

    // Update task in the database
    $stmt = $conn->prepare("UPDATE todos SET title=?, date_time=? WHERE id=?");
    $stmt->bind_param("ssi", $title, $date, $id);

    if($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'error';
}
?>

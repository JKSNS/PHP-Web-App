<?php
session_start();
if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
    $stmt->bind_param("i", $id); // Assuming 'id' is an integer

    if($stmt->execute()){
        echo "success";
    } else {
        echo "error";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
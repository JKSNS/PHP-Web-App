<?php
session_start();
include 'db_conn.php';

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['id']) || !isset($_SESSION['user_name'])) {
    header("Location: login-screen.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BYU IT&C 210 To-Do List</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Additional CSS styles for the navbar and tasks */
        .navbar {
            overflow: hidden;
            background-color: #333;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: white;
            color: black;
        }

        .todo-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="https://www.byu.edu/">BYU Home</a>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">Error 404</a>
        <a href="https://ece.byu.edu/cybersecurity-flowcharts">BYU Electrical and Computer Engineering</a>
    </div>
    <br><br>

    <!-- Page Content -->
    <div class="main-section">
        <!-- H1 Title -->
        <h1>BYU IT&C 210</h1>
        <!-- Description -->
        <br>

        <!-- To-Do List Form -->
        <div class="add-section">
            <form action="app/add.php" method="POST" autocomplete="off">
                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                    <input type="text" 
                        name="title" 
                        style="border-color: #ff6666"
                        placeholder="This field is required" />
                <?php } else { ?>
                    <input type="text" 
                        name="title" 
                        placeholder="Add Task: " 
                        required />
                <?php } ?>
                <input type="date" 
                    name="task_date" 
                    required 
                    style="margin-left: 10px;" />
                <button type="submit">Add</button>
            </form>
        </div>

        <h2>My tasks:</h2>

        <!-- To-Do List -->
        <?php 
            $query = "SELECT * FROM todos ORDER BY id DESC";
            $result = $conn->query($query);

            if ($result->num_rows <= 0) {
                echo '<div class="todo-item">
                        <div class="empty">
                            <img src="img/3Bgif.gif" width="80px">
                        </div>  
                    </div>';
            } else {
                while ($todo = $result->fetch_assoc()) {
                    echo '<div class="todo-item">
                            <span id="' . $todo['id'] . '" class="remove-to-do">x</span>';
                    
                    if ($todo['checked']) {
                        echo '<input type="checkbox" class="check-box" data-todo-id="' . $todo['id'] . '" checked />';
                        echo '<h2 class="checked">' . $todo['title'] . '</h2>';
                    } else {
                        echo '<input type="checkbox" data-todo-id="' . $todo['id'] . '" class="check-box" />';
                        echo '<h2>' . $todo['title'] . '</h2>';
                    }

                    // Edit button added below the task text
                    echo '<button class="edit-button">Edit</button>';

                    // Format the date in the desired format: Month-Day-Year
                    $formattedDate = date("m/d/Y", strtotime($todo['date_time']));
                    echo '<br><small> ' . $formattedDate . '</small></div>';
                }
            }

            // Free the result set
            $result->free_result();
        ?>
    </div>

    <!-- Logout Button -->
    <div class="logout-section">
        <form action="logout.php" method="POST">
            <button class="logout" type="submit">Logout</button>
        </form>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                
                $.post('app/check.php', 
                      {
                          id: id
                      },
                      (data) => {
                          if(data !== 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                              } else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });

            $(".edit-button").click(function(e){
                const id = $(this).siblings('.remove-to-do').attr('id');
                const newTitle = prompt("Enter new task description:");
                const newDate = prompt("Enter new task date (YYYY-MM-DD):");

                if(newTitle && newDate) {
                    $.post('app/update.php', {
                        id: id,
                        title: newTitle,
                        date: newDate
                    }, function(data) {
                        if(data === 'success') {
                            // Update task on the web page
                            $(`#${id} + .check-box + h2`).text(newTitle);
                            const formattedDate = new Date(newDate).toLocaleDateString();
                            $(`#${id} + .check-box + h2 + br + small`).text(formattedDate);
                        } else {
                            alert("Failed to update task. Please try again.");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>

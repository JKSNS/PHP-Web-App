<!DOCTYPE html>
<html>
<head>
    <title>REGISTER</title>
    <link rel="stylesheet" type="text/css" href="style.login.css">
</head>
<body>
     <form action="register_action.php" method="post">
        <h2>REGISTER</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'); ?></p>
        <?php } ?>
        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name" value="<?php echo htmlspecialchars(isset($_POST['uname']) ? $_POST['uname'] : '', ENT_QUOTES, 'UTF-8'); ?>" required><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password" required><br>

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>

        <button type="submit">Register</button>
     </form>
</body>
</html>

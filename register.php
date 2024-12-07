<?php
session_start();
require_once 'db.php';
require_once 'user.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = DatabaseConfig::getConnection();
    $user = new User($db);

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirm'];

    if ($password !== $passwordConfirm) {
        $error = "Passwords do not match";
    } elseif ($user->register($username, $password)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "An error occurred while registering. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - To-Do List</title>
    <link rel="stylesheet" href="login-register.css">
</head>
<body>
    <div class="form-container">
        <h2>Create an Account</h2>
        
        <?php if (!empty($error)): ?>
            <div class="alert"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>

    <script src="login-register.js"></script>
</body>
</html>

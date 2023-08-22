<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'dbconn.php';

include 'UserAuthController.php';

$userAuthController = new UserAuthController($conn);
$errorMessage = $userAuthController->loginUser();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/userlogin.css">
</head>
<body>
<header>
        <h1>Test App</h1>
    </header>
   
    <div class="log">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label>Username or Email:</label>
            <input type="text" name="user" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Login">
        </form>
        <?php
        if (isset($errorMessage)) {
            echo '<p class="error">' . htmlspecialchars($errorMessage) . '</p>';
        }
        ?>
        <a href="UserSignup.php">New user</a>
    </div>
</body>
</html>

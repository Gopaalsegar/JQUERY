
<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <link rel="stylesheet" href="css/signup.css">
</head>

<body>
    <div class="sign">
        <h2>Signup</h2>
        <form action="UserRegistration.php" method="post">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Signup">
        </form>
        <form action="UserLogin.php">
            <input type="submit" value="Login">
        </form>
    </div>
</body>

</html>

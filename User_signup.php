<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// session_start();
include 'dbconn.php';

class UserRegistration {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function RegisterUser(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $sql = "INSERT INTO user_details (username, email, password) VALUES ('$username', '$email', '$password')";

            try {
                if ($this->conn->query($sql) === TRUE) {
                    echo "Signup successful. You can now login.!!!";
                } else {
                    throw new Exception("Error: " . $sql . "<br>" . $this->conn->error);
                }
            } catch (Exception $e) {
                echo "An error occurred: " . $e->getMessage();
            }
        }
    }
}

$userRegistration = new UserRegistration($conn);
$userRegistration->RegisterUser(); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <div class="sign">
        <h2>Signup</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Signup">
        </form>
        <form action="User_login.php">
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
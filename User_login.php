<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'dbconn.php';

class UserAuthController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function loginUser() {
        if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {
            header("Location: test.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST["user"];
            $password = $_POST["password"];

            if ($user == 'Admin' && $password == 'Admin@123') {
                header('Location: Admin_home.php');
                exit;
            }

            $stmt = $this->conn->prepare("SELECT * FROM user_details WHERE username=? OR email=?");
            $stmt->bind_param("ss", $user, $user);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row["password"])) {
                    $_SESSION["user_id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                    header("Location: ready.php");
                    exit();
                } else {
                    $errorMessage = "Invalid username or password.";
                }
            } else {
                $errorMessage = "Invalid username or password.";
            }
        }
        return isset($errorMessage) ? $errorMessage : null;
    }
}

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
        <a href="User_signup.php">New user</a>
    </div>
</body>
</html>

<?php
class UserAuthController
{
    public function __construct(private $conn) {}

    public function loginUser()
    {
        if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {
            header("Location: UserTest.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $_POST["user"];
            $password = $_POST["password"];

            if ($user == 'Admin' && $password == 'Admin@123') {
                header('Location: AdminHome.php');
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
                    header("Location: UserReady.php");
                    exit();
                }


            }
            return "Invalid username or password.";

        }
    }
}



?>
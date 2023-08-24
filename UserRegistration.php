<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'dbconn.php'; 

class UserRegistration
{
    public function __construct(private $conn) {}

    public function RegisterUser()
    {
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

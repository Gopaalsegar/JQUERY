<?php
class DatabaseConnection {
    private $servername;
    private $dbUsername;
    private $dbPassword;
    private $dbname;
    private $conn;

    public function __construct($servername, $dbUsername, $dbPassword, $dbname) {
        $this->servername = $servername;
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
        $this->dbname = $dbname;

        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->servername, $this->dbUsername, $this->dbPassword, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

// Usage
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "admin@123";
$dbname = "testapp";

$databaseConnection = new DatabaseConnection($servername, $dbUsername, $dbPassword, $dbname);
$conn = $databaseConnection->getConnection();

// Close the connection when done
// $databaseConnection->closeConnection();
?>

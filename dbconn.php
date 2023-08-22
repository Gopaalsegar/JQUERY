<?php
class DatabaseConnection {
    private mysqli $conn;

    public function __construct(
        private string $serverName,
        private string $dbUsername,
        private string $dbPassword,
        private string $dbName
    ) {
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->serverName, $this->dbUsername, $this->dbPassword, $this->dbName);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection(): mysqli {
        return $this->conn;
    }
}

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "admin@123";
$dbName = "testapp";

$databaseConnection = new DatabaseConnection($serverName, $dbUsername, $dbPassword, $dbName);
$conn = $databaseConnection->getConnection();
?>
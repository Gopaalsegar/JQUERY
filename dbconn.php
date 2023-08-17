<?php
class DatabaseConnection {
    private $servername;
    private $dbusername;
    private $dbPassword;
    private $dbname;
    private $conn;

    public function __construct($servername, $dbusername, $dbPassword, $dbname) {
        $this->servername = $servername;
        $this->dbusername = $dbusername;
        $this->dbPassword = $dbPassword;
        $this->dbname = $dbname;

        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->servername, $this->dbusername, $this->dbPassword, $this->dbname);

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

$servername = "localhost";
$dbusername = "root";
$dbPassword = "admin@123";
$dbname = "testapp";

$databaseConnection = new DatabaseConnection($servername, $dbusername, $dbPassword, $dbname);
$conn = $databaseConnection->getConnection();


?>

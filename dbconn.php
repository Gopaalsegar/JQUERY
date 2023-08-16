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
        $this->conn = new mysqli($this->servername, $this->dbUsername, $this->dbPassword);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Select the specific database
        if (!$this->conn->select_db($this->dbname)) {
            die("Database selection failed: " . $this->conn->error);
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
$dbUsername = "your_username";
$dbPassword = "your_password";
$dbname = "testapp";

$databaseConnection = new DatabaseConnection($servername, $dbUsername, $dbPassword, $dbname);
$conn = $databaseConnection->getConnection();

// Create the database if it doesn't exist
$createDbSQL = "CREATE DATABASE IF NOT EXISTS " . $dbname;
if ($conn->query($createDbSQL) === TRUE) {
    echo "Database created successfully.";
} else {
    echo "Error creating database: " . $conn->error;
}

// SQL queries to create tables
$createTableUserDetailsSQL = "
    CREATE TABLE IF NOT EXISTS user_details (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(20) UNIQUE KEY,
        email VARCHAR(40) UNIQUE KEY,
        password VARCHAR(255)
    )
";

$createTableQuestionSQL = "
    CREATE TABLE IF NOT EXISTS question (
        question_id INT AUTO_INCREMENT PRIMARY KEY,
        question_text VARCHAR(255),
        option_1 VARCHAR(255),
        option_2 VARCHAR(255),
        option_3 VARCHAR(255),
        option_4 VARCHAR(255),
        correct_option VARCHAR(255),
        subject VARCHAR(20)
    )
";

$createTableSubjectSQL = "
    CREATE TABLE IF NOT EXISTS subject (
        sub_id INT AUTO_INCREMENT PRIMARY KEY,
        subject VARCHAR(20)
    )
";

$createTableResultSQL = "
    CREATE TABLE IF NOT EXISTS result (
        score INT,
        time_taken INT,
        username VARCHAR(20),
        subject VARCHAR(20)
    )
";

$conn->query($createTableUserDetailsSQL);
$conn->query($createTableQuestionSQL);
$conn->query($createTableSubjectSQL);
$conn->query($createTableResultSQL);

echo "Tables created successfully.";

// Close the connection when done
// $databaseConnection->closeConnection();
?>

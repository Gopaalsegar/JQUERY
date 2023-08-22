<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconn.php';

class QuizResultsDashboard
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getResults()
    {
        $sql = "SELECT score, time_taken, username, subject FROM result";
        $result = $this->conn->query($sql);
        return $result;
    }
}

$resultsDashboard = new QuizResultsDashboard($conn);
$results = $resultsDashboard->getResults();

include 'resultsDashboard.php';
?>


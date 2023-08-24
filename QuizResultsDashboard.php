<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbconn.php';

class QuizResultsDashboard
{
    public function __construct(private $conn) {}

    public function getResults()
    {
        $sql = "SELECT score, time_taken, username, subject FROM result";
        $result = $this->conn->query($sql);
        return $result;
    }
}

$resultsDashboard = new QuizResultsDashboard($conn);
$results = $resultsDashboard->getResults();

?>


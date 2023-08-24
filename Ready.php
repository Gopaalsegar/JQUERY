<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'dbconn.php';

class Ready
{
    

    public function __construct(private $conn,private $username ) {}

    public function getSubjectsForTest()
    {
        $sub = "SELECT subject_name FROM subject";
        $stmt = $this->conn->prepare($sub);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $subjectsForTest = [];
        
        while ($row = $result->fetch_assoc()) {
            $subjectName = $row['subject_name'];
            
            if (!in_array($subjectName, $this->userTakenSubjects())) {
                $subjectsForTest[] = $subjectName;
            }
        }
        
        return $subjectsForTest;
    }

    public function userTakenSubjects()
    {
        $takenSubjects = [];
        $takenSubjectsSql = "SELECT DISTINCT subject FROM result WHERE username = ?";
        $takenSubjectsStmt = $this->conn->prepare($takenSubjectsSql);
        $takenSubjectsStmt->bind_param("s", $this->username);
        $takenSubjectsStmt->execute();
        $takenSubjectsResult = $takenSubjectsStmt->get_result();

        while ($takenSubjectRow = $takenSubjectsResult->fetch_assoc()) {
            $takenSubjects[] = $takenSubjectRow['subject'];
        }

        return $takenSubjects;
    }

    public function getUserResults()
    {
        $sql = "SELECT score, time_taken, subject FROM result WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $result = $stmt->get_result();
        $userResultsData = [];

        while ($row = $result->fetch_assoc()) {
            $userResultsData[] = $row;
        }

        return $userResultsData;
    }
}

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    $userResults = new Ready($conn, $username);
    $subjectsForTest = $userResults->getSubjectsForTest();
    $userResultsData = $userResults->getUserResults();

} 
?>

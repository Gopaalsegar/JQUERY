<?php
// Set error reporting at the top
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'dbconn.php';

class UserResults
{
    private $conn;
    private $username;

    public function __construct($conn, $username)
    {
        $this->conn = $conn;
        $this->username = $username;
    }

    public function getSubjectsForTest()
    {
        $sub = "SELECT subject_name FROM subject";
        $stmt = $this->conn->prepare($sub);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $subjectsForTest = array();
        
        // Fetch subjects
        while ($row = $result->fetch_assoc()) {
            $subjectName = $row['subject_name'];
            
            // Check if the subject hasn't been taken by the user
            if (!in_array($subjectName, $this->userTakenSubjects())) {
                $subjectsForTest[] = $subjectName;
            }
        }
        
        return $subjectsForTest;
    }

    public function userTakenSubjects()
    {
        $takenSubjects = array();
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
        $userResultsData = array();

        while ($row = $result->fetch_assoc()) {
            $userResultsData[] = $row;
        }

        return $userResultsData;
    }
}

// Get the username from the session
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    // Create an instance of UserResults and get user results
    $userResults = new UserResults($conn, $username);
    $subjectsForTest = $userResults->getSubjectsForTest();
    $userResultsData = $userResults->getUserResults();

    include 'UserReady.php';
} 
?>

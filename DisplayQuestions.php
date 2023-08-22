<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'dbconn.php';
include 'UserTest.php';


class QuizTimer
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getQuestions($subject)
    {
        $sql = "SELECT question_id, question_text, option_1, option_2, option_3, option_4 FROM question WHERE subject = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $subject);
        $stmt->execute();
        return $stmt->get_result();
    }
}
$quizTimer = new QuizTimer($conn);
$selectedSubject = $_GET['subject'];
$questionsResult = $quizTimer->getQuestions($selectedSubject);
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// session_start();

include 'dbconn.php';
include 'QuizScorer.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $username = $_SESSION["username"];
    $selectedSubject = $_POST['selected_subject'];

    $scoreInfo = $quizScorer->calculateScore($_POST['answer'], $selectedSubject);

    if (isset($_COOKIE['time_taken'])) {
        $timeTaken = $_COOKIE['time_taken'];
    
    }

    $score = $scoreInfo['score'];
    $totalQuestions = $scoreInfo['totalQuestions'];
  
    $scorePercentage = ($score / $totalQuestions) * 100;
 

    $quizScorer->insertScore($scorePercentage, $timeTaken, $selectedSubject);
    header("Location: Result.php");
    exit();
} 
  

?>

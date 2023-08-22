<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include 'dbconn.php';
$username = $_SESSION["username"];
$questions = array();
$correctOptions = array();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $userAnswers = $_POST['answer'];
    $selectedSubject = $_POST['selected_subject'];


    function calculateScore($userAnswers, $selectedSubject)
    {
        global $conn;

        $score = 0;
        $totalQuestions = 0;
        $correctAnswers = array();
        $sql = "SELECT question_id, correct_option FROM question where subject = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $selectedSubject);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $question_Id = $row['question_id'];
            $correctOption = $row['correct_option'];
            $correctAnswers[$question_Id] = $correctOption;
            $totalQuestions++;
        }

        foreach ($userAnswers as $questionId => $selectedOption) {
            if (isset($correctAnswers[$questionId]) && $correctAnswers[$questionId] == $selectedOption) {
                $score++;
            }
        }

        echo "Score:  $score <br>";
        return ['score' => $score, 'totalQuestions' => $totalQuestions];
    }

    $username = $_SESSION["username"];

    if (isset($_COOKIE['time_taken'])) {
        $timeTaken = $_COOKIE['time_taken'];
        echo "Time taken:  $timeTaken Seconds <br>";
    }



    $scoreInfo = calculateScore($userAnswers, $selectedSubject);
    $score = $scoreInfo['score'];
    $totalQuestions = $scoreInfo['totalQuestions'];
    echo "questions answered $totalQuestions";
    $scorePercentage = ($score / $totalQuestions) * 100;
    echo "Percentage" . $scorePercentage;

    $scoreInsertSql = "INSERT INTO result (score, time_taken, username,subject) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($scoreInsertSql);
    $stmt->bind_param("dsss", $scorePercentage, $timeTaken, $username, $selectedSubject);
    $stmt->execute();
} else {
    echo "no answer is selected.";

}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="css/result.css">
</head>

<body>
    <a class="back-link" href="Ready.php">Back to Home</a>
    </div>
</body>

</html>
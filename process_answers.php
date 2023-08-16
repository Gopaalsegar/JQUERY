<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include 'dbconn.php';
$username = $_SESSION["username"];
// Retrieve questions and correct options from the database
$questions = array();
$correctOptions = array();
$questionSql = "SELECT * FROM question";
$questionResult = $conn->query($questionSql);
while ($row = $questionResult->fetch_assoc()) {
    $questions[$row['question_id']] = $row['question_text'];
    $option1[$row['question_id']] = $row['option_1'];
    $option2[$row['question_id']] = $row['option_2'];

    $option3[$row['question_id']] = $row['option_3'];

    $option4[$row['question_id']] = $row['option_4'];

    
    $correctOptions[$row['question_id']] = $row['correct_option'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $userAnswers = $_POST['answer'];
    $selectedSubject = $_POST['selected_subject'];
    echo "<h2>User's Selected Answers:</h2>";
    foreach ($userAnswers as $questionId => $selectedOption) {
        $question = $questions[$questionId];
        $option_1 = $option1[$questionId];
        $option_2 = $option2[$questionId];

        $option_3 = $option3[$questionId];

        $option_4 = $option4[$questionId];

        $correctOption = $correctOptions[$questionId];
        echo "Question: $question<br>";
        echo "Option 1: $option_1 <br>";
        echo "Option 2: $option_2 <br>";
        echo "Option 3: $option_3 <br>";
        echo "Option 4: $option_4 <br>";

        echo "Selected Option: $selectedOption<br>";
        echo "Correct Option: $correctOption<br>";
        echo "<br>";
    } 


function calculateScore($userAnswers,$selectedSubject) {
    global $conn;

    $score = 0;
    $totalQuestions = 0;
    $correctAnswers = array(); // Initialize the array

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



$scoreInfo = calculateScore($userAnswers,$selectedSubject);
$score = $scoreInfo['score'];
$totalQuestions = $scoreInfo['totalQuestions'];
echo "ques $totalQuestions";
$scorePercentage = ($score / $totalQuestions) * 100;
echo "Percentage".$scorePercentage;

$scoreInsertSql = "INSERT INTO result (score, time_taken, username,subject) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($scoreInsertSql);
$stmt->bind_param("dsss", $scorePercentage, $timeTaken, $username, $selectedSubject);
$stmt->execute();
}
else{
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
    
 

        <a class="back-link" href="ready.php">Back to Quiz</a>
    </div>
</body>
</html>

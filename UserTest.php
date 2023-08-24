<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'UserTestQuestion.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Timer</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/quiz.css">
</head>
<body>

<div id="timer"></div>

<form method="post" name="quizForm" action="ProcessAnswers.php" id="quizForm">
<script src="UserTest.js"></script>

  

    <div class="container">
        <?php while ($row = $questionsResult->fetch_assoc()): ?>
            <div class="question">
                <p><?php echo $row['question_text']; ?></p>
                <input type="radio" name="answer[<?php echo $row['question_id']; ?>]" value="1"> <?php echo $row['option_1']; ?> <br>
                <input type="radio" name="answer[<?php echo $row['question_id']; ?>]" value="2"> <?php echo $row['option_2']; ?> <br>
                <input type="radio" name="answer[<?php echo $row['question_id']; ?>]" value="3"> <?php echo $row['option_3']; ?> <br>
                <input type="radio" name="answer[<?php echo $row['question_id']; ?>]" value="4"> <?php echo $row['option_4']; ?> <br>
            </div>
        <?php endwhile; ?>
    </div>

    <input type="hidden" id="timeLeft" name="timeLeft" value="">
    <input type="hidden" name="selected_subject" value="<?php echo $selectedSubject; ?>">

    <input type="submit" id="submit" value="Submit" name="submit">
</form>

<button id="reviewButton">Review Answers</button>
<script src="UserTestReview.js"></script>


</body>
</html>
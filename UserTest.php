<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'dbconn.php';

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

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Timer</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/quiz.css">
</head>
<body>

<div id="timer"></div>
<a href="Ready.php">Back</a>

<form method="post" name="quizForm" action="ProcessAnswers.php" id="quizForm">
    <script>
        var timeLeft = 60; // Set the initial time in seconds
    var timerInterval;

    function updateTimer() {
        $("#timer").html(timeLeft + " seconds remaining");
        $("#timeLeft").val(timeLeft); // Update the hidden input with the remaining time
    }

    function startTimer() {
        updateTimer();

        timerInterval = setInterval(function() {
            timeLeft--;
            updateTimer();

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                document.cookie = "time_taken=" + (60 - timeLeft) + "; path=/";

                submitForm(); // Submit the form when time is up
            }
            document.cookie = "time_taken=" + (60 - timeLeft) + "; path=/";

        }, 1000);
    }

    function submitForm() {
        clearInterval(timerInterval); // Stop the timer interval
        document.getElementById('submit').click(); // Trigger the form submission by clicking the submit button
    }

    $(document).ready(function() {
        startTimer();
    });
    // JavaScript timer logic here
    </script>

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

<script>
    document.getElementById('reviewButton').addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
</body>
</html>
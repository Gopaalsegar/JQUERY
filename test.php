<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'dbconn.php';
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    

//     // Rest of your existing code to process answers and calculate scores
// }

class QuizTimer {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayQuestions($subject) {
        $sql = "SELECT question_id, question_text, option_1, option_2, option_3, option_4 FROM question WHERE subject = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $subject);
        $stmt->execute();
        $result = $stmt->get_result();
    
    

        while ($row = $result->fetch_assoc()) {
            echo '<div class="question">';
            echo '<p>' . $row['question_text'] . '</p>';
            echo '<input type="radio" name="answer[' . $row['question_id'] . ']" value="1" >' . $row['option_1'] . '<br>';
            echo '<input type="radio" name="answer[' . $row['question_id'] . ']" value="2" >' . $row['option_2'] . '<br>';
            echo '<input type="radio" name="answer[' . $row['question_id'] . ']" value="3" >' . $row['option_3'] . '<br>';
            echo '<input type="radio" name="answer[' . $row['question_id'] . ']" value="4" >' . $row['option_4'] . '<br>';
            echo '</div>';
        }
    }
}

$quizTimer = new QuizTimer($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Timer</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/quiz1.css">
    <!-- <script>
        window.onload = function() {
            window.history.forward();

           
        }
    </script> -->
</head>
<body>

<div id="timer"></div>
<a href="ready.php">Back</a>


<form method="post" name="quizForm" action="process_answers.php" id="quizForm">
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
    </script>
 <div class="container">
        <?php
      $selectedSubject = $_GET['subject'];
      $quizTimer->displayQuestions($selectedSubject);
        ?>
    </div>

    <input type="hidden" id="timeLeft" name="timeLeft" value="">
        <input type="hidden" name="selected_subject" value="<?php echo $selectedSubject; ?>">

    <input type="submit" id="submit" value="Submit" name="submit" > <!-- Hide the submit button -->
</form>

    <button id="reviewButton">Review Answers</button>


<script>
    document.getElementById('reviewButton').addEventListener('click', function() {
        // Scroll to the top of the page
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>
</body>
</html>

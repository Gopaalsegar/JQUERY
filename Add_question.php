<?php
// Set error reporting at the top
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'dbconn.php';

class QuestionManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addQuestion($questionText, $option1, $option2, $option3, $option4, $correctOption, $subject)
    {
        $option1 = $this->conn->real_escape_string($option1);
        $option2 = $this->conn->real_escape_string($option2);
        $option3 = $this->conn->real_escape_string($option3);
        $option4 = $this->conn->real_escape_string($option4);

        $sql = "INSERT INTO question (question_text, option_1, option_2, option_3, option_4, correct_option, subject) VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssssss", $questionText, $option1, $option2, $option3, $option4, $correctOption, $subject);
            $stmt->execute();
            echo "Question added!";
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $questionManager = new QuestionManager($conn);

    $questionText = $_POST["question_text"];
    $option1 = $_POST["option1"];
    $option2 = $_POST["option2"];
    $option3 = $_POST["option3"];
    $option4 = $_POST["option4"];
    $correctOption = $_POST["correct_option"];
    $subject = $_POST["subject"];

    $questionManager->addQuestion($questionText, $option1, $option2, $option3, $option4, $correctOption, $subject);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Question</title>
    <link rel="stylesheet" href="css/add_question.css">
</head>

<body>
<header>
        <h1>Test App</h1>
    </header>
    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label>Question:</label>
            <input type="text" name="question_text" required>

            <label>Option 1:</label>
            <input type="text" name="option1" required>

            <label>Option 2:</label>
            <input type="text" name="option2" required>

            <label>Option 3:</label>
            <input type="text" name="option3" required>

            <label>Option 4:</label>
            <input type="text" name="option4" required>

            <label>Correct Option Number:</label>
            <input type="text" name="correct_option" required>
            <label>Subject:</label>
            <select name="subject">
                <option value="Select">Select</option>
                <?php
                $sql = "SELECT subject_name FROM subject";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["subject_name"] . '">' . $row["subject_name"] . '</option>';
                    }
                }
                ?>
            </select>

            <input type="submit" value="Add Question">
        </form>
        <a class="back-link" href="Admin_test.php">Back</a>
    </div>
</body>

</html>
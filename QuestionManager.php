<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'dbconn.php';
class QuestionManager
{
    public function __construct(private $conn) {}

    public function addQuestion($questionText, $option1, $option2, $option3, $option4, $correctOption, $subject)
    {
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
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // require 'QuestionManager.php'; // Include the QuestionManager class file

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

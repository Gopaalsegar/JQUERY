<?php
// add_question.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'QuestionManager.php'; // Include the QuestionManager class file

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

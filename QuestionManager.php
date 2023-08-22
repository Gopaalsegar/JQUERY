<?php

class QuestionManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

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
?>

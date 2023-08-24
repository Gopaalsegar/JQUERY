<?php
session_start();
$username = $_SESSION["username"];
class QuizScorer
{
    
    public function __construct(private $conn, private $username)
    {}

    public function calculateScore($userAnswers, $selectedSubject)
    {
        $score = 0;
        $totalQuestions = 0;
        $correctAnswers = [];

        $sql = "SELECT question_id, correct_option FROM question WHERE subject = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $selectedSubject);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $questionId = $row['question_id'];
            $correctOption = $row['correct_option'];
            $correctAnswers[$questionId] = $correctOption;
            $totalQuestions++;
        }

        foreach ($userAnswers as $questionId => $selectedOption) {
            if (isset($correctAnswers[$questionId]) && $correctAnswers[$questionId] == $selectedOption) {
                $score++;
            }
        }

        return ['score' => $score, 'totalQuestions' => $totalQuestions];
    }

    public function insertScore($scorePercentage, $timeTaken, $selectedSubject)
    {
        $scoreInsertSql = "INSERT INTO result (score, time_taken, username, subject) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($scoreInsertSql);
        $stmt->bind_param("dsss", $scorePercentage, $timeTaken, $this->username, $selectedSubject);
        $stmt->execute();
    }
}
$quizScorer = new QuizScorer($conn, $username);

?>

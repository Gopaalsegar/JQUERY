<?php
// Set error reporting at the top
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'dbconn.php';

class UserResults
{
    private $conn;
    private $username;

    public function __construct($conn, $username)
    {
        $this->conn = $conn;
        $this->username = $username;
    }
    public function selectSubject()
    {
        $sub = "SELECT subject_name FROM subject";
        $stmt = $this->conn->prepare($sub);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<h3>Welcome " . $this->username . "! Are you ready to take the test?</h3>";

        echo "<h4>Select a Subject to Take a Test</h4>";

        // Get the subjects for which the user has already taken the test
        $takenSubjects = array(); // Initialize an array to store taken subjects
        $takenSubjectsSql = "SELECT DISTINCT subject FROM result WHERE username = ?";
        $takenSubjectsStmt = $this->conn->prepare($takenSubjectsSql);
        $takenSubjectsStmt->bind_param("s", $this->username);
        $takenSubjectsStmt->execute();
        $takenSubjectsResult = $takenSubjectsStmt->get_result();

        while ($takenSubjectRow = $takenSubjectsResult->fetch_assoc()) {
            $takenSubjects[] = $takenSubjectRow['subject'];
        }

        while ($row = $result->fetch_assoc()) {
            $subjectName = $row['subject_name'];

            if (!(in_array($subjectName, $takenSubjects))) {
                echo '<a href="test.php?subject=' . $subjectName . '">' . $subjectName . '</a><br>';

            }
          
        }
    }


    public function displayResults()
    {
        $sql = "SELECT score, time_taken, subject FROM result WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $this->username);
        $stmt->execute();
        $result = $stmt->get_result();

        echo '<h4> History</h4>';
        echo "<table>";
        echo "<tr>";
        echo "<th>Test Taken</th>";

        echo "<th>Time Taken (seconds)</th>";
        echo "<th>Score</th>";

        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['time_taken'] . "</td>";
            echo "<td>" . $row['score'] . "</td>";


            echo "</tr>";
        }

        echo "</table>";
    }
}

// Get the username from the session
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    // Create an instance of UserResults and display results
    $userResults = new UserResults($conn, $username);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Results</title>
        <link rel="stylesheet" href="css/user_ready.css">
        <script type="text/javascript">
            window.history.forward();
            function noBack() {
                window.history.forward();
            }
        </script>
    </head>

    <body>
        <header>
            <h1>Test App</h1>
        </header>

        <a class="back-link" href="User_login.php">Back</a>
        <a class="logout-link" href="index.php">Log out</a>


        <div class="container">
            <?php

            $userResults->selectSubject();
            // Display user results using the created object
            $userResults->displayResults();


            ?>
        </div>

    </body>

    </html>
    <?php
} else {
    // Handle the case when the username is not set in the session
    echo "You are not logged in. Please log in first.";
}
?>
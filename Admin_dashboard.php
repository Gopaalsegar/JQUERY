<?php
// Set error reporting at the top
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include 'dbconn.php';

class QuizResultsDashboard {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayResults() {
        $sql = "SELECT score, time_taken, username, subject FROM result";
        $result = $this->conn->query($sql);

        echo "<h1>Test Results Dashboard</h1>";

        echo "<table>";
        echo "<tr>";
        echo "<th>User Name</th>";
        echo "<th>Test Taken</th>";
        echo "<th>Time Taken (seconds)</th>";
        echo "<th>Score</th>";
        
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['time_taken'] . "</td>";
            echo "<td>" . $row['score'] . "</td>";
            
            echo "</tr>";
        }

        echo "</table>";
    }
}

// Create an instance of QuizResultsDashboard and display results
$resultsDashboard = new QuizResultsDashboard($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results Dashboard</title>
    <link rel="stylesheet" href="css/ad_dashboard.css">
</head>
<body>
    <header>
        <h1>Test App</h1>
    </header>
   

<div class="main-content">
<a href="Admin_home.php">Home</a>
<a class="logout-link" href="index.php">Log out</a>
 
</div>
        <?php
        // Display quiz results using the created object
        $resultsDashboard->displayResults();
        ?>
    </div>
    
</body>
</html>

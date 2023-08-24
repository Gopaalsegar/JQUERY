<?php

include 'dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $subjectName = $_POST['subject_name'];

    // Insert data into the subject table
    $sql = "INSERT INTO subject (subject_name) VALUES ('$subjectName')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "This Subject is already available  <br>";
    }
}
?>

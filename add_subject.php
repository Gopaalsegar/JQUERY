<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'dbconn.php';

if(($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['submit']))) {
    $subjectName = $_POST['subject_name'];

    // Insert data into the subject table
    $sql = "INSERT INTO subject (subject_name) VALUES ('$subjectName')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo " This Subject is already available  <br>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subject Form</title>
    <link rel="stylesheet" href="css/add_subject.css">

</head>
<body>
<header>
        <h1>Test App</h1>
    </header>
    <div class="container">
        <h2>Create new subject</h2>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Subject Name: <input type="text" name="subject_name">
            <input type="submit" name="submit" value="Insert">
        </form>
        
        <a href="Admin_test.php">Back</a>
    </div>
</body>
</html>



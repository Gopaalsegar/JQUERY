<?php
    include 'Ready.php';
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

    <a class="back-link" href="index.php">Log out</a>


    <div class="container">
        <h3>Welcome
            <?php echo $username; ?>! Are you ready to take the test?
        </h3>
        <?php
        if ($subjectsForTest) {
            echo "Select subject for test<br>";
        } else {
            echo "You've attended all the tests";
        }
        ?>


        <?php foreach ($subjectsForTest as $subject): ?>
            <a href="UserTest.php?subject=<?php echo $subject; ?>"><?php echo $subject; ?></a><br>
        <?php endforeach; ?>

        <h4>History</h4>
        <table>
            <tr>
                <th>Test Taken</th>
                <th>Time Taken (seconds)</th>
                <th>Score</th>
            </tr>

            <?php foreach ($userResultsData as $result): ?>
                <tr>
                    <td>
                        <?php echo $result['subject']; ?>
                    </td>
                    <td>
                        <?php echo $result['time_taken']; ?>
                    </td>
                    <td>
                        <?php echo $result['score']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>

</html>
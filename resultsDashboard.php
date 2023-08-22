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
        <a href="AdminHome.php">Home</a>
        <a class="logout-link" href="index.php">Log out</a>
    </div>

    <div class="results-table">
        <h2>Test Results Dashboard</h2>
        <table>
            <tr>
                <th>User Name</th>
                <th>Test Taken</th>
                <th>Time Taken (seconds)</th>
                <th>Score</th>
            </tr>

            <?php while ($row = $results->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['subject']; ?></td>
                    <td><?php echo $row['time_taken']; ?></td>
                    <td><?php echo $row['score']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>

</html>

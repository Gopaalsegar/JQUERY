<?php

include 'dbconn.php';

$sql = "SELECT subject_name FROM subject";
$result = $conn->query($sql);

$subjects = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $subjects[] = $row;
    }
}

echo json_encode(array('subjects' => $subjects));
?>

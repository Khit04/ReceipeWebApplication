<?php

require_once 'dbinfo.php';
$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM recipe";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row['name'];
    }

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo "0 results";
}

$conn->close();
?>

<?php
 require_once 'dbinfo.php';
 $conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recipeId = $_POST['recipeId'];

$sql = "SELECT * FROM recipe WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipeId);
$stmt->execute();
$result = $stmt->get_result();


if ($result) {
    $recipeData = $result->fetch_assoc();

    header('Content-Type: application/json');
    echo json_encode($recipeData);
} else {
    echo json_encode(['error' => 'Error fetching recipe details']);
}


$stmt->close();
$conn->close();
?>

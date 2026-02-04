<?php
require_once 'dbinfo.php';
header('Content-Type: application/json');

$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$recipeId = isset($_POST['recipeId']) ? $_POST['recipeId'] : null;

if (!$recipeId) {
    echo json_encode(['error' => 'Recipe ID is required.']);
    http_response_code(400);
    exit();
}

$sql = 'SELECT * FROM ingredients WHERE recipe_id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $recipeId);
$stmt->execute();
$result = $stmt->get_result();

$ingredients = [];

while ($row = $result->fetch_assoc()) {
    $ingredients[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($ingredients);
?>

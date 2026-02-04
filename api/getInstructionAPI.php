<?php
require_once 'dbinfo.php';
header('Content-Type: application/json');

$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['recipeId'])) {
    $recipeId = $_POST['recipeId'];

    $sql = "SELECT * FROM instructions WHERE recipe_id = $recipeId ORDER BY sequence_number";
    $result = $conn->query($sql);

    if ($result) {
        $instructions = [];

        while ($row = $result->fetch_assoc()) {
            $instructions[] = [
                'description' => $row['description']
            ];
        }

        $response = [
            'success' => true,
            'instructions' => $instructions
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to fetch instructions.'
        ];
    }
} else {
    $response = [
        'success' => false,
        'message' => 'Recipe ID not provided.'
    ];
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>

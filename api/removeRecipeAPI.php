<?php
session_start(); 

if (isset($_POST['recipeId'])) {
    $recipeId = $_POST['recipeId'];

    echo "Recipe ID: $recipeId";

    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        require_once 'dbinfo.php';
        $conn = new mysqli($host, $user, $pass, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

        $stmt = $conn->prepare("DELETE FROM favorite WHERE user_id = ? AND recipe_id = ?");
        $stmt->bind_param("ii", $userId, $recipeId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete recipe', 'error' => $stmt->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User ID not found in session']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Recipe ID not provided']);
}
?>

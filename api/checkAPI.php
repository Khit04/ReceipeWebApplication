<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        echo json_encode(['success' => true, 'message' => 'Save successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>

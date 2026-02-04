<?php
session_start();
require_once 'dbinfo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $name = $_POST['username'];
    $email = $_POST['email'];
    $userType = $_POST['user_type'];

    $conn = new mysqli($host, $user, $pass, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
   
    if (!empty($name)) {
        if (preg_match('/[0-9]/', $name)) {
            echo json_encode(['success' => false, 'error' => 'username_contains_numbers']);
            $conn->close();
            exit();
        }
    
        $updateName = $conn->prepare("UPDATE user SET username = ? WHERE id = ?");
        $updateName->bind_param("si", $name, $userId);
    
        if ($updateName->execute() === false) {
            echo json_encode(['success' => false, 'error' => 'name_update_failed']);
            $updateName->close();
            $conn->close();
            exit();
        }
        $updateName->close();
    }
    
    if (!empty($email)) {
        $selectEmail = $conn->prepare("SELECT * FROM user WHERE email = ? AND id != ?");
        $selectEmail->bind_param("si", $email, $userId);
        $selectEmail->execute();

        $result = $selectEmail->get_result();
        $selectEmail->close();

        if ($result->num_rows > 0) {
            echo json_encode(['success' => false, 'error' => 'Email is already taken']);
            $conn->close();
            exit();
        } else {
            $updateEmail = $conn->prepare("UPDATE user SET email = ? WHERE id = ?");
            $updateEmail->bind_param("si", $email, $userId);

            if ($updateEmail->execute() === false) {
                echo json_encode(['success' => false, 'error' => 'email_update_failed']);
                $updateEmail->close();
                $conn->close();
                exit();
            }
            $updateEmail->close();
        }
    }

    $updateUserType = $conn->prepare("UPDATE user SET role = ? WHERE id = ?");
    $updateUserType->bind_param("si", $userType, $userId);
    $updateUserType->execute();
    $updateUserType->close();

    echo json_encode(['success' => true]);

    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>

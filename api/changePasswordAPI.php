<?php
session_start();
require_once 'dbinfo.php';

function connectDB() {
    global $host, $user, $pass, $database;
    $conn = new mysqli($host, $user, $pass, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function closeDB($conn) {
    $conn->close();
}

function updatePassword($userId, $oldPassword, $newPassword) {
    $conn = connectDB();

    $stmt = $conn->prepare("SELECT password FROM user WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($dbPasswordHash);
    $stmt->fetch();
    $stmt->close();

    if ($dbPasswordHash) {
        $oldPasswordHash = hash('ripemd128', "X7X" . $oldPassword . "M9C");

        if ($oldPasswordHash === $dbPasswordHash) {
            $newPasswordHash = hash('ripemd128', "X7X" . $newPassword . "M9C");
            $updateSql = "UPDATE user SET password = '$newPasswordHash' WHERE id = '$userId'";
            if ($conn->query($updateSql) === TRUE) {
                $response = array('success' => true);
            } else {
                $response = array('success' => false, 'message' => 'Error updating password: ' . $conn->error);
            }
        } else {
            $response = array('success' => false, 'message' => 'Old password is incorrect');
        }
    } else {
        $response = array('success' => false, 'message' => 'User not found');
    }

    closeDB($conn);
    return $response;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword != $confirmPassword) {
        echo json_encode(array('success' => false, 'message' => 'Passwords do not match'));
        exit();
    }
    $response = updatePassword($userId, $oldPassword, $newPassword);

    echo json_encode($response);
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}
?>

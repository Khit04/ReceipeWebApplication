<?php
session_start();
require_once 'dbinfo.php';

$usernameOrEmail = $_POST['usernameOrEmail'];
$password = $_POST['password'];
$role = $_POST['role'];

$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, username, password, role FROM user WHERE username = ? OR email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
$stmt->execute();
$stmt->bind_result($dbId, $dbUsername, $dbPasswordHash, $dbRole);
$stmt->fetch();
$stmt->close();

if ($dbUsername) {
    $salt1 = "X7X";
    $salt2 = "M9C";
    $salted_pass = $salt1 . $password . $salt2;
    $hashedPasswordAttempt = hash('ripemd128', $salted_pass);

    if ($hashedPasswordAttempt === $dbPasswordHash) {
        if ($dbRole === $role) {
            $_SESSION['user_id'] = $dbId;
            $_SESSION['userRole'] = $dbRole;
            echo json_encode(['success' => true, 'role' => $dbRole]);
        } else {
            echo json_encode(['success' => false, 'error' => 'incorrect_role']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'incorrect_password']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'not_found']);
}

$conn->close();
?>

<?php
$username = htmlspecialchars($_POST['username']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['pass']);
$role = htmlspecialchars($_POST['role']);

$salt1 = "X7X";
$salt2 = "M9C";
$salted_pass = $salt1 . $password . $salt2;
$hashedPassword = hash('ripemd128', $salted_pass);

require_once 'dbinfo.php';
$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die($conn->connect_error);
}

$stmt1 = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
$stmt1->bind_param("s", $email);
$stmt1->execute();
$stmt1->bind_result($count);
$stmt1->fetch();
$stmt1->close();

if ($count > 0) {
    echo 'Already Registered';
} else {
    $stmt2 = $conn->prepare("INSERT INTO user (username, email, password, role) 
                             VALUES (?, ?, ?, ?)");
    $stmt2->bind_param("ssss", $username, $email, $hashedPassword, $role);
    $stmt2->execute();

    if ($stmt2->affected_rows == 1) {
        echo 'Success';
    } else {
        echo 'Unable to Register!';
    }
    $stmt2->close();
}

$conn->close();
?>

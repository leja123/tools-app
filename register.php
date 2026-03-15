<?php
session_start();

//connect to db
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tools_app";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection unsuccessful " . $conn->connect_error);
}


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

if ($password1 !== $password2) {
    die("Passwords do not match");
}
$hashed_password = password_hash($password1, PASSWORD_DEFAULT);

echo "first name" . $first_name . "last name: " . $last_name . "usernmae: " . $username . " password1: " . $password1 . " password2: " . $password2;

$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $first_name, $last_name, $username, $hashed_password);
$stmt->execute();
$stmt->store_result();
if ($stmt->execute()) {
    echo "User successfully registered!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

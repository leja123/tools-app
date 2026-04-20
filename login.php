<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tools_app";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection unsuccessful " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($hashed_password);
$stmt->fetch();

$stmt->free_result();
$stmt->close();       

// get user_id
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($user_id);
$stmt->fetch();

$stmt->close();

if ($hashed_password) {

    // check password
    if (password_verify($password, $hashed_password)) {
        echo "Login successful!";
        header("Location: main.php");
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id; 
    } else {
        echo "Incorrect password";
    }

} else {
    echo "Username does not exist";
}

$stmt->close();
$conn->close();
?>
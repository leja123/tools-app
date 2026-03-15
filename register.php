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

echo "first name" . $first_name . "last name: " . $last_name . "usernmae: " . $username . " password1: " . $password1 . " password2: " . $password2;

    $stmt = $conn->prepare("SELECT password FROM users");
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($test);
        $stmt->fetch();
        echo 'Geslo v bazi je: ' . $test;
        
    } else {
        $_SESSION["Uporabniško ime ne obstaja."];
    }

    $stmt->close();
?>

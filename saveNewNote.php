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

$user_id = $_SESSION['user_id']; 
$title = $_POST['noteTitle'];
$note = $_POST['noteText'];

$stmt = $conn->prepare("INSERT INTO notes (user_id, title, note) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $title, $note);

if ($stmt->execute()) {
    echo "Note successfully added!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
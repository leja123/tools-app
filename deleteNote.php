<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

if (!isset($_POST['note_id'])) {
    die("Invalid request");
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tools_app";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection unsuccessful " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$note_id = $_POST['note_id'];

$stmt = $conn->prepare("DELETE FROM notes WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $note_id, $user_id);

if ($stmt->execute()) {
    header("Location: notes.php");
    exit();
} else {
    echo "Error deleting note";
}

$stmt->close();
$conn->close();
?>
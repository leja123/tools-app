<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "tools_app");

$user_id = $_SESSION['user_id'];
$task = $_POST['task'];

$stmt = $conn->prepare("INSERT INTO todolist (user_id, task) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $task);
$stmt->execute();

header("Location: toDoList.php");
?>
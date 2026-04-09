<?php
$conn = new mysqli("localhost", "root", "", "tools_app");

$id = $_POST['id'];

$conn->query("DELETE FROM todolist WHERE id = $id");

header("Location: toDoList.php");
?>

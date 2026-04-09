<?php
$conn = new mysqli("localhost", "root", "", "tools_app");

$id = $_POST['id'];

$conn->query("UPDATE todolist SET completed = NOT completed WHERE id = $id");

header("Location: toDoList.php");
?>
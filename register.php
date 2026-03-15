<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

echo "first name" . $first_name . "last name: " . $last_name . "usernmae: " . $username . " password1: " . $password1 . " password2: " . $password2;;
?>

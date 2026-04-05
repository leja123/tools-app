<?php
session_start();
var_dump($_SESSION);
echo $_SESSION['username'] = $username;
?>
<button><a href="calculator.php">Calculator</a></button>
<button><a href="notes.php">Notes</a></button>
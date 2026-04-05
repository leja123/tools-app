<?php
session_start();
?>
<form id="newNote" method="POST" action="saveNewNote.php">
    Title:<input type="text" name="noteTitle"><br>
    Text:<input type="text" name="noteText"><br>
    <input type="submit" value="Save">
</form>
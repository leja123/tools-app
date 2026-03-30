<?php
session_start();
?>
<form id="newNote" method="POST" action="saveNewNote">
    Title:<input type="text" id="noteTitle"><br>
    Text:<input type="text" id="noteText"><br>
    <input type="submit" value="Save">
</form>
<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tools</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #8cbcd8;

    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* container grid */
.menu {
    display: grid;
    grid-template-columns: repeat(2, 150px);
    gap: 25px;
}

/* button cards */
.menu a {
    text-decoration: none;
}

.card {
    width: 150px;
    height: 150px;
    background: #2c2c2c;
    border-radius: 15px;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    color: white;
    font-size: 14px;

    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    transition: 0.2s;
}

.card:hover {
    transform: scale(1.05);
}

/* icons */
.icon {
    font-size: 40px;
    margin-bottom: 10px;
}
</style>

</head>
<body>

<div class="menu">

    <a href="calculator.php">
        <div class="card">
            <div class="icon">🧮</div>
            Calculator
        </div>
    </a>

    <a href="notes.php">
        <div class="card">
            <div class="icon">📝</div>
            Notes
        </div>
    </a>

    <a href="stopwatch.php">
        <div class="card">
            <div class="icon">⏱</div>
            Stopwatch
        </div>
    </a>

    <a href="toDoList.php">
        <div class="card">
            <div class="icon">✅</div>
            To-Do List
        </div>
    </a>

</div>

</body>
</html>
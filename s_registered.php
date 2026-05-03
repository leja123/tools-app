<?php
session_start();


$username = htmlspecialchars($_GET['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Registration Successful</title>

<meta http-equiv="refresh" content="3;url=index.php">

<style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #8cbcd8;
        font-family: Arial, sans-serif;
        color: white;
    }

    .container {
        background: #2c2c2c;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        width: 320px;
        text-align: center;
    }

    h2 {
        margin-bottom: 15px;
    }

    p {
        margin: 10px 0;
        color: #ddd;
    }

    .username {
        color: #3041db;
        font-weight: bold;
    }

    .countdown {
        margin-top: 15px;
        font-size: 14px;
        color: #aaa;
    }

    button {
        margin-top: 15px;
        padding: 10px;
        border: none;
        border-radius: 8px;
        background: #3041db;
        color: white;
        cursor: pointer;
    }

    button:hover {
        background: #1f2fb5;
    }
</style>

<script>
    let seconds = 5;
    function countdown() {
        const el = document.getElementById("count");
        if (seconds > 0) {
            el.innerText = seconds;
            seconds--;
        }
    }
    setInterval(countdown, 1000);
</script>

</head>
<body>

<div class="container">
    <h2>Registration Successful!</h2>
    <p>Welcome, <span class="username"><?php echo htmlspecialchars($username); ?></span>!</p>
    <p>Your account has been created successfully.</p>
    <p class="countdown">Redirecting to login in <span id="count">5</span> seconds...</p>
    <button onclick="window.location.href='index.php'">Go to Login Now</button>
</div>

</body>
</html>
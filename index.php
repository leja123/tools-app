<?php
session_start();
?>
<!DOCTYPE html>
<html lang="sl">
<head>
<meta charset="UTF-8" />
<title>Tools app</title>

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
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .tabs {
        display: flex;
        margin-bottom: 20px;
    }

    .tab {
        flex: 1;
        padding: 10px;
        text-align: center;
        cursor: pointer;
        background: #3a3a3a;
        border-radius: 10px 10px 0 0;
        transition: 0.2s;
    }

    .tab.active {
        background: #3041db;
    }

    form {
        display: none;
        flex-direction: column;
    }

    form.active {
        display: flex;
    }

    input {
        margin-bottom: 10px;
        padding: 10px;
        border: none;
        border-radius: 8px;
        background: #444;
        color: white;
    }

    button {
        padding: 10px;
        border: none;
        border-radius: 8px;
        background: #3041db;
        color: white;
        cursor: pointer;
        transition: 0.2s;
    }

    button:hover {
        background: #3041db;
    }
</style>
</head>

<body>

<div class="container">
    <h2>Tools App</h2>

    <div class="tabs">
        <div class="tab active" onclick="showForm('login')">Login</div>
        <div class="tab" onclick="showForm('register')">Register</div>
    </div>

    <!-- LOGIN -->
    <form id="loginForm" class="active" method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <!-- REGISTER -->
    <form id="registerForm" method="POST" action="register.php">
        <input type="text" name="first_name" placeholder="First name" required>
        <input type="text" name="last_name" placeholder="Last name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password1" placeholder="Password" required>
        <input type="password" name="password2" placeholder="Repeat password" required>
        <button type="submit">Register</button>
    </form>
</div>

<script>
function showForm(type) {
    let loginForm = document.getElementById("loginForm");
    let registerForm = document.getElementById("registerForm");
    let tabs = document.querySelectorAll(".tab");

    tabs.forEach(tab => tab.classList.remove("active"));

    if (type === "login") {
        loginForm.classList.add("active");
        registerForm.classList.remove("active");
        tabs[0].classList.add("active");
    } else {
        registerForm.classList.add("active");
        loginForm.classList.remove("active");
        tabs[1].classList.add("active");
    }
}
</script>

</body>
</html>
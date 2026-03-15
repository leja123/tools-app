<?php
session_start();
?>
<!DOCTYPE html>
<html lang="sl">
    <head>
        <meta charset="UTF-8" />
        <title>Tools app</title>
    </head>
    <body>
        <h2>Tools app</h2>
        <div id="login">
            <h4>Login</h4><br>
            <form method="POST" action="login.php">
                Username<input type="text" name="username"></input><br>
                Password<input type="text" name="password"></input><br>
                <button type="submit">Login</button>
            </form>
        </div>
        <div id="register">
            <h4>Register</h4><br>
            <form method="POST" action="register.php">
                First name<input type="text" name="first_name"></input><br>
                Last name<input type="text" name="last_name"></input><br>
                Username<input type="text" name="username"></input><br>
                Password<input type="text" name="password1"></input><br>
                Repeat password<input type="text" name="password2"></input><br>
                <button type="submit">Register</button>
            </form>
        </div>
    </body>
</html>


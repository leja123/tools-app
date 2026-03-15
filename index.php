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
            <form method="POST" action="">
                First name<input type="text"></input><br>
                Last name<input type="text"></input><br>
                Username<input type="text"></input><br>
                Password<input type="text"></input><br>
                Repeat password<input type="text"></input><br>
                <button type="submit">Register</button>
            </form>
        </div>
    </body>
</html>


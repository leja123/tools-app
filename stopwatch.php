<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if (isset($_POST['back'])) {
    header("Location: main.php"); 
    exit();
}
?>

<html>
<head>
    <title>Stopwatch</title>
    <style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #8cbcd8;
        font-family: Arial, sans-serif;
    }

    #stopwatch {
        background: #2c2c2c;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        text-align: center;
    }

    #display {
        width: 250px;
        height: 60px;
        font-size: 32px;
        text-align: center;
        line-height: 60px;
        border-radius: 10px;
        margin-bottom: 20px;
        background: #000;
        color: #3041db;
        letter-spacing: 2px;
    }

    button {
        width: 120px;
        height: 50px;
        font-size: 18px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        margin: 5px;
        transition: 0.2s;
    }

    #startStopBtn {
        background: #3041db;
        color: white;
    }

    #pauseBtn {
        background: #6f99f3;
        color: white;
    }

    button:hover {
        opacity: 0.8;
    }

    #pauseBtn:disabled {
        background: #888;
        cursor: not-allowed;
        opacity: 0.5;
    }

    #backBtn {
        position: absolute;
        top: 20px;
        left: 20px;
        padding: 10px 15px;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        background: #444;
        color: white;
        cursor: pointer;
    }

    #backBtn:hover {
        background: #666;
    }
    .logout-btn {
    position: absolute;
    top: 20px;
    right: 20px;

    background: #2c2c2c;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 10px;
    cursor: pointer;

    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    transition: 0.2s;
}

.logout-btn:hover {
    background: #3041db;
}
</style>
</head>

<body>
<form action="logout.php" method="post">
    <button class="logout-btn">Log out</button>
</form>
<form method="POST">
    <button type="submit" name="back" id="backBtn">← Back</button>
</form>

<div id="stopwatch">
    <div id="display">00:00:00</div>
    <button id="startStopBtn" onclick="startStop()">Start</button>
    <br>
    <button id="pauseBtn" onclick="pauseResume()" disabled>Pause</button>
</div>

<script>
let startTime = 0;
let elapsed = 0;
let timer = null;

let state = "idle"; 

function updateDisplay() {
    let minutes = Math.floor(elapsed / 60000);
    let seconds = Math.floor((elapsed % 60000) / 1000);
    let hundredths = Math.floor((elapsed % 1000) / 10);

    document.getElementById("display").innerText =
        String(minutes).padStart(2,'0') + ":" +
        String(seconds).padStart(2,'0') + ":" +
        String(hundredths).padStart(2,'0');
}

function startStop() {
    const btn = document.getElementById("startStopBtn");
    const pauseBtn = document.getElementById("pauseBtn");

    if (state === "idle") {
        startTime = Date.now() - elapsed;

        timer = setInterval(() => {
            elapsed = Date.now() - startTime;
            updateDisplay();
        }, 10);

        state = "running";
        btn.innerText = "Stop";
        pauseBtn.disabled = false;
        pauseBtn.innerText = "Pause";

    } else if (state === "running" || state === "paused") {
        clearInterval(timer);
        timer = null;

        state = "stopped";
        btn.innerText = "Restart";
        pauseBtn.disabled = true;
        pauseBtn.innerText = "Pause";

    } else if (state === "stopped") {
        elapsed = 0;
        updateDisplay();

        state = "idle";
        btn.innerText = "Start";
    }
}

function pauseResume() {
    const pauseBtn = document.getElementById("pauseBtn");

    if (state === "running") {
        clearInterval(timer);
        timer = null;

        state = "paused";
        pauseBtn.innerText = "Resume";

    } else if (state === "paused") {
        startTime = Date.now() - elapsed;

        timer = setInterval(() => {
            elapsed = Date.now() - startTime;
            updateDisplay();
        }, 10);

        state = "running";
        pauseBtn.innerText = "Pause";
    }
}
</script>

</body>
</html>
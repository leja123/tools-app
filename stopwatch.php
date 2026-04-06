<?php
session_start();
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
</style>
</head>

<body>

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

let running = false;
let paused = false;

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

    if (!running) {
        // START or RESUME from reset
        startTime = Date.now() - elapsed;

        timer = setInterval(() => {
            elapsed = Date.now() - startTime;
            updateDisplay();
        }, 10);

        running = true;
        paused = false;

        btn.innerText = "Stop";
        pauseBtn.disabled = false;
        pauseBtn.innerText = "Pause";

    } else {
        // STOP (reset everything)
        clearInterval(timer);
        timer = null;

        elapsed = 0;
        updateDisplay();

        running = false;
        paused = false;

        btn.innerText = "Start";
        pauseBtn.disabled = true;
        pauseBtn.innerText = "Pause";
    }
}

function pauseResume() {
    const pauseBtn = document.getElementById("pauseBtn");

    if (!paused) {
        // PAUSE
        clearInterval(timer);
        timer = null;

        running = false;
        paused = true;

        pauseBtn.innerText = "Resume";
    } else {
        // RESUME
        startTime = Date.now() - elapsed;

        timer = setInterval(() => {
            elapsed = Date.now() - startTime;
            updateDisplay();
        }, 10);

        running = true;
        paused = false;

        pauseBtn.innerText = "Pause";
    }
}
</script>

</body>
</html>
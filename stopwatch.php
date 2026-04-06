<?php
session_start();
?>

<html>
<head>
    <title>Stopwatch</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            margin-top: 100px;
        }
        #display {
            font-size: 48px;
            margin-bottom: 20px;
        }
        button {
            font-size: 20px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>

<div id="display">00:00:00</div>
<button id="toggleBtn" onclick="toggle()">Start</button>

<script>
let startTime = 0;
let elapsed = 0;
let timer = null;
let running = false;

function updateDisplay() {
    let time = elapsed;

    let minutes = Math.floor(time / 60000);
    let seconds = Math.floor((time % 60000) / 1000);
    let hundredths = Math.floor((time % 1000) / 10); 

    document.getElementById("display").innerText =
        String(minutes).padStart(2,'0') + ":" +
        String(seconds).padStart(2,'0') + ":" +
        String(hundredths).padStart(2,'0');
}

function toggle() {
    if (!running) {
        startTime = Date.now() - elapsed;

        timer = setInterval(() => {
            elapsed = Date.now() - startTime;
            updateDisplay();
        }, 10);

        document.getElementById("toggleBtn").innerText = "Stop";
        running = true;

    } else {
        clearInterval(timer);
        timer = null;
        elapsed = 0;
        updateDisplay();

        document.getElementById("toggleBtn").innerText = "Start";
        running = false;
    }
}
</script>

</body>
</html>
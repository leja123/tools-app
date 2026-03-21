<?php
if (isset($_POST['back'])) {
    header("Location: main.php"); 
    exit();
}
?>
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

    #calculator {
        background: #2c2c2c;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    #answer {
        width: 100%;
        height: 60px;
        font-size: 24px;
        text-align: right;
        padding: 10px;
        border: none;
        border-radius: 10px;
        margin-bottom: 10px;
        background: #000;
        color: #3041db;
    }

    input[type="button"] {
        width: 60px;
        height: 60px;
        font-size: 18px;
        border: none;
        border-radius: 10px;
        margin: 5px;
        cursor: pointer;
        transition: 0.2s;
    }

    input[type="button"]:hover {
        opacity: 0.8;
    }


    input[value="0"],
    input[value="1"],
    input[value="2"],
    input[value="3"],
    input[value="4"],
    input[value="5"],
    input[value="6"],
    input[value="7"],
    input[value="8"],
    input[value="9"],
    input[value="."] {
        background: #3a3a3a;
        color: white;
    }

    
    input[value="/"],
    input[value="*"],
    input[value="-"],
    input[value="+"] {
        background: #6f99f3;
        color: white;
    }

    
    input[value="AC"],
    input[value="C"],
    input[value="%"],
    input[value="()"] {
        background: #a5a5a5;
    }

    
    input[value="="] {
        width: 100%;
        background: #3041db;
        color: white;
        font-size: 22px;
    }

    #backBtn {
    padding: 10px 15px;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    background: #444;
    color: white;
    cursor: pointer;
    transition: 0.2s;
    }

    #backBtn:hover {
        background: #666;
    }
</style>
<form method="POST" style="position: absolute; top: 20px; left: 20px;">
    <button type="submit" name="back" id="backBtn">← Back</button>
</form>
<table id=calculator>
    <tr>
        <td colspan="4">
                <input type="text" id="answer">
        </td>
    </tr>
    <tr>
        <td>
            <input type="button" value="%" onclick="append('%')">
        </td>
        <td>
            <input type="button" value="()" onclick="addBrackets()">
        </td>
        <td>
            <input type="button" value="AC" onclick="clearAll()">
        </td>
        <td>
            <input type="button" value="C" onclick="backspace()">
        </td>
    </tr>
    <tr>
        <td>
            <input type="button" value="7" onclick="append('7')">
        </td>
        <td>
            <input type="button" value="8" onclick="append('8')">
        </td>
        <td>
            <input type="button" value="9" onclick="append('9')">
        </td>
        <td>
            <input type="button" value="/" onclick="append('/')">
        </td>
    </tr>
    <tr>
        <td>
            <input type="button" value="4" onclick="append('4')">
        </td>
        <td>
            <input type="button" value="5" onclick="append('5')">
        </td>
        <td>
            <input type="button" value="6" onclick="append('6')">
        </td>
        <td>
            <input type="button" value="*" onclick="append('*')">
        </td>
    </tr>
    <tr>
        <td>
            <input type="button" value="1" onclick="append('1')">
        </td>
        <td>
            <input type="button" value="2" onclick="append('2')">
        </td>
        <td>
            <input type="button" value="3" onclick="append('3')">
        </td>
        <td>
            <input type="button" value="-" onclick="append('-')">
        </td>
    </tr>
    <tr>
        <td>
            <input type="button" value="+/-" onclick="toggleSign()">
        </td>
        <td>
            <input type="button" value="0" onclick="append('0')">
        </td>
        <td>
            <input type="button" value="." onclick="addDecimal()">
        </td>
        <td>
            <input type="button" value="+" onclick="append('+')">
        </td>
    </tr>
    <tr>
        <td colspan="4"> 
            <input type="button" value="=" onclick="calculate()">
        </td>
        
    </tr>
</table>
<script>
function append(value) {
    document.getElementById("answer").value += value;
}

function clearAll() { // AC
    document.getElementById("answer").value = "";
}

function backspace() {
    let display = document.getElementById("answer");

    if (display.value.length > 0) {
        display.value = display.value.slice(0, -1);
    }
}

function addDecimal() {
    let display = document.getElementById("answer");
    let parts = display.value.split(/[\+\-\*\/]/); 
    let lastPart = parts[parts.length - 1];

    if (!lastPart.includes(".")) {
        display.value += ".";
    }
}

function addBrackets() {
    let display = document.getElementById("answer");
    let value = display.value;

    let open = (value.match(/\(/g) || []).length;
    let close = (value.match(/\)/g) || []).length;

    if (open > close && !/[+\-*/(]$/.test(value)) {
        display.value += ")";
    } else {
        display.value += "(";
    }
}


function calculate() {
    let display = document.getElementById("answer");

    try {
        let expression = display.value;

        let result = eval(expression);

        result = Math.round((result + Number.EPSILON) * 100000000) / 100000000;

        display.value = result;
    } catch {
        display.value = "Error";
    }
}

function toggleSign() {
    let display = document.getElementById("answer");
    let value = display.value;

    // If field is empty (no number entered yet)
    if (value === "") {
        display.value = "-";
        return;
    }

    // If last char is operator 
    if (/[+\-*/]$/.test(value)) {
        display.value += "-";
        return;
    }

    // Find last number
    let match = value.match(/(-?\d*\.?\d+)$/);

    if (match) {
        let number = match[0];
        let start = match.index;

        let toggled;

        if (number.startsWith("-")) {
            toggled = number.substring(1); 
        } else {
            toggled = "-" + number; 
        }

        display.value =
            value.substring(0, start) + toggled;
    } else {
        display.value += "-";
    }
}


</script>
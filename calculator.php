<?php
?>
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
            toggled = number.substring(1); // make positive
        } else {
            toggled = "-" + number; // make negative
        }

        display.value =
            value.substring(0, start) + toggled;
    } else {
        // fallback: just add minus
        display.value += "-";
    }
}


</script>
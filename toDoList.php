<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "tools_app";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection unsuccessful " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// FETCH TODOS
$stmt = $conn->prepare("SELECT id, task, completed FROM todolist WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// BACK BUTTON
if (isset($_POST['back'])) {
    header("Location: main.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
</head>
<body>

<style>
body {
    margin: 0;
    font-family: Arial;
    background: #8cbcd8;
}

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
}

#backBtn {
    padding: 10px 15px;
    border-radius: 8px;
    border: none;
    background: #444;
    color: white;
    cursor: pointer;
}

#addBtn {
    font-size: 26px;
    border: none;
    background: #3041db;
    color: white;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    cursor: pointer;
}

#formPopup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #2c2c2c;
    padding: 20px;
    border-radius: 15px;
    color: white;
    width: 300px;
}

#formPopup input[type="text"] {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: none;
    margin-bottom: 10px;
    box-sizing: border-box; 
}

#formPopup input[type="submit"] {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: none;
    background: #3041db;
    color: white;
    cursor: pointer;
}

/* close button */
#closeBtn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
}

#closeBtn:hover {
    color: red;
}

.todo-container {
    padding: 20px;
}

.todo {
    background: #2c2c2c;
    color: white;
    padding: 12px;
    border-radius: 12px;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.todo.completed span {
    text-decoration: line-through;
    color: #999;
}

.left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.delete-btn {
    background: none;
    border: none;
    color: red;
    cursor: pointer;
    font-size: 18px;
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
<form action="logout.php" method="post">
    <button class="logout-btn">Log out</button>
</form>
<div class="top-bar">
    <form method="POST">
        <button name="back" id="backBtn">← Back</button>
    </form>

    <button id="addBtn" onclick="toggleForm()">+</button>

    <div></div>
</div>

<!-- POPUP FORM -->
<form id="formPopup" method="POST" action="addTodo.php">
    <button type="button" id="closeBtn" onclick="toggleForm()">✖</button>
    <h3>Add To-Do</h3>
    <input type="text" name="task" placeholder="Enter task" required>
    <input type="submit" value="Add">
</form>

<h2 style="text-align:center;">Your To-Do List</h2>

<div class="todo-container">
<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="todo <?php echo $row['completed'] ? 'completed' : ''; ?>">

            <div class="left">
                <!-- CHECKBOX -->
                <form method="POST" action="toggleTodo.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="checkbox" onchange="this.form.submit()" <?php echo $row['completed'] ? 'checked' : ''; ?>>
                </form>

                <span><?php echo htmlspecialchars($row['task']); ?></span>
            </div>

            <!-- DELETE -->
            <form method="POST" action="deleteTodo.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button class="delete-btn">🗑</button>
            </form>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No tasks yet</p>
<?php endif; ?>
</div>

<script>
function toggleForm() {
    let f = document.getElementById("formPopup");
    f.style.display = f.style.display === "block" ? "none" : "block";
}
</script>

</body>
</html>





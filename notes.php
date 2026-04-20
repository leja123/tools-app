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

$stmt = $conn->prepare("SELECT id, title, note FROM notes WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

// back button
if (isset($_POST['back'])) {
    header("Location: main.php"); 
    exit();
}
?>

<html>
<head>
    <title>Notes</title>
</head>
<body>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #8cbcd8;
}

/* top bar */
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
}

/* back button */
#backBtn {
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    background: #444;
    color: white;
    cursor: pointer;
}

#backBtn:hover {
    background: #666;
}

/* add note button */
#addBtn {
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    background: #3041db;
    color: white;
    cursor: pointer;
    font-size: 16px;
}

#addBtn:hover {
    background: #1f2bb8;
}

/* form (hidden by default) */
#newNote {
    display: none;
    margin: 20px auto;
    background: #2c2c2c;
    padding: 20px;
    border-radius: 15px;
    width: 300px;
    color: white;
}

#newNote input[type="text"] {
    width: 100%;
    margin-bottom: 10px;
    padding: 8px;
    border-radius: 8px;
    border: none;
}

#newNote input[type="submit"] {
    width: 100%;
    padding: 10px;
    background: #3041db;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

#newNote textarea {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: none;
    resize: vertical; /* user can expand */
    font-family: Arial, sans-serif;
    margin-bottom: 10px;
}

/* notes grid */
.notes-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    padding: 20px;
}

/* note card */
.note {
    background: #2c2c2c;
    color: white;
    border-radius: 15px;
    padding: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    transition: 0.2s;
}

.note:hover {
    transform: scale(1.03);
}

/* title row */
.title {
    font-weight: bold;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* content */
.content {
    margin-top: 10px;
}

/* delete button (icon style) */
.delete-btn {
    background: none;
    border: none;
    color: #ff4d4d;
    font-size: 18px;
    cursor: pointer;
}

.delete-btn:hover {
    color: red;
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
<!-- TOP BAR -->
<div class="top-bar">
    <form method="POST">
        <button type="submit" name="back" id="backBtn">← Back</button>
    </form>

    <button id="addBtn" onclick="toggleForm()">+ Add Note</button>

    <div></div>
</div>

<!-- ADD NOTE FORM -->
<form id="newNote" method="POST" action="saveNewNote.php">
    Title:<input type="text" name="noteTitle"><br>
    Text:<textarea type="text" name="noteText" rows=10></textarea><br>
    <input type="submit" value="Save">
</form>

<h2 style="text-align:center;">Your Notes</h2>

<div class="notes-container">
<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        
        <div class="note">
            <div class="title" onclick="toggleNote(this)">
                <?php echo htmlspecialchars($row['title']); ?>

                <!-- DELETE -->
                <form method="POST" action="deleteNote.php" onsubmit="return confirmDelete(event);">
                    <input type="hidden" name="note_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="delete-btn">🗑</button>
                </form>
            </div>

            <div class="content" style="display:none;">
                <?php echo nl2br(htmlspecialchars($row['note'])); ?>
            </div>
        </div>

    <?php endwhile; ?>
<?php else: ?>
    <p style="grid-column: 1/-1; text-align:center;">No notes yet</p>
<?php endif; ?>
</div>

<script>
function toggleNote(element) {
    let content = element.parentElement.querySelector(".content");

    content.style.display = content.style.display === "block" ? "none" : "block";
}

function toggleForm() {
    let form = document.getElementById("newNote");
    form.style.display = form.style.display === "block" ? "none" : "block";
}

function confirmDelete(event) {
    event.stopPropagation(); // prevent toggle
    return confirm("Are you sure you want to delete this note?");
}
</script>

</body>
</html>
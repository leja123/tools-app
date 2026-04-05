<?php
session_start();

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

//exit button
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
.note {
    border: 1px solid #ccc;
    margin: 10px 0;
    padding: 10px;
}

.title {
    font-weight: bold;
    cursor: pointer;
}

.content {
    margin-top: 5px;
}

.delete-btn {
    margin-top: 10px;
    background: red;
    color: white;
    border: none;
    padding: 5px;
    cursor: pointer;
}
</style>
<form method="POST" style="position: absolute; top: 20px; left: 20px;">
    <button type="submit" name="back" id="backBtn">← Back</button>
</form>
<form id="newNote" method="POST" action="saveNewNote.php">
    Title:<input type="text" name="noteTitle"><br>
    Text:<input type="text" name="noteText"><br>
    <input type="submit" value="Save">
</form>

<h2>Your Notes:</h2>

<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        
        <div class="note">
            <div class="title" onclick="toggleNote(this)">
                <?php echo htmlspecialchars($row['title']); ?>
                <!-- DELETE FORM -->
                <form method="POST" action="deleteNote.php" onsubmit="return confirmDelete();">
                    <input type="hidden" name="note_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </div>

            <div class="content" style="display:none;">
                <?php echo nl2br(htmlspecialchars($row['note'])); ?>
            </div>
        </div>

    <?php endwhile; ?>
<?php else: ?>
    <p>No notes yet</p>
<?php endif; ?>

<script>
function toggleNote(element) {
    let content = element.nextElementSibling;

    if (content.style.display === "none") {
        content.style.display = "block";
    } else {
        content.style.display = "none";
    }
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this note?");
}
</script>

</body>
</html>
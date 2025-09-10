<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];


require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/functions.php';

// Handle form actions with POST.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['task'])) {
        addTodo($conn,$user_id, $_POST['task']);

    } elseif (isset($_POST['toggle'])) {
        toggleTodo($conn, $_POST['toggle']);

    } elseif (isset($_POST['delete'])) {
        deleteTodo($conn, $_POST['delete']);
    }
    header("Location: index.php");
    exit;
}

$todos = getTodos($conn, $user_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Todo List (MySQLi)</title>
     <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>✅ My Todo List ✅ </h1>
<p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</p>

    <!-- Logout button -->
    <form action="logout.php" method="POST" style="text-align:right; margin-bottom:20px;">
        <button type="submit" class="logout-btn">Logout</button>
    </form>
    
    <form method="POST">
        <input type="text" name="task" placeholder="New task" required>
        <button class="form-btn" type="submit">Add</button>
    </form>


    <ul>
        <?php foreach ($todos as $todo): ?>
            <li class="<?= $todo['done'] ? 'done' : '' ?>">
                <?= htmlspecialchars($todo['task']) ?>
                <form method="POST" style="display:inline">
                    <button type="submit" name="toggle" value="<?= $todo['id'] ?>">
                        <?= $todo['done'] ? 'Undo' : 'Done' ?>
                    </button>
                    <button type="submit" name="delete" value="<?= $todo['id'] ?>">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>

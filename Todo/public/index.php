<?php
require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/functions.php';

// Handle form actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['task'])) {
        addTodo($conn, $_POST['task']);
    } elseif (isset($_POST['toggle'])) {
        toggleTodo($conn, $_POST['toggle']);
    } elseif (isset($_POST['delete'])) {
        deleteTodo($conn, $_POST['delete']);
    }
    header("Location: index.php");
    exit;
}

$todos = getTodos($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Todo List (MySQLi)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { margin-bottom: 20px; }
        ul { list-style: none; padding: 0; }
        li { margin: 8px 0; }
        .done { text-decoration: line-through; color: gray; }
        button { margin-left: 8px; }


        body {
    display: flex;
    justify-content: center;  /* horizontal center */
    align-items: center;      /* vertical center */
    height: 100vh;            /* take full viewport height */
    margin: 0;
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
}

.container {
    background: white;
    padding: 20px 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    width: 400px;
    text-align: center;
}
    </style>
</head>
<body>

<div class="container">
    <h1>✅ My Todo List ✅ </h1>

    <form method="POST">
        <input type="text" name="task" placeholder="New task" required>
        <button type="submit">Add</button>
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

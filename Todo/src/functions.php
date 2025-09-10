<?php

function getTodos($conn) {
    $sql = "SELECT * FROM todos ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function addTodo($conn, $task) {
    $stmt = mysqli_prepare($conn, "INSERT INTO todos (task) VALUES (?)");
    mysqli_stmt_bind_param($stmt, "s", $task);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function toggleTodo($conn, $id) {
    $stmt = mysqli_prepare($conn, "UPDATE todos SET done = 1 - done WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function deleteTodo($conn, $id) {
    $stmt = mysqli_prepare($conn, "DELETE FROM todos WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

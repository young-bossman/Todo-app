<?php

//function to get all todos for a user.
function getTodos($conn, $user_id) {
    $sql = "SELECT * FROM todos WHERE user_id = ? ORDER BY id DESC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
//function to add a todo for a user.
function addTodo($conn, $user_id, $task) {
    $sql = "INSERT INTO todos (user_id, task, done) VALUES (?, ?, 0)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "is", $user_id, $task);
    return mysqli_stmt_execute($stmt);
}
//function to toggle the done status of a todo.
function toggleTodo($conn, $id) {
    $stmt = mysqli_prepare($conn, "UPDATE todos SET done = 1 - done WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
//function to delete a todo.
function deleteTodo($conn, $id) {
    $stmt = mysqli_prepare($conn, "DELETE FROM todos WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

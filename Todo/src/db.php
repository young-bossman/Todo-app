<?php
$config = require __DIR__ . '/../config/config.php';

$conn = mysqli_connect(
    $config['host'],
    $config['user'],
    $config['pass'],
    $config['db']
);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

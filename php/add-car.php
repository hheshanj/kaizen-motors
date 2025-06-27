<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO cars (make, model, year, price, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$make, $model, $year, $price, $user_id]);

    header("Location: ../all-cars.php");
    exit();
}
?>

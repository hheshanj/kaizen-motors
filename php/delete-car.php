<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = $_POST['car_id'];

    $stmt = $pdo->prepare("DELETE FROM cars WHERE id = ? AND user_id = ?");
    $stmt->execute([$car_id, $_SESSION['user_id']]);

    header("Location: ../all-cars.php");
    
    exit();
}
?>

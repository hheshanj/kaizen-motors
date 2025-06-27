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

    $image_path = null;
    if (!empty($_FILES['image']['name'])) {
    $target_dir = "../assets/uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $filename = uniqid() . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_path = "assets/uploads/" . $filename;
    }
}


    $stmt = $pdo->prepare("INSERT INTO cars (make, model, year, price, user_id, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$make, $model, $year, $price, $user_id, $image_path]);


    header("Location: ../all-cars.php");
    
    exit();
}
?>

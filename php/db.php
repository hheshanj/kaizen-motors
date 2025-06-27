<?php
$host = 'localhost';
$db   = 'carsale';
$user = 'root';
$pass = ''; // default no password on XAMPP
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

$pdo = new PDO($dsn, $user, $pass, $options);
?>

<?php
require 'php/db.php';

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();

echo "<pre>";
print_r($users);
echo "</pre>";
?>

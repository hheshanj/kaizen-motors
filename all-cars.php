<?php
session_start();
require 'php/db.php';

// Fetch cars
$stmt = $pdo->query("SELECT cars.*, users.username FROM cars LEFT JOIN users ON cars.user_id = users.id");
$cars = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>All Cars - Kaizen Motors</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>

  <header>
    <a href="index.html" style="text-decoration: none; color:white"><h1>Kaizen Motors 車</h1></a>
    <nav>
      <a href="index.html">Home</a>
      <a href="all-cars.php">All Cars</a>
      <?php if (isset($_SESSION['user_id'])): ?>
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <a href="php/logout.php">Logout</a>
      <?php else: ?>
        <a href="login.html">Login</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <section class="cars-list">
      <h2>Available Cars</h2>
      <div class="cars">
        <?php foreach ($cars as $car): ?>
          <div class="car-card">
            <?php if (!empty($car['image'])): ?>
            <img src="<?php echo htmlspecialchars($car['image']); ?>" alt="Car Image">
            <?php else: ?>
           <img src="assets/default-car.jpg" alt="No Image">
            <?php endif; ?>

            <h3><?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?></h3>
            <p>Year: <?php echo $car['year']; ?></p>
            <p>Price: $<?php echo $car['price']; ?></p>
            <p>Seller: <?php echo htmlspecialchars($car['username']); ?></p>
            <?php if (isset($_SESSION['user_id']) && $car['user_id'] == $_SESSION['user_id']): ?>
              <form action="php/delete-car.php" method="POST">
                <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
                <button type="submit">Delete</button>
              </form>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <?php if (isset($_SESSION['user_id'])): ?>
      <section class="add-car">
        <h3>Add Your Car For Sale</h3>
        <form action="php/add-car.php" method="POST" enctype="multipart/form-data">
          <input type="text" name="make" placeholder="Make" required><br>
          <input type="text" name="model" placeholder="Model" required><br>
          <input type="number" name="year" placeholder="Year" required><br>
          <input type="number" step="0.01" name="price" placeholder="Price" required><br>
          <input type="file" name="image" accept="image/*"><br>
          <button type="submit">Add Car</button>
        </form>
      </section>
    <?php else: ?>
      <p><a href="login.html">Login</a> to add your car for sale!</p>
    <?php endif; ?>
    
  </main>

</body>
</html>

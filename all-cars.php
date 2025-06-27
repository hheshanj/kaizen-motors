<?php
session_start();
require 'php/db.php';

$stmt = $pdo->query("SELECT cars.*, users.username FROM cars LEFT JOIN users ON cars.user_id = users.id");
$cars = $stmt->fetchAll();
?>

<section class="cars-list">
  <h2>Available Cars</h2>
  <div class="cars">
    <?php foreach ($cars as $car): ?>
      <div class="car-card">
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
    <form action="php/add-car.php" method="POST">
      <input type="text" name="make" placeholder="Make" required><br>
      <input type="text" name="model" placeholder="Model" required><br>
      <input type="number" name="year" placeholder="Year" required><br>
      <input type="number" step="0.01" name="price" placeholder="Price" required><br>
      <button type="submit">Add Car</button>
    </form>
  </section>
<?php else: ?>
  <p><a href="login.html">Login</a> to add your car for sale!</p>
<?php endif; ?>

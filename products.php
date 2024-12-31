<?php
// Database connection
$servername = "localhost"; // change to your server
$username = "root"; // change to your username
$password = "       "; // change to your password
$dbname = "boutique_en_ligne"; // change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if there is a search term
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query to fetch products, optionally filtered by search term
$sql = "SELECT * FROM produits WHERE nom LIKE '%$searchTerm%'";  // Search query if a search term is provided
$result = $conn->query($sql);

// Check if query was successful
if (!$result) {
    die("Query failed: " . $conn->error); // Show error if the query fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products - Underwear Shop</title>
    <link rel="stylesheet" href="products.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <h1>Underwear Shop</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div class="search">
            <form action="products.php" method="get">
                <input type="text" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Search products...">
                <button type="submit">Search</button>
            </form>
        </div>
    </header>

    <!-- Products Section -->
    <section class="products">
        <h2>Our Collection</h2>
        <div class="product-grid">
            <?php
            if ($result->num_rows > 0) {
                // Loop through products and display them
                while($row = $result->fetch_assoc()) {
                    echo "<div class='product-item'>";
                    echo "<img src='" . htmlspecialchars($row['image_url']) . "' alt='" . htmlspecialchars($row['nom']) . "'>";
                    echo "<h3>" . htmlspecialchars($row['nom']) . "</h3>";
                    echo "<p>Price: $" . number_format($row['prix'], 2) . "</p>";
                    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                    echo "<form action='add_to_cart.php' method='post'>";
                    echo "<input type='hidden' name='product_id' value='" . $row['ID'] . "'>";
                    echo "<button type='submit'>Add to Cart</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Underwear Shop. All rights reserved.</p>
        <div class="social-media">
            <a href="#">Facebook</a>
            <a href="#">Instagram</a>
        </div>
    </footer>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Products - Underwear Shop</title>
  <link rel="stylesheet" href="products.css"> <!-- Add your custom styles here -->
</head>
<body>

  <!-- Header Section -->
  <header>
    <div class="logo">
      <h1>Underwear Shop</h1>
    </div>
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
    <div class="search">
      <input type="text" placeholder="Search products...">
    </div>
  </header>

  <!-- Products Section -->
  <section class="products">
    <h2>Our Collection</h2>
    <div class="product-grid">
      <!-- Static Content for Products -->

      <!-- Product 1 -->
      <div class="product">
        <img src="images/comfort_boxer.jpg" alt="Comfort Boxer">
        <h3>Comfort Boxer</h3>
        <p>Soft and comfortable cotton boxers for everyday use.</p>
        <p>Price: $15.99</p>
        <button>Add to Cart</button>
      </div>

      <!-- Product 2 -->
      <div class="product">
        <img src="images/silk_briefs.jpg" alt="Silk Briefs">
        <h3>Silk Briefs</h3>
        <p>Luxurious silk briefs for a smooth, comfortable feel.</p>
        <p>Price: $29.99</p>
        <button>Add to Cart</button>
      </div>

      <!-- Product 3 -->
      <div class="product">
        <img src="images/cotton_lounge.jpg" alt="Cotton Lounge Wear">
        <h3>Cotton Lounge Wear</h3>
        <p>Perfect for lounging at home, made from 100% cotton.</p>
        <p>Price: $22.50</p>
        <button>Add to Cart</button>
      </div>

      <!-- Product 4 -->
      <div class="product">
        <img src="images/mesh_boxers.jpg" alt="Mesh Boxers">
        <h3>Mesh Boxers</h3>
        <p>Breathable and lightweight mesh boxers for comfort and style.</p>
        <p>Price: $18.50</p>
        <button>Add to Cart</button>
      </div>

    </div>
  </section>

  <!-- Footer Section -->
  <footer>
    <p>&copy; 2024 Underwear Shop. All rights reserved.</p>
    <div class="social-media">
      <a href="#">Facebook</a>
      <a href="#">Instagram</a>
    </div>
  </footer>

</body>
</html>

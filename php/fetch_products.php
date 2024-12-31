<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'boutique_en_ligne');

// Check for a connection error
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch products from the 'produits' table
$sql = "SELECT * FROM produits";
$result = $conn->query($sql);

// Check if products exist
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-item'>
                <img src='" . $row['image_url'] . "' alt='" . htmlspecialchars($row['nom'], ENT_QUOTES) . "'>
                <h3>" . htmlspecialchars($row['nom'], ENT_QUOTES) . "</h3>
                <p>Price: $" . number_format($row['prix'], 2) . "</p>
                <p>" . htmlspecialchars($row['description'], ENT_QUOTES) . "</p>
              </div>";
    }
} else {
    echo "<p>No products available.</p>";
}

// Close the connection
$conn->close();
?>

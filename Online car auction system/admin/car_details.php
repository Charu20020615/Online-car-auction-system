<?php
include 'includes/db.php'; // Database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM cars WHERE id = $id");

    if ($row = $result->fetch_assoc()) {
        echo "<h2>" . $row['name'] . " (" . $row['model'] . ")</h2>";
        echo "<img src='assets/" . $row['image'] . "' width='300'><br>";
        echo "<p>Price: $" . $row['price'] . "</p>";
        echo "<p>Description: " . $row['description'] . "</p>";
    } else {
        echo "Car not found!";
    }
} else {
    echo "Invalid request!";
}
?>

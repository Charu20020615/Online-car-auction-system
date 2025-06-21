<?php
if (!file_exists(__DIR__ . '/db.php')) {
    die("Error: db.php file not found!");
}
include __DIR__ . '/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars for Sale</title>
    <link rel="stylesheet" href="styles/style.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="styles/cars.css"> <!-- Link to cars.php specific styles -->
</head>
<body class="cars-page"> <!-- Add a unique class 'cars-page' -->

    <!-- Navigation Bar -->
    <nav>
        <div class="logo">Online Car Sale</div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cars.php">Cars</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </nav>

    <!-- Car Listings Section -->
    <section class="car-list">
        <h2>All Cars Available</h2>
        <div class="car-container">
            <?php
            // Query to fetch all cars
            $query = "SELECT * FROM cars"; 
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='car-card'>
                        <img src='assets/" . $row['image'] . "' alt='Car Image'>
                        <h3>" . $row['name'] . " " . $row['model'] . "</h3>
                        <p>Price: $" . number_format($row['price'], 2) . "</p>
                        <a href='car_details.php?id=" . $row['id'] . "' class='btn'>View Details</a>
                    </div>";
                }
            } else {
                echo "<p>No cars available</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Online Car Sale. All Rights Reserved.</p>
    </footer>

</body>
</html>

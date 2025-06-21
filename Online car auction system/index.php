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
    <title>Online Car Sale</title>
    <link rel="stylesheet" href="styles/style.css"> <!-- Link to your CSS file -->
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="logo">Online Car Sale</div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cars.php">Cars</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="adminlogin.php">Login as Admin</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="faq.php">FAQ</a></li> <!-- FAQ Button -->
        </ul>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <h1>Find Your Dream Car Today</h1>
        <p>Browse from a wide range of vehicles available for sale</p>
        <a href="cars.php" class="btn">Show Available Cars</a>
    </header>

    <!-- Car Listings Section -->
    <section class="car-list">
        <h2>Latest Cars</h2>
        <div class="car-container">
            <?php
            // Query to fetch the latest 6 cars
            $query = "SELECT * FROM cars ORDER BY id DESC LIMIT 6"; 
            $result = $conn->query($query);

            // Check if there are cars to display
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Display each car's details
                    echo "
                    <div class='car-card'>
                        <img src='assets/" . $row['image'] . "' alt='Car Image'>
                    </div>";
                }
            } else {
                // If no cars are available
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

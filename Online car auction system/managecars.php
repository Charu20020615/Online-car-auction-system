<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminlogin.php");
    exit();
}

if (!file_exists(__DIR__ . '/db.php')) {
    die("Error: db.php file not found!");
}
include __DIR__ . '/db.php';

// Handle car deletion
if (isset($_GET['delete'])) {
    $car_id = $_GET['delete'];
    $delete_sql = "DELETE FROM cars WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $car_id);
    if ($stmt->execute()) {
        header("Location: managecars.php?success=Car deleted successfully");
        exit();
    } else {
        echo "<script>alert('Error deleting car');</script>";
    }
}

// Fetch all cars
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/admin.css">
</head>
<body class="admin-page">

    <nav>
        <div class="logo">Admin Panel</div>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <section class="admin-container">
        <h2>Manage Cars</h2>
        <a href="add_car.php" class="add-btn">Add Car</a>
 <!-- Add Car Button -->
        <table class="car-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['model']); ?></td>
                    <td>$<?php echo htmlspecialchars(number_format($row['price'], 2)); ?></td>
                    <td><img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" width="80"></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td>
                        <a href="updatecar.php?id=<?php echo $row['id']; ?>" class="edit-btn">Update</a>
                        <a href="managecars.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this car?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; 2024 Online Car Sale. All Rights Reserved.</p>
    </footer>

</body>
</html>

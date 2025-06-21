<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminlogin.php");
    exit();
}

if (!file_exists(__DIR__ . '/db.php')) {
    die("Error: db.php file not found!");
}
include __DIR__ . '/db.php';

// Fetch the car ID from URL (for editing specific car)
if (!isset($_GET["id"])) {
    header("Location: managecars.php");
    exit();
}

$car_id = $_GET["id"];

// Get car details for editing
$sql = "SELECT * FROM cars WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $car_id);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = trim($_POST["name"]);
    $model = trim($_POST["model"]);
    $price = $_POST["price"];
    $description = trim($_POST["description"]);

    // Handle image upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        
        // Move the uploaded file to the "uploads" directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = basename($_FILES["image"]["name"]);
        }
    }

    // Update query (with or without image)
    if ($image != '') {
        $sql = "UPDATE cars SET name = ?, model = ?, price = ?, image = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssi", $name, $model, $price, $image, $description, $car_id);
    } else {
        // If no new image, update without changing the image field
        $sql = "UPDATE cars SET name = ?, model = ?, price = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsi", $name, $model, $price, $description, $car_id);
    }

    // Execute the query
    if ($stmt->execute()) {
        header("Location: managecars.php?success=Car updated successfully");
        exit();
    } else {
        echo "<script>alert('Error updating car');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Car</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/managecars.css">
</head>
<body class="admin-page">

    <!-- Navigation Bar -->
    <nav>
        <div class="logo">Admin Panel</div>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <!-- Update Car Form -->
    <section class="update-car-container">
        <h2>Update Car Details</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $car['id']; ?>" />
            <input type="text" name="name" value="<?php echo htmlspecialchars($car['name']); ?>" required placeholder="Car Name">
            <input type="text" name="model" value="<?php echo htmlspecialchars($car['model']); ?>" required placeholder="Car Model">
            <input type="number" name="price" value="<?php echo htmlspecialchars($car['price']); ?>" required placeholder="Price" step="0.01">
            <textarea name="description" required placeholder="Description"><?php echo htmlspecialchars($car['description']); ?></textarea>
            
            <!-- Image upload field -->
            <label for="image">Car Image:</label>
            <input type="file" name="image" id="image" accept="image/*">
            
            <button type="submit">Update Car</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Online Car Sale. All Rights Reserved.</p>
    </footer>

</body>
</html>

<?php
if (!file_exists(__DIR__ . '/db.php')) {
    die("Error: db.php file not found!");
}
include __DIR__ . '/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Handle Image Upload
    $image = $_FILES['image']['name'];
    $target_dir = "assets/";  // Folder where images are stored
    $target_file = $target_dir . basename($image);

    // Move the uploaded file to the target folder
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Insert data into the database
        $sql = "INSERT INTO cars (name, model, price, image, description) 
                VALUES ('$name', '$model', '$price', '$image', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "Car added successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}
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

    <!-- Your form or content here (car addition, etc.) -->

    <!-- Footer Section with Home Button -->
    <footer>
        <a href="index.php" class="btn">Go to Home</a>
    </footer>

</body>
</html>

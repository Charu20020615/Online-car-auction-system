<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
</head>
<body>
    <h2>Add a New Car</h2>
    <form action="upload_car.php" method="POST" enctype="multipart/form-data">
        <label>Car Name:</label>
        <input type="text" name="name" required><br>

        <label>Model:</label>
        <input type="text" name="model" required><br>

        <label>Price ($):</label>
        <input type="number" name="price" step="0.01" required><br>

        <label>Description:</label>
        <textarea name="description" required></textarea><br>

        <label>Car Image:</label>
        <input type="file" name="image" accept="image/*" required><br>

        <button type="submit">Upload Car</button>
    </form>
</body>
</html>

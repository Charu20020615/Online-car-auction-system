<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: ../login.php");
    exit();
}

echo "<h2>Admin Panel</h2>";

$result = $conn->query("SELECT * FROM cars");
while ($row = $result->fetch_assoc()) {
    echo "<div>
        <h3>" . $row['name'] . " - $" . $row['price'] . "</h3>
        <a href='edit_car.php?id=" . $row['id'] . "'>Edit</a> | 
        <a href='delete_car.php?id=" . $row['id'] . "'>Delete</a>
    </div>";
}
?>

<?php
include 'includes/db.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$car_id = $_GET["id"];

$sql = "INSERT INTO cart (user_id, car_id) VALUES ($user_id, $car_id)";
$conn->query($sql);

echo "Car added to cart!";
?>
<a href="checkout.php">Go to Checkout</a>

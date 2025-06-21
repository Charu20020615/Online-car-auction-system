<?php
include 'includes/db.php';
session_start();

$user_id = $_SESSION["user_id"];
$sql = "INSERT INTO orders (user_id, car_id, status) SELECT user_id, car_id, 'Pending' FROM cart WHERE user_id=$user_id";
$conn->query($sql);

$conn->query("DELETE FROM cart WHERE user_id=$user_id");
echo "Order placed successfully!";
?>
<a href="order_history.php">View Orders</a>

<?php
session_start();
if (!file_exists(__DIR__ . '/db.php')) {
    die("Error: db.php file not found!");
}
include __DIR__ . '/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Fetch admin details
    $sql = "SELECT * FROM admin WHERE email='$email'";
    $result = $conn->query($sql);
    $admin = $result->fetch_assoc();

    // Verify password and authenticate admin
    if ($admin && $password === $admin["password"]) {
        $_SESSION["admin_id"] = $admin["id"];
        $_SESSION["admin_username"] = $admin["username"];
        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Invalid credentials!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/login.css">
</head>
<body class="login-page">

    <nav>
        <div class="logo">Admin Panel</div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="adminlogin.php">Admin Login</a></li>
        </ul>
    </nav>

    <section class="login-container">
        <h2>Admin Login</h2>
        <form method="POST" class="login-form">
            <input type="email" name="email" placeholder="Admin Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Online Car Sale. All Rights Reserved.</p>
    </footer>

</body>
</html>

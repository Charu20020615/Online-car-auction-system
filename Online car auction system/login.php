<?php
if (!file_exists(__DIR__ . '/db.php')) {
    die("Error: db.php file not found!");
}
include __DIR__ . '/db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["role"] = $user["role"];
        header("Location: index.php");
    } else {
        echo "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/style.css"> <!-- Link to your general CSS file -->
    <link rel="stylesheet" href="styles/login.css"> <!-- Link to login-specific CSS -->
</head>
<body class="login-page"> <!-- Add a unique class 'login-page' -->

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

    <!-- Login Section -->
    <section class="login-container">
        <h2>Login</h2>
        <form method="POST" class="login-form">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Online Car Sale. All Rights Reserved.</p>
    </footer>

</body>
</html>

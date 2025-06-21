<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminlogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION["admin_username"]); ?>!</h2>
        <div class="admin-actions">
            <a href="manageuser.php" class="admin-button">Manage Users</a>
            <a href="managecars.php" class="admin-button">Manage Cars</a>
            <a href="adminfaq.php" class="admin-button">Manage FAQ</a> <!-- New Manage FAQ Button -->
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Online Car Sale. All Rights Reserved.</p>
    </footer>

</body>
</html>

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

// Handle user deletion
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $delete_sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        header("Location: manageuser.php");
        exit();
    } else {
        echo "<script>alert('Error deleting user');</script>";
    }
}

// Fetch all users
$sql = "SELECT id, name, email, role FROM users"; // Changed 'username' to 'name'
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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
        <h2>Manage Users</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th> <!-- Updated column name -->
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name'] ?? 'N/A'); ?></td> <!-- Updated column name -->
                    <td><?php echo htmlspecialchars($row['email'] ?? 'N/A'); ?></td>
                    <td><?php echo htmlspecialchars($row['role'] ?? 'N/A'); ?></td>
                    <td>
                        <a href="updateuser.php?id=<?php echo $row['id']; ?>" class="edit-btn">Update</a>
                        <a href="manageuser.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
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

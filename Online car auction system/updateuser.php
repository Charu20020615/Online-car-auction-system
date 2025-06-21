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

// Check if user ID is provided
if (!isset($_GET['id'])) {
    die("Error: User ID not specified.");
}

$user_id = $_GET['id'];

// Fetch user details
$sql = "SELECT id, name, email, role FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Error: User not found.");
}

// Handle form submission for updating user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $role = $_POST["role"];

    // Update user details in the database
    $update_sql = "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssi", $name, $email, $role, $user_id);

    if ($update_stmt->execute()) {
        header("Location: manageuser.php?success=User updated successfully");
        exit();
    } else {
        echo "<script>alert('Error updating user');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/admin.css">
</head>
<body class="admin-page">

    <nav>
        <div class="logo">Admin Panel</div>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="manageuser.php">Manage Users</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <section class="admin-container">
        <h2>Update User</h2>
        <form method="POST" class="update-form">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label>Role:</label>
            <select name="role" required>
                <option value="customer" <?php if ($user['role'] == 'customer') echo 'selected'; ?>>Customer</option>
                <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            </select>

            <button type="submit">Update User</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Online Car Sale. All Rights Reserved.</p>
    </footer>

</body>
</html>

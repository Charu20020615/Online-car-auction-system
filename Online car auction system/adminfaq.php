<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminlogin.php");
    exit();
}

include 'db.php';

// Fetch all FAQs from the database
$sql = "SELECT * FROM faq";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage FAQ</title>
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
        <h2>Manage FAQs</h2>
        <a href="addfaq.php" class="admin-button">Add FAQ</a> <!-- Add FAQ Button -->

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo htmlspecialchars($row["question"]); ?></td>
                        <td><?php echo htmlspecialchars($row["answer"]); ?></td>
                        <td>
                            <a href="edit_faq.php?id=<?php echo $row["id"]; ?>" class="edit-btn">Update</a>
                            <a href="delete_faq.php?id=<?php echo $row["id"]; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this FAQ?');">Delete</a>
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

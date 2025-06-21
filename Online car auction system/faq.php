<?php
if (!file_exists(__DIR__ . '/db.php')) {
    die("Error: db.php file not found!");
}
include __DIR__ . '/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs - Online Car Sale</title>
    <link rel="stylesheet" href="styles/style.css"> <!-- General CSS -->
    <link rel="stylesheet" href="styles/faq.css">   <!-- FAQ Page Specific CSS -->
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <div class="logo">Online Car Sale</div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="cars.php">Cars</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="adminlogin.php">Login as Admin</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="faq.php" class="active">FAQ</a></li>
        </ul>
    </nav>

    <!-- FAQ Section -->
    <section class="faq-container">
        <h2>Frequently Asked Questions</h2>

        <!-- Search Bar -->
        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search for a question..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" required>
            <button type="submit">Search</button>
        </form>

        <!-- FAQ Display Section -->
        <div class="faq-list">
            <?php
            // Check if a search query is entered
            $searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

            // SQL Query: Search or Get All FAQs
            if (!empty($searchQuery)) {
                $query = "SELECT * FROM faq WHERE question LIKE ? OR answer LIKE ?";
                $stmt = $conn->prepare($query);
                $searchParam = "%" . $searchQuery . "%";
                $stmt->bind_param("ss", $searchParam, $searchParam);
            } else {
                $query = "SELECT * FROM faq";
                $stmt = $conn->prepare($query);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='faq-item'>
                        <h3>" . htmlspecialchars($row['question']) . "</h3>
                        <p>" . htmlspecialchars($row['answer']) . "</p>
                    </div>";
                }
            } else {
                echo "<p class='no-results'>No FAQs found.</p>";
            }

            $stmt->close();
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Online Car Sale. All Rights Reserved.</p>
    </footer>

</body>
</html>

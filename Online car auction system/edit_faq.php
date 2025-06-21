<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminlogin.php");
    exit();
}

include 'db.php';

if (!isset($_GET["id"])) {
    header("Location: adminfaq.php");
    exit();
}

$id = $_GET["id"];

// Fetch FAQ details
$sql = "SELECT * FROM faq WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$faq = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $answer = $_POST["answer"];

    $update_sql = "UPDATE faq SET question=?, answer=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $question, $answer, $id);

    if ($update_stmt->execute()) {
        header("Location: adminfaq.php");
        exit();
    } else {
        echo "Error updating FAQ.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit FAQ</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/admin.css">
</head>
<body class="admin-page">

    <nav>
        <div class="logo">Admin Panel</div>
        <ul>
            <li><a href="adminfaq.php">Back</a></li>
        </ul>
    </nav>

    <section class="admin-container">
        <h2>Edit FAQ</h2>
        <form method="POST">
            <input type="text" name="question" value="<?php echo htmlspecialchars($faq['question']); ?>" required>
            <textarea name="answer" required><?php echo htmlspecialchars($faq['answer']); ?></textarea>
            <button type="submit">Update FAQ</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Online Car Sale. All Rights Reserved.</p>
    </footer>

</body>
</html>

<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminlogin.php");
    exit();
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST["question"];
    $answer = $_POST["answer"];

    $sql = "INSERT INTO faq (question, answer) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $question, $answer);
    
    if ($stmt->execute()) {
        header("Location: adminfaq.php");
        exit();
    } else {
        echo "Error adding FAQ.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add FAQ</title>
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
        <h2>Add FAQ</h2>
        <form method="POST">
            <input type="text" name="question" placeholder="Question" required>
            <textarea name="answer" placeholder="Answer" required></textarea>
            <button type="submit">Add FAQ</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Online Car Sale. All Rights Reserved.</p>
    </footer>

</body>
</html>

<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: adminlogin.php");
    exit();
}

include 'db.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM faq WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: adminfaq.php");
        exit();
    } else {
        echo "Error deleting FAQ.";
    }
} else {
    header("Location: adminfaq.php");
    exit();
}
?>

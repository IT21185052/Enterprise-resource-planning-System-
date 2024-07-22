<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $itemId = $_GET['id'];
    $deleteQuery = "DELETE FROM customer WHERE id = ?";
    $deleteStmt = $pdo->prepare($deleteQuery);
    $deleteStmt->execute([$itemId]);

    header('Location: view.php');
    exit;
} else {
    echo "No Customer specified!";
    exit;
}
?>

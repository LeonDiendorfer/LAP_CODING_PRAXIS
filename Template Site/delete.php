<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderID = $_POST['orderID'];

    try {
        $stmt = $pdo->prepare("DELETE FROM orders WHERE OrderID = ?");
        $stmt->execute([$orderID]);
        $_SESSION['success'] = 'Data deleted successfully!';
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Deletion failed: ' . $e->getMessage();
    }

    header('Location: index.php');
    exit();
}
?>
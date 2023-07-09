<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderID = $_POST['orderID'];
    $orderNumber = $_POST['orderNumber'];
    $personID = $_POST['personID'];
    //    md5($personID = $_POST['personID']); // FÜR HASH FELDER

    try {
        $stmt = $pdo->prepare("UPDATE orders SET orderid = ?, ordernumber = ?, personid = ? WHERE OrderID = ?;");
        $stmt->execute([$orderID, $orderNumber, $personID, $orderID]);
        $_SESSION['success'] = 'Data inserted successfully!';
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Insertion failed: ' . $e->getMessage();
    }

    header('Location: index.php');
    exit();
}
?>
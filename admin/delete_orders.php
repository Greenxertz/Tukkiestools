<?php
session_start();

include('admin_header.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: admin_login.php');
    exit;
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id=?");
    $stmt->bind_param('i', $order_id);

    if ($stmt->execute()) {
        header('location: dashboard.php?delete_message=Delete was successful');
        exit;
    } else {
        header('location: dashboard.php?delete_message=Delete was unsuccessful');
        exit;
    }
}
?>

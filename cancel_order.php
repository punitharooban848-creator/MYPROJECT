<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}
include 'db.php';

$order_id = intval($_GET['id']);

// Cancel order by updating status
$sql = "UPDATE orders SET status='Cancelled' WHERE order_id='$order_id'";
if (mysqli_query($conn, $sql)) {
    header("Location: manage_orders.php?msg=cancelled");
    exit();
} else {
    echo "Error cancelling order: " . mysqli_error($conn);
}
?>
 
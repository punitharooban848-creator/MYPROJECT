<?php
session_start();
include("db.php");

$product_id = $_POST['product_id'];
$quantity   = $_POST['quantity'];

// Save pending order in session
$_SESSION['pending_order'] = [
    'product_id' => $product_id,
    'quantity'   => $quantity
];

// Check login
if(isset($_SESSION['user_id'])) {
    // Already logged in → go to order placement
    header("Location: order_place.php");
    exit();
} else {
    // Not logged in → go to login first
    header("Location: login.php");
    exit();
}
?>

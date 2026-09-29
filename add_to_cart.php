<?php
session_start();
include("db.php");

$user_id = $_SESSION['user_id'];

$product_id = $_GET['id'];

$sql = "SELECT * FROM products WHERE product_id='$product_id'";
$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);


$insert = $conn->prepare(
"INSERT INTO cart
(user_id, product_id, name, image, price, quantity)
VALUES (?, ?, ?, ?, ?, ?)"
);


$qty = 1;


$insert->bind_param(
"iissdi",
$user_id,
$row['product_id'],
$row['name'],
$row['image'],
$row['price'],
$qty
);


$insert->execute();


header("Location: cart_view.php");
exit();
?>
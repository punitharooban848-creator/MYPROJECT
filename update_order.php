<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}
include 'db.php'; // database connection

$order_id = intval($_GET['id']);

// Update form submit check
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_status = $_POST['status'];
    $query = "UPDATE orders SET status='$new_status' WHERE order_id='$order_id'";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_orders.php?msg=updated");
        exit();
    } else {
        echo "Error updating order: " . mysqli_error($conn);
    }
}

// Fetch order details with product name
$sql = "SELECT o.order_id, o.customer_name, o.customer_address, 
               o.order_date, o.delivery_date, o.status,
               p.name AS product_name
        FROM orders o
        JOIN products p ON o.product_id = p.product_id
        WHERE o.order_id='$order_id'";
$result = mysqli_query($conn, $sql);
$order = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_status = $_POST['status'];
    $delivery_date = $_POST['delivery_date'];

    $query = "UPDATE orders 
              SET status='$new_status', delivery_date='$delivery_date' 
              WHERE order_id='$order_id'";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_orders.php?msg=updated");
        exit();
    } else {
        echo "Error updating order: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Order</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 30px;
    background: #f4f6f9;
    color: #333;
}

h1 {
    color: #2c3e50;
    margin-bottom: 20px;
    text-align: center;
}

p {
    background: #fff;
    padding: 10px;
    border: 1px solid #ddd;
    margin: 8px 0;
    border-radius: 5px;
}

label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    color: #2c3e50;
}

select, input[type="date"] {
    padding: 8px;
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 5px;
}

button {
    margin-top: 20px;
    padding: 10px 25px;
    background: #27ae60;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s ease;
}

button:hover {
    background: #1e8449;
}
        
    </style>
</head>
<body>
<h1>Update Order Status</h1>
<p><b>Order ID:</b> <?= $order['order_id'] ?></p>
<p><b>Customer:</b> <?= $order['customer_name'] ?></p>
<p><b>Address:</b> <?= $order['customer_address'] ?></p>
<p><b>Product:</b> <?= $order['product_name'] ?></p>
<p><b>Order Date:</b> <?= $order['order_date'] ?></p>
<label for="delivery_date">Delivery Date:</label>
    <input type="date" name="delivery_date" id="delivery_date" 
           value="<?= $order['delivery_date'] ?>">
</p>
<p><b>Current Status:</b> <?= $order['status'] ?></p>

<form method="POST">
    <label for="status">Change Status:</label>
    <select name="status" id="status">
        <option value="Pending" <?= $order['status']=='Pending'?'selected':'' ?>>Pending</option>
        <option value="Processing" <?= $order['status']=='Processing'?'selected':'' ?>>Processing</option>
        <option value="Shipped" <?= $order['status']=='Shipped'?'selected':'' ?>>Shipped</option>
        <option value="Delivered" <?= $order['status']=='Delivered'?'selected':'' ?>>Delivered</option>
        <option value="Cancelled" <?= $order['status']=='Cancelled'?'selected':'' ?>>Cancelled</option>
        <option value="Completed" <?= $order['status']=='Completed'?'selected':'' ?>>Completed</option>
    </select>
    <button type="submit">Update</button>
</form>
</body>
</html>

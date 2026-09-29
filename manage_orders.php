<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}
include 'db.php'; // database connection

// 3 days koodi eduka DATE_ADD use pannuren
$sql = "SELECT o.order_id, 
               o.customer_name, 
               o.customer_address, 
               p.name AS product_name, 
               o.order_date, 
               DATE_ADD(o.order_date, INTERVAL 3 DAY) AS delivery_date, 
               o.status
        FROM orders o
        JOIN products p ON o.product_id = p.product_id
        ORDER BY o.order_id DESC"; // latest order first
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <style>
        body { font-family: Arial; background:#f9f9f9; padding:20px; }
       
        table { width:100%; border-collapse:collapse; background:#fff; }
       
        th, td { border:1px solid #ccc; padding:10px; text-align:center; }
      
        th { background:#333; color:#fff; }
       
        .update{ background:#000; color:#fff; border:1px solid #000; padding:8px 15px; text-decoration:none; border-radius:5px; }
        .update:hover{ background:#444; }

    </style>
</head>
<body>

<div class="arrow" onclick="showDashboard()">
    <a href="admin_dashboard.php"><img src="icons8-back-100.png". width="40" height="40"></a>
</div>


</div>

<h1>Orders Management</h1>
<table>
    <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Address</th>
        <th>Product</th>
        <th>Order Date</th>
        <th>Delivery Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $row['order_id'] ?></td>
    <td><?= $row['customer_name'] ?></td>
    <td><?= $row['customer_address'] ?></td>
    <td><?= $row['product_name'] ?></td> <!-- idha maathiten -->
    <td><?= date('d-m-Y', strtotime($row['order_date'])) ?></td> <!-- date format nice ah -->
    <td><?= date('d-m-Y', strtotime($row['delivery_date'])) ?></td> <!-- +3 days varum -->
    <td><?= $row['status'] ?></td>
    <td>
        <a class="update" href="update_order.php?id=<?= $row['order_id'] ?>">Update</a> <!-- button ah a tag ah maathiten -->
    </td>
</tr>
<?php } ?>
</table>
</body>
</html>






        


    


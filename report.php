<?php

session_start();
include("db.php");

if(!isset($_SESSION['role']) || $_SESSION['role']!="admin")
{
    header("Location: home.php");
    exit();
}


// Total Orders

$order_sql = "SELECT COUNT(*) AS total_orders FROM orders";
$order_result = mysqli_query($conn,$order_sql);
$order_data = mysqli_fetch_assoc($order_result);


// Total Sales

$sales_sql = "SELECT SUM(total_price) AS total_sales FROM orders";
$sales_result = mysqli_query($conn,$sales_sql);
$sales_data = mysqli_fetch_assoc($sales_result);


// Pending Orders

$pending_sql = "SELECT COUNT(*) AS pending FROM orders WHERE status='Pending'";
$pending_result = mysqli_query($conn,$pending_sql);
$pending_data = mysqli_fetch_assoc($pending_result);


// Completed Orders

$complete_sql = "SELECT COUNT(*) AS completed FROM orders WHERE status='Completed'";
$complete_result = mysqli_query($conn,$complete_sql);
$complete_data = mysqli_fetch_assoc($complete_result);


// Order Details Filter

$where = "WHERE 1";


if(isset($_GET['from_date']) && $_GET['from_date']!="")
{
    $from_date = $_GET['from_date'];

    $where .= " AND order_date >= '$from_date'";
}


if(isset($_GET['to_date']) && $_GET['to_date']!="")
{
    $to_date = $_GET['to_date'];

    $where .= " AND order_date <= '$to_date'";
}


if(isset($_GET['status']) && $_GET['status']!="")
{
    $status = $_GET['status'];

    $where .= " AND status='$status'";
}


$sql = "SELECT * FROM orders 
        $where 
        ORDER BY order_date DESC";


$result = mysqli_query($conn,$sql);
?>


<!DOCTYPE html>
<html>
<head>

<title>Sales Report</title>

<style>

body{
    font-family:Arial;
    background:#f5f5f5;
}


.container{
    width:90%;
    margin:auto;
}


.box{
    display:flex;
    gap:20px;
}


.card{

    background:white;
    padding:20px;
    width:200px;
    text-align:center;
    border-radius:10px;
    box-shadow:0 0 10px gray;

}


table{

width:100%;
background:white;
border-collapse:collapse;
margin-top:30px;

}


th,td{

border:1px solid black;
padding:10px;
text-align:center;

}


th{

background:black;
color:white;

}


</style>

</head>


<body>

<div class="arrow">
    <a href="admin_dashboard.php"><img src="icons8-back-100.png" width="40" height="40"></a>
</div>

<div class="container">


<h1 align="center">
Sales Report
</h1>

<form method="GET">

<label>From Date:</label>
<input type="date" name="from_date">


<label>To Date:</label>
<input type="date" name="to_date">


<label>Status:</label>

<select name="status">

<option value="">All</option>
<option value="Pending">Pending</option>
<option value="Completed">Completed</option>

</select>


<button type="submit">
Filter
</button>


<button type="button" onclick="window.print()">
Print Report
</button>
 
<style>@media print {

    .arrow,
    form,
    button {
        display:none;
    }


    body{
        background:white;
    }


    .container{
        width:100%;
    }


    table{
        border:1px solid black;
    }

}</style>
</form><br><br>

<div class="box">


<div class="card">
<h2>
<?php echo $order_data['total_orders']; ?>
</h2>
<p>Total Orders</p>
</div>



<div class="card">
<h2>
Rs. <?php echo $sales_data['total_sales'] ?? 0; ?>
</h2>
<p>Total Sales</p>
</div>



<div class="card">
<h2>
<?php echo $pending_data['pending']; ?>
</h2>
<p>Pending</p>
</div>



<div class="card">
<h2>
<?php echo $complete_data['completed']; ?>
</h2>
<p>Completed</p>
</div>


</div>



<table>

<tr>

<th>Order ID</th>
<th>Customer Name</th>
<th>Phone</th>
<th>Product ID</th>
<th>Quantity</th>
<th>Total Price</th>
<th>Status</th>
<th>Date</th>

</tr>


<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td>
<?php echo $row['order_id']; ?>
</td>


<td>
<?php echo $row['customer_name']; ?>
</td>


<td>
<?php echo $row['customer_phone']; ?>
</td>


<td>
<?php echo $row['product_id']; ?>
</td>


<td>
<?php echo $row['quantity']; ?>
</td>


<td>
Rs. <?php echo $row['total_price']; ?>
</td>


<td>
<?php echo $row['status']; ?>
</td>
  <td>
    <?php echo $row['order_date']; ?>
  </td>
</tr>

<?php

}

?>


</table>


</div>


</body>
</html>
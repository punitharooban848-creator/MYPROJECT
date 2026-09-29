<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')
{
    header("Location: home.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; }
       
.container { 
    width:80%; 
    margin:auto; 
    padding:20px; 
}

h1 { 
    text-align:center; 
}


.menu { 
    display:flex; 
    flex-wrap:wrap;
    gap:20px;              /* box இடையில் gap */
    margin-top:30px; 
    justify-content:center;
}


.menu a { 
    background:#333; 
    color:#fff; 
    padding:15px 25px; 
    text-decoration:none; 
    border-radius:5px; 
    width:200px;            /* box size */
    text-align:center;
}


.menu a:hover { 
    background:#000;
}
        .sidebar { width: 220px; height: 100vh; background: #2f2f2f; position: fixed; top: 0; left: 0; padding-top: 20px; }

        .sidebar a { display: block; color: #fff; padding: 15px; text-decoration: none; margin: 5px 0; }

        .sidebar a:hover { background: #000000; }

        .content { margin-left: 240px; /* sidebar width + margin */ padding: 20px; }
        
    </style>
</head>
<body>
    
    <div class="sidebar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="home.php">Home</a>
        <a href="Casual.php">Casual</a>
        <a href="Party.php">Party</a>
        <a href="Office.php">Office</a>
        <a href="Wedding.php">Wedding</a>
        <a href="logout.php">logout</a>
    </div>

    <div class="content">
        <h1>Welcome Admin</h1>
        <p><b>This is your dashboard content area.</p>
    </div>
<div class="container">
    <div class="menu">
        <a href="view_products.php"> Products Management</a>
        <a href="manage_orders.php"> Orders Management</a>
        <a href="manage_users.php"> Users Management</a>
        <a href="report.php">Report Management</a>        
        <a href="settings.php">Settings</a>
        <a href="manage_categories.php">Category Management</a>
    </div>
</div>
</body>
</html>

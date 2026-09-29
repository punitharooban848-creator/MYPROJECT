<?php
include("db.php"); 

// --- Delete user if requested ---
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM users WHERE user_id=$id");
    echo "<script>alert('User deleted successfully'); window.location.href='manage_users.php';</script>";
}

// --- Fetch all users ---
$sql = "SELECT * FROM users ORDER BY user_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
       
        table { border-collapse: collapse; width: 100%; }
       
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
       
        th { background: #f2f2f2; }
        
        a { text-decoration: none; color: blue; }
        
        a:hover { text-decoration: underline; }
                .editbutton{ position:; top: 300px; right: 120px; display: right; gap: 15px; align-items: center; margin: 0; display: inline-block; } 
        
        a.view-details { display: inline-block; padding: 10px 20px; background-color: #000000; color: #fff;              
                         text-decoration: none;    border-radius: 5px;      transition: background 0.3s ease; font-weight: bold; }

        a.view-details:hover { background-color: #000000;   /* hover effect */ }

        .backbutton{ padding:10px 20px; background:#000; color:#fff; text-decoration:none; border-radius:5px; }

    </style>
</head>
<body>
<div class="arrow" onclick="showDashboard()">
    <a href="admin_dashboard.php"><img src="icons8-back-100.png". width="40" height="40"></a>
</div>
<h2>Manage Users</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['user_id']."</td>";
            echo "<td>".$row['username']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['role']."</td>";
            echo "<td>
                    <a href='edit_user.php?id=".$row['user_id']."'>Edit</a> | 
                    <a href='manage_users.php?id=".$row['user_id']."' onclick=\"return confirm('Delete this user?');\">Delete</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No users found</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
session_start();
include("db.php");

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin")
{
    header("Location: home.php");
    exit();
}

$id = $_GET['id'];

// Update User
if(isset($_POST['update']))
{
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $role     = $_POST['role'];

    $sql = "UPDATE users
            SET username='$username',
                email='$email',
                role='$role'
            WHERE user_id='$id'";

    mysqli_query($conn, $sql);

    echo "<script>
            alert('User Updated Successfully');
            window.location='manage_users.php';
          </script>";
}

// Get User Details
$sql = "SELECT * FROM users WHERE user_id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>

    <style>
        body{ font-family:Arial; background:#f5f5f5; }

        .container{ width:400px; margin:50px auto; background:#fff; padding:25px; border-radius:10px; box-shadow:0 0 10px gray; }

        h2{ text-align:center; }

        input,select{ width:100%; padding:10px; margin:10px 0; }

        button{width:100%;padding:10px; background:black; color:white; border:none; cursor:pointer; }

        a{ text-decoration:none; }
    </style>
</head>

<body>

<div class="container">

<h2>Edit User</h2>

<form method="post">

<label>Username</label>
<input type="text"
       name="username"
       value="<?php echo $row['username']; ?>"
       required>

<label>Email</label>
<input type="email"
       name="email"
       value="<?php echo $row['email']; ?>"
       required>

<label>Role</label>

<select name="role">
    <option value="customer"
    <?php if($row['role']=="customer") echo "selected"; ?>>
    Customer
    </option>

    <option value="admin"
    <?php if($row['role']=="admin") echo "selected"; ?>>
    Admin
    </option>
</select>

<button type="submit" name="update">
Update User
</button>

<br><br>
<button type="submit" name="back">
<a href="manage_users.php"> Back</a>
</button>

</form>

</div>

</body>
</html>
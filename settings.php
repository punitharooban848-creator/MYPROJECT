<?php
session_start();
include("db.php");

if(!isset($_SESSION['role']) || $_SESSION['role']!="admin")
{
    header("Location: home.php");
    exit();
}

$user_id = $_SESSION['user_id'];


// Update Profile

if(isset($_POST['update_profile']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];

$sql = "UPDATE users
SET username='$name',
    email='$email'
WHERE user_id='$user_id'";
    mysqli_query($conn,$sql);

    echo "<script>alert('Profile Updated');</script>";
}



// Change Password

if(isset($_POST['change_password']))
{
    $password = $_POST['password'];

    $sql = "UPDATE users SET 
            password='$password'
            WHERE user_id='$user_id'";

    mysqli_query($conn,$sql);

    echo "<script>alert('Password Changed');</script>";
}



// Get Admin Details

$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($result);



if(isset($_POST['update_profile']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE users
            SET username='$name',
                email='$email'
            WHERE user_id='$user_id'";

    mysqli_query($conn,$sql);

    echo "<script>alert('Profile Updated Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Settings</title>

<style>

        body{ font-family:Arial; background:#f5f5f5; }

        .container{ width:500px; margin:50px auto; }

        .box{ background:white; padding:30px; margin-bottom:20px; border-radius:10px; box-shadow:0 0 10px gray; }

        input{ width:100%; padding:10px; margin:10px 0; }

button{ background:black; color:white; padding:10px 20px; border:none; cursor:pointer; border-radius:5px; }

h2{ text-align:center; }

.back{ margin:20px; }
</style>
</head>

<body>


<div class="back">

<div class="arrow">
    <a href="admin_dashboard.php"><img src="icons8-back-100.png" width="40" height="40"></a>
</div>

</div>

<div class="container">
<h2>Admin Settings</h2>

<div class="box">
<h3>Profile Settings</h3>

<form method="post">


<label>Username</label>
<input type="text" name="name"
value="<?php echo $row['username']; ?>">

<label>Email</label>
<input type="email" name="email"
value="<?php echo $row['email']; ?>">

<button name="update_profile">
Update Profile
</button>
</form>

</div>
<div class="box">
<h3>Change Password</h3>

<form method="post">

<label>New Password</label>

<div style="position:relative; width:100%;">

<input type="password"
       id="password"
       name="password"
       required
       style="width:250px; padding-right:40px;">

<img src="icons-48.png"
     id="eye"
     onclick="togglePassword()"
     style="position:absolute;
            right:10px;
            top:15px;
            width:25px;
            height:25px;
            cursor:pointer;">
</div><script>

function togglePassword()
{
    var password = document.getElementById("password");
    var eye = document.getElementById("eye");

    if(password.type == "password")
    {
        password.type = "text";
        eye.src = "icons8-eye-100.png";
    }
    else
    {
        password.type = "password";
        eye.src = "icons-48.png";
    }
}

</script>
<button name="change_password">Change Password</button>
  </form>
</div>

<div class="box">
   <h3>Website Settings</h3>
   <label>Website Name</label>
   <input type="text"value="The Flawless Curve">
   <label>Contact Email</label>
   <input type="email"value="admin@gmail.com">
   <button>Save Website Settings</button>
 </div>
</div>

</body>
</html>
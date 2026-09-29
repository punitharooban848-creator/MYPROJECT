<?php
include("db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format!");
    }

    $stmt = $conn->prepare("SELECT user_id, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            session_regenerate_id(true); // security
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['email']   = $row['email'];
            $_SESSION['role']    = $row['role'];

            if ($row['role'] === 'admin') {
                header("Location: admin_dashboard.php");
                exit();
            } else {
                header("Location: home.php");
                exit();
            }
        } else {
            echo "Invalid Email or Password!";
        }
    } else {
        echo "Invalid Email or Password!";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body{ background-color: #afafaf; }
        .box1{ background-color: #fff; border: 5px double black; height: 300px; width: 500px; margin:150px auto; padding: 50px 100px; }
        .txt, .btn{ font-family: "Bauhaus 93", sans-serif; border: 5px double black; }
        .btn{ height: 40px; width: 100px; margin-top: 25px; }
        h2{ font-family: "Bauhaus 93", sans-serif; text-align: center; font-size: 30px; }
        label{ font-family: "Bauhaus 93", sans-serif; }
        .password-box{ position:relative; width:250px; }
        .password-box input{ width:250px; height:35px; padding-right:40px; box-sizing:border-box; }
        .password-box img{ position:absolute; right:10px; top:50%; transform:translateY(-50%); width:25px; height:25px; cursor:pointer; }
        input{ width:250px; height:35px; padding:5px; box-sizing:border-box; }
    </style>
</head>
<body>
<div class="box1">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <p style="text-align: left;">Don't have an account? <a href="register.php"> Register </a></p>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required><br><br>    
        <div style="position:relative; width:100%;">

        <label>Password</label><br>

<div class="password-box">

        <input type="password"
           id="password"
           name="password"
           required>

        <img src="icons-48.png"
         id="eye"
         onclick="togglePassword()">
<script>
function togglePassword()
{
    var password = document.getElementById("password");
    var eye = document.getElementById("eye");

    if(password.type === "password")
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
</div>
        <input class="btn" type="submit" value="Login">
    </form>

</div>
</body>
</html>

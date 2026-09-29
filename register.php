<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format!");
    }

    // Password length check
    if (strlen($password) != 8) {
        die("Password must be exactly 8 characters!");
    }

    // Check if email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        die("Email already exists!");
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'customer')");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registration Successful!";
    } else {
        echo "Error while registering!";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { background-color: #afafaf; }
        .box1 {
            background-color: #ffffff;
            border: 5px double black;
            height: 550px;
            width: 500px;
            margin-top: 20px;
            margin-left: 350px;
            padding-left: 50px;
        }
        .txt {
            font-family: "Bauhaus 93", sans-serif;
            background-color: transparent;
            border: 2px solid black;
            height: 35px;
            width: 250px;
            text-align: center;
        }
        .btn {
            font-family: "Bauhaus 93", sans-serif;
            border: 5px double black;
            height: 40px;
            width: 100px;
            margin-left: 100px;
            margin-top: 25px;
        }
        h2 { font-family: "Bauhaus 93", sans-serif; text-align: center; font-size: 30px; }
        label { font-family: "Bauhaus 93", sans-serif; }
        .loginlink { text-align: center; }
        .password-box{ position:relative; width:250px; }
        .password-box input{ width:250px; height:35px; padding-right:40px; box-sizing:border-box; }
        .password-box img{ position:absolute; right:10px; top:50%; transform:translateY(-50%); width:25px; height:25px; cursor:pointer; }
        input{ width:250px; height:35px; padding:5px; box-sizing:border-box; }

    </style>
</head>
<body>
<div class="box1">
    <h2>Register</h2>
    <p class="loginlink" style="text-align: left;">Already have an account? <a href="login.php">Login</a></p>
    <form action="register.php" method="post">
        <label for="username">Username</label><br>
        <input class="txt" type="text" id="username" name="username" required><br>

        <label for="email">Email</label><br>
        <input class="txt" type="email" id="email" name="email" required><br>

<label for="password">Password</label><br>

<div class="password-box">

<input class="txt"
       type="password"
       id="password"
       name="password"
       required>

<img src="icons-48.png"
     id="eye"
     onclick="togglePassword()">

</div>
<br>
        <input class="btn" type="submit" value="Register">
    </form>

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
</body>
</html>

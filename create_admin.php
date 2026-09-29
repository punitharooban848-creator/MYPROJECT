<?php
session_start();
include("db.php");

$_SESSION['role'] = $row['role'];
if ($row['role'] === 'admin') {
    header("Location: admin_dashboard.php");
} else {
    header("Location: home.php");
}
 
$name     = "Admin";
$email    = "www.admin123@gmail.com";
$password = "admin123"; // 8 characters
$address  = "Admin Address";
$phone    = "0779565634";

// Password hash
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert admin
$stmt = $conn->prepare("INSERT INTO users (Name, password, address, phone_number, Email, role) 
                        VALUES (?, ?, ?, ?, ?, 'admin')");
$stmt->bind_param("sssss", $name, $hashedPassword, $address, $phone, $email);

if ($stmt->execute()) {
    echo "Admin account created successfully!";
} else {
    echo "Error creating admin account!";
}

$stmt->close();
$conn->close();
?>

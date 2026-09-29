<?php
session_start();
include("db.php");

// PayHere anupura data ah vanguradhu
if(isset($_POST['order_id']) && $_POST['status_code'] == "2"){

    $order_id = $_POST['order_id'];
    $payhere_amount = $_POST['payhere_amount'];
    $payhere_currency = $_POST['payhere_currency'];
    $status_code = $_POST['status_code']; // 2 = Success
    $md5sig = $_POST['md5sig'];

    // Security check - Hash verify pannanum
    $merchant_id = "121xxxx"; // unoda PayHere merchant id
    $secret = "xxxxxxxx"; // unoda PayHere secret
    
    $hash = strtoupper(md5($merchant_id . $order_id . $payhere_amount . $payhere_currency . strtoupper(md5($secret))));

    if($hash == $md5sig){
        // Hash correct na DB la status ah update pannu
        $stmt = $conn->prepare("UPDATE orders SET status='Paid', payment_id=? WHERE order_id=?");
        $stmt->bind_param("si", $order_id, $order_id);
        $stmt->execute();

        $success = true;
    } else {
        $success = false;
        $error = "Security check failed!";
    }
} else {
    $success = false;
    $error = "Invalid Payment!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f9f9f9; text-align:center; padding:50px; }
        .box { max-width:500px; margin:auto; background:#fff; padding:30px; border-radius:10px; border:2px solid #4CAF50; }
        .success { color:green; font-size:24px; }
        .error { color:red; font-size:24px; }
        a { display:inline-block; margin-top:20px; padding:10px 20px; background:green; color:#fff; text-decoration:none; border-radius:5px; }
    </style>
</head>
<body>
<div class="box">
    <?php if($success): ?>
        <h1 class="success">✅ Payment Successful!</h1>
        <p>Thank you for your order.</p>
        <p><b>Order ID:</b> <?php echo $order_id; ?></p>
        <p><b>Amount Paid:</b> Rs <?php echo $payhere_amount; ?></p>
        <p>We will contact you soon for delivery.</p>
    <?php else: ?>
        <h1 class="error">❌ Payment Failed!</h1>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    
    <a href="index.php">Go to Home</a>
</div>
</body>
</html>
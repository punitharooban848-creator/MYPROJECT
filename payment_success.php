<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>

    <style>
        body{
            margin:0;
            padding:0;
            font-family:Arial, sans-serif;
            background:#f4f7fc;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .container{
            background:#fff;
            padding:40px;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,0,0.15);
            text-align:center;
            width:400px;
        }

        .success-icon{
            width:80px;
            height:80px;
            margin:auto;
            background:#28a745;
            color:#fff;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:40px;
            font-weight:bold;
        }

        h1{
            color:#28a745;
            margin-top:20px;
        }

        p{
            color:#555;
            font-size:16px;
        }

        .btn{
            display:inline-block;
            margin-top:25px;
            padding:12px 25px;
            background:#007bff;
            color:#fff;
            text-decoration:none;
            border-radius:5px;
            transition:0.3s;
        }

        .btn:hover{
            background:#0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="success-icon">✓</div>

    <h1>Payment Successful!</h1>

    <p>Your payment has been processed successfully.</p>

    <?php
    // Example: Display transaction ID if passed in URL
    if(isset($_GET['txn_id'])){
        echo "<p><strong>Transaction ID:</strong> " . htmlspecialchars($_GET['txn_id']) . "</p>";
    }
    ?>

    <a href="Home.php" class="btn">Go to Home</a>
</div>

</body>
</html>
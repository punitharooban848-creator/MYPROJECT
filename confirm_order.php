<?php
session_start();
include("db.php");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $product_id = intval($_POST['product_id']);
    $price = $_POST['price'];

    $name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $email = mysqli_real_escape_string($conn, $_POST['customer_email']);
    $phone = mysqli_real_escape_string($conn, $_POST['customer_phone']);
    $address = mysqli_real_escape_string($conn, $_POST['customer_address']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $quantity = intval($_POST['quantity']);
    $payment = mysqli_real_escape_string($conn, $_POST['payment_method']);

    // Check stock
    $check = mysqli_query($conn, "SELECT stock_quantity FROM products WHERE product_id='$product_id'");

    if(mysqli_num_rows($check) == 0)
    {
        die("Product not found.");
    }

    $row = mysqli_fetch_assoc($check);

    if($row['stock_quantity'] < $quantity)
    {
        die("Sorry! Only ".$row['stock_quantity']." item(s) available in stock.");
    }

    // Save order
    $sql = "INSERT INTO orders
    (product_id, customer_name, customer_email, customer_phone,
    customer_address, size, quantity, price, payment_method, status)
    VALUES
    ('$product_id','$name','$email','$phone','$address',
    '$size','$quantity','$price','$payment','Pending')";

    if(mysqli_query($conn,$sql))
    {
        // Reduce stock
        $update = "UPDATE products
                   SET stock_quantity = stock_quantity - $quantity
                   WHERE product_id='$product_id'";

        mysqli_query($conn,$update);

        echo "
        <!DOCTYPE html>
        <html>
        <head>
        <title>Order Success</title>

        <style>
        body{
            background:#f5f5f5;
            font-family:Arial;
        }

        .box{
            width:400px;
            margin:150px auto;
            background:white;
            padding:30px;
            text-align:center;
            border-radius:15px;
            box-shadow:0 0 10px gray;
        }

        h2{
            color:green;
        }

        button{
            background:green;
            color:white;
            padding:12px 40px;
            border:none;
            border-radius:10px;
            font-size:18px;
            cursor:pointer;
        }
        </style>

        </head>

        <body>

        <div class='box'>
            <h2>Order Placed Successfully!</h2>
            <p>Your order status is <b>Pending</b>.</p>

            <button onclick=\"window.location='home.php'\">
                OK
            </button>
        </div>

        </body>
        </html>
        ";
    }
    else
    {
        echo "Order Failed! ".mysqli_error($conn);
    }
}
?>

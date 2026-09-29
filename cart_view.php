<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = $conn->prepare(
    "SELECT * FROM cart WHERE user_id=?"
);

$query->bind_param("i", $user_id);

$query->execute();

$result = $query->get_result();



?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart View</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        .cart-item {
            display: flex;
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            align-items: center;
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 10px;
        }

        .details {
            flex: 1;
        }

        .price {
            color: green;
            font-weight: bold;
        }

        .remove-btn {
            background: red;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
        }

        .total {
            text-align: right;
            font-size: 22px;
            font-weight: bold;
            margin-top: 20px;
        }

        .empty {
            text-align: center;
            font-size: 18px;
            color: gray;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            background: black;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

                .buybutton{ display:inline-block; padding:10px 20px; background:green; color:white; text-decoration:none; 
                     border:2px solid green; border-radius:10px; margin-right:10px; }

        .buybutton:hover{ background:darkgreen; }

        .viewbutton{ display:inline-block; padding:5px 10px; background:black; color:white; text-decoration:none; 
                      border:2px solid black; border-radius:10px; }

        .viewbutton:hover{ background:hash; }
    
        .buybutton{ position:; top: 300px; right: 120px; display: right; gap: 15px; align-items: center; margin: 0; display: inline-block; } 

    </style>
</head>

<body>

<div class="container">

<div class="arrow">
    <a href="http://localhost/MYPROJECT/home.php"><img src="icons8-back-100.png". width="40" height="40"></a>
</div>
<h2>Your Shopping Cart </h2>

<?php
$total = 0;

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
?>

<div class="cart-item">

    <img src="<?php echo $row['image']; ?>">

    <div class="details">
        <h3><?php echo $row['name']; ?></h3>

        <p class="price">Price: RS. <?php echo $row['price']; ?></p>
        <p>Quantity: <?php echo $row['quantity']; ?></p>
        <p>Subtotal: RS. <?php echo $subtotal; ?></p>
    </div>

    <a class="remove-btn"
       href="remove_cart.php?id=<?php echo $row['cart_id']; ?>"
       onclick="return confirm('Remove this item?');">
       Remove
    </a><br><br>

                    <!-- BUY BUTTON -->
            <a class="buybutton"
               href="order_place.php?id=<?php echo $row['product_id']; ?>">
               Buy
            </a>
                <!-- VIEW DETAILS BUTTON -->
            <a  class= "viewbutton" href="product_details.php?id=<?php echo $row['product_id']; ?>">
                View Details
            </a>

</div>

<?php
    }

} else {
    echo "<p class='empty'>Your cart is empty 🛒</p>";
}
?>

<div class="total">
    Total: ₹<?php echo $total; ?>
</div>

</div>

</body>
</html>
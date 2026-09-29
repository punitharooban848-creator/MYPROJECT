<?php
session_start();
include("db.php");

$session_id = session_id();

$query = $conn->prepare("SELECT * FROM cart WHERE session_id=?");

$query->bind_param("s", $session_id);

$query->execute();

$result = $query->get_result();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>

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

        .details h3 {
            margin: 0;
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
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }

        .empty {
            text-align: center;
            font-size: 18px;
            color: gray;
        }
    </style>
</head>

<body>
    <!--Back button coding-->
<div class="arrow">
    <a href="cart_view.php"><img src="icons8-back-100.png". width="40" height="40"></a>
</div>

<div class="container">

<h2>Your Shopping Cart 🛒</h2>

<?php
$total = 0;

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
?>

<div class="cart-item">

    <img src="uploads/<?php echo $row['image']; ?>">

    <div class="details">
        <h3><?php echo $row['name']; ?></h3>

        <p class="price">Price: ₹<?php echo $row['price']; ?></p>
        <p>Quantity: <?php echo $row['quantity']; ?></p>
        <p>Subtotal: ₹<?php echo $subtotal; ?></p>
    </div>

        <a class="remove-btn" 
                  href="cart.php?id=<?php echo $row['cart_id']; ?>" 
                  onclick="return confirm('Remove this item?');">
                    Remove
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
<a href="VS" class="back-btn"></a>
</body>
</html>
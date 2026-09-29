<?php
include("db.php");

// Check if product ID is provided
if (!isset($_GET['id'])) {
    die("No product selected.");
}

$product_id = intval($_GET['id']);

// Get product details
$sql = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    die("Product not found.");
}

$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Place Order</title>

    <style>
        body{
            background:#f5f5f5;
            font-family:Arial, sans-serif;
        }

        .order-box{
            width:500px;
            margin:30px auto;
            background:#fff;
            padding:25px;
            border-radius:15px;
            box-shadow:0 0 10px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
        }

        .product{
            text-align:center;
            margin-bottom:20px;
        }

        .product img{
            width:180px;
            height:220px;
            object-fit:cover;
            border-radius:10px;
        }

        input,
        textarea,
        select{
            width:100%;
            padding:10px;
            margin:8px 0;
            box-sizing:border-box;
        }

        button{
            width:100%;
            padding:12px;
            font-size:16px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            color:white;
        }

        .cod{
            background:green;
        }

        .online{
            background:black;
        }
    </style>
</head>

<body>

<div class="order-box">

    <h2>Place Your Order</h2>

    <div class="product">
        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product">

        <h3><?php echo htmlspecialchars($product['name']); ?></h3>

        <p><strong>Price:</strong> Rs. <?php echo htmlspecialchars($product['price']); ?></p>
    </div>

    <form action="confirm_order.php" method="POST">

        <input type="hidden" name="product_id"
               value="<?php echo $product['product_id']; ?>">

        <input type="hidden" name="price"
               value="<?php echo $product['price']; ?>">

        <label>Name</label>
        <input type="text" name="customer_name" required>

        <label>Email</label>
        <input type="email" name="customer_email">

        <label>Phone</label>
        <input type="text" name="customer_phone" required>

        <label>Address</label>
        <textarea name="customer_address" required></textarea>

        <label>Size</label>
        <select name="size">
            <option>S</option>
            <option>M</option>
            <option>L</option>
            <option>XL</option>
            <option>XXL</option>
        </select>

        <label>Quantity</label>
        <input type="number" name="quantity" value="1" min="1" required>

        <br><br>

        <button type="submit"
                name="payment_method"
                value="Cash on Delivery"
                class="cod">
            Cash on Delivery
        </button>

        <br><br>

        <button type="button"
                class="online"
                onclick="goPayment()">
            Online Payment
        </button>

    </form>

</div>

<script>
function goPayment()
{
    window.location.href = "Cart_Payment.php?id=<?php echo $product['product_id']; ?>";
}
</script>

</body>
</html>
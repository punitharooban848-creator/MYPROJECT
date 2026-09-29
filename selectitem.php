<?php
include "db.php";

$result = $conn->query("SELECT * FROM products");
?>

<h1>Products List</h1>

<?php while($row = $result->fetch_assoc()){ ?>

<div style="border:1px solid #000; padding:10px; margin:10px;">

    <h3><?php echo $row['name']; ?></h3>

    <p>Price: Rs. <?php echo $row['price']; ?></p>

    <p><?php echo $row['description']; ?></p>

    <p>Stock: <?php echo $row['stock']; ?></p>

    <p>Created: <?php echo $row['created_at']; ?></p>

    <a href="addtocart.php?id=<?php echo $row['id']; ?>">
        Add to Cart
    </a>

</div>

<?php } ?>
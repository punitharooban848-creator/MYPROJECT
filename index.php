<?php
include 'db.php';

$result = mysqli_query($conn,"SELECT * FROM products");

while($row=mysqli_fetch_assoc($result)){
?>
<div class="product">
    <a href="product.php?id=<?php echo $row['product_id']; ?>">
        <img src="myproject/<?php echo $row['image']; ?>" width="200">
        <h3><?php echo $row['name']; ?></h3>
        <p>Rs. <?php echo $row['price']; ?></p>
    </a>
</div>
<?php } ?>
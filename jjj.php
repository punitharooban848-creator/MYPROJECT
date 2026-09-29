<?php
$conn = new mysqli("localhost","root","","mydatabase");

$sql = "SELECT * FROM products WHERE category_id = 9";
$result = $conn->query($sql);
?>

<?php while($row = $result->fetch_assoc()){ ?>

    <div>

        <!-- IMAGE -->
        <img src="<?php echo $row['image']; ?>" width="240" height="400">

        <!-- DETAILS -->
        <p><?php echo $row['name']; ?></p>
        <p>₹<?php echo $row['price']; ?></p>
        <p>Stock: <?php echo $row['stock']; ?></p>
        <p><?php echo $row['description']; ?></p>

    </div>

<?php } ?>
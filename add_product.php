<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $sub_category_id = $_POST['sub_categories_id'];
    $price = $_POST['price'];
    $stock = $_POST['stock_quantity'];

    // Image Upload
    $imagePath = "";

    if (!empty($_FILES['product_image']['name'])) {

        $targetDir = "uploads/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . "_" . basename($_FILES["product_image"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;
        }
    }

    // Insert Product
    $stmt = $conn->prepare("INSERT INTO products
    (name, category_id, sub_categories_id, price, stock_quantity, image)
    VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("siiiss",
        $name,
        $category_id,
        $sub_category_id,
        $price,
        $stock,
        $imagePath
    );

    if($stmt->execute()){
        echo "<script>
        alert('Product Added Successfully!');
        window.location='view_products.php';
        </script>";
        exit();
    }else{
        echo "Error : ".$conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>

<style>

body{
    background:#fff;
}

.box1{
    width:800px;
    margin:20px auto;
    padding:30px;
    border:5px double black;
    background:#fff;
}

h2{
    text-align:center;
    font-family:Cooper Black;
}

label{
    display:block;
    margin-top:12px;
    font-family:Bauhaus 93;
}

.txt{
    width:220px;
    height:30px;
    text-align:center;
    border:2px solid black;
    font-family:Cooper Black;
}

.btn{
    width:120px;
    height:35px;
    margin-top:20px;
    border:5px double black;
    font-family:Cooper Black;
}

select{
    width:230px;
    height:35px;
}

</style>

</head>

<body>
<div class="arrow" onclick="showDashboard()">
    <a href="view_products.php"><img src="icons8-back-100.png". width="40" height="40"></a>
</div>
<div class="box1">

<h2>Add Product</h2>

<form method="POST" enctype="multipart/form-data">

<label>Product Image</label>
<input type="file" name="product_image" accept="image/*" required>

<label>Product Name</label>
<input type="text" name="name" class="txt" required>

<label>Category</label>

<select name="category_id" required>

<option value="">Select Category</option>

<?php

$result=mysqli_query($conn,"SELECT * FROM categories ORDER BY name");

while($row=mysqli_fetch_assoc($result))
{
?>
<option value="<?php echo $row['category_id']; ?>">
<?php echo $row['name']; ?>
</option>

<?php
}
?>

</select>

<label>Sub Category</label>

<select name="sub_categories_id" required>

<option value="">Select Sub Category</option>

<?php

$result=mysqli_query($conn,"SELECT * FROM sub_categories ORDER BY name");

while($row=mysqli_fetch_assoc($result))
{
?>

<option value="<?php echo $row['sub_categories_id']; ?>">
<?php echo $row['name']; ?>
</option>

<?php
}
?>

</select>

<label>Price</label>
<input type="number" step="0.01" name="price" class="txt" required>

<label>Stock Quantity</label>
<input type="number" name="stock_quantity" class="txt" required>

<br>

<input type="submit" value="Add Product" class="btn">

</form>

</div>

</body>
</html>
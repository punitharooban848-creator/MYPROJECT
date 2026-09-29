<?php
include("db.php");
session_start();

$id = $_GET['id']; // product_id from URL

// Fetch product details
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'];
    $category_id = $_POST['category_id'];
    $sub_category_id = $_POST['sub_categories_id'];
    $price = $_POST['price'];
    $stock = $_POST['stock_quantity'];

    // Image upload check
    $imagePath = $product['image']; // old image by default
    if (!empty($_FILES['product_image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES["product_image"]["name"]);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            // delete old image
            if (!empty($product['image']) && file_exists($product['image'])) {
                unlink($product['image']);
            }
            $imagePath = $targetFile;
        }
    }

    // Update query with image
    $stmt = $conn->prepare("UPDATE products
                            SET name=?, category_id=?, sub_categories_id=?, price=?, stock_quantity=?, image=? 
                            WHERE product_id=?");
    $stmt->bind_param("siidisi", $name, $category_id, $sub_category_id, $price, $stock, $imagePath, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully!');window.location.href='view_products.php';</script>";
        exit();
    } else {
        echo "Error updating product!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Product</title>
  <style>
    body{ background-color: #ffffff; }

    .box1{ background-color: #ffffff; border: 5px double #000; width: 800px; margin: 20px auto; padding: 30px; }

    .txt{ font-family: "Cooper Black", sans-serif; border: 2px solid black; height: 30px; width: 200px; text-align: center; }

    .btn{ font-family: "Cooper Black", sans-serif; border: 5px double black; height: 35px; width: 120px; margin-top: 25px; }

    h2{ font-family: "Cooper Black", sans-serif; text-align: center; font-size: 30px; }

    label{ font-family: "Bauhaus 93", sans-serif; display:block; margin-top:10px; }
    
    img{ margin:10px 0; border:2px solid #000; }
  </style>
</head>
<body>
<div class="box1">
  <h2>Edit Product</h2>
  <form method="POST" enctype="multipart/form-data">
    
    <!-- Old Image Preview -->
    <?php if (!empty($product['image'])): ?>
        <img src="<?php echo $product['image']; ?>" width="150" height="150"><br>
    <?php endif; ?>

    <label>Image:</label>
    <input type="file" name="product_image" accept="image/*"><br><br>
 
    <label>Name:</label>
    <input class="txt" type="text" name="name" 
       value="<?php echo isset($product['name']) ? $product['name'] : ''; ?>" required><br><br>

    <label>Category:</label>
    <select name="category_id" required>
      <?php
      $res = mysqli_query($conn, "SELECT category_id, name FROM categories ORDER BY name");
      while($r = mysqli_fetch_assoc($res)) {
          $selected = ($r['category_id'] == $product['category_id']) ? "selected" : "";
          echo "<option value='".$r['category_id']."' $selected>".$r['name']."</option>";
      }
      ?>
    </select><br><br>

    <label>Sub Category:</label>
    <select name="sub_categories_id" required>
      <?php
      $res = mysqli_query($conn, "SELECT sub_categories_id, name FROM sub_categories ORDER BY name");
      while($r = mysqli_fetch_assoc($res)) {
          $selected = ($r['sub_categories_id'] == $product['sub_categories_id']) ? "selected" : "";
          echo "<option value='".$r['sub_categories_id']."' $selected>".$r['name']."</option>";
      }
      ?>
    </select><br><br>

    <label>Price:</label>
    <input class="txt" type="number" name="price" step="0.01" 
           value="<?php echo isset($product['price']) ? $product['price'] : ''; ?>" required><br><br>

    <label>Stock Quantity:</label>
    <input class="txt" type="number" name="stock_quantity" 
           value="<?php echo isset($product['stock_quantity']) ? $product['stock_quantity'] : ''; ?>" required><br><br>

    <input class="btn" type="submit" value="Update">
  </form>
</div>
</body>
</html>

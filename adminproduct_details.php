<?php
include("db.php");

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid product ID");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found!");
}



?>

<!DOCTYPE html>
<html>
<head>
  <title>Adminside_Product Details</title>
  <style>
        body { font-family: Arial, sans-serif; margin: 20px; background:#f9f9f9; }
    
        .product-container { display: flex; gap: 30px; max-width: 1000px; margin:auto; background:#fff; padding:20px; border:1px solid #ddd; border-radius:8px; }
    
        .product-image { flex:1; }
    
        .product-image img { width:100%; height:500px; object-fit:cover; border-radius:8px; }
    
        .product-info { flex:1; }

        .sizes button {
  margin:5px;
  padding:8px 12px;
  border:1px solid #ddd;
  background:#f1f1f1;
  cursor:pointer;
}

.sizes button.active {
  background:#000;
  color:#fff;
}

    
        .product-info h2 { margin:0 0 10px; font-size:24px; }
    
        .price { font-size:22px; color:#b12704; margin:10px 0; }
    
        .installment { font-size:14px; color:#555; margin-bottom:15px; }
    
        .stock { color:green; font-weight:bold; margin-bottom:10px; }
    
        .brand, .code, .barcode { font-size:14px; margin:5px 0; }
    
        .options { margin:15px 0; }
    
        .options label { font-weight:bold; }
    
        .quantity { margin:15px 0; }
  
        .quantity input { width:50px; text-align:center; }
      
        .actions { margin-top:20px; }
        

        .deletbutton{ display:inline-block; padding:10px 20px; background: #c92424;; color:white; text-decoration:none; 
                      border:2px solid red; border-radius:5px; }

        .deletbutton:hover{ background: #672d2d; }        
 
        .editbutton{ display:inline-block; padding:10px 20px; background: #27864b;; color:white; text-decoration:none; 
                      border:2px solid red; border-radius:5px; }

        .editbutton:hover{ background: #75c976;; }        
  
        .addicon{ position: absolute; top: 20px; right: 120px; display: right; gap: 15px; align-items: center;  margin: 0; display: inline-block;}


  </style>
</head>
<body>

<div class="arrow">
    <a href="view_products.php"><img class= "icon" src="icons8-back-100.png" width="40" height="40" ></a>
</div>

  <div class="product-container">
    <!-- Product Image -->
    <div class="image">
    <img src="<?php echo $product['image']; ?>" alt="Product Image" width= "400" height="500">
    </div>

    <!-- Product Info -->
    <div class="product-info">
      <h2><?php echo $product['name']; ?></h2>
      <div class="price">Rs <?php echo $product['price']; ?></div>
      <div class="options">
      </div>
      
      <div class="options">
  <label>Size:</label>
  <div class="sizes">
    
    <button onclick="selectSize(this)">Medium</button>
    <button onclick="selectSize(this)">Large</button>
    <button onclick="selectSize(this)">X-Large</button>
    <button onclick="selectSize(this)">2XL</button>
    <button onclick="selectSize(this)">3XL</button>
    <button onclick="selectSize(this)">4XL</button>
    <button onclick="selectSize(this)">5XL</button>
  </div>
</div>
<script>
function selectSize(btn) {
  document.querySelectorAll('.sizes button').forEach(b => b.classList.remove('active'));
  
  btn.classList.add('active');

  let selectedSize = btn.innerText;
  console.log("Selected Size:", selectedSize);

  // hidden input update
  let hiddenInput = document.getElementById("selectedSize");
  if(hiddenInput){
    hiddenInput.value = selectedSize;
  }
}
</script>

<input type="hidden" id="selectedSize" name="size" value="">

      <div class="stock">Hurry! Only <?php echo $product['stock_quantity']; ?> available</div>

      <div class="quantity">
        <label>Quantity:</label>
        <input type="number" value="1" min="1">
      </div>

    <div class="actions">
                <!-- EDIT BUTTON -->
            <a class="editbutton"
               href="edit_product.php?id=<?php echo $row['product_id']; ?>">
               Edit
            </a>
                <!-- DELETE BUTTON -->
            <a  class= "deletbutton" href="view_products.php?id=<?php echo $row['product_id']; ?>" 
                onclick="return confirm('Are you sure to delete this product?');">
                Delete
            </a>
    </div>    
  </div>
</body>
</html>

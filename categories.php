<?php
session_start();

include("db.php");

// get category_id and sub_id from URL
$category_id = isset($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;
$sub_id = isset($_GET['sub_id']) ? intval($_GET['sub_id']) : 0;

// base query
if ($sub_id > 0) {
    $sql = "SELECT * FROM products WHERE category_id = '$category_id' AND sub_categories_id = '$sub_id'";
} else {
    $sql = "SELECT * FROM products WHERE category_id = '$category_id'";
}
$result = mysqli_query($conn, $sql);

// fetch category name
$cat_sql = "SELECT name FROM category WHERE category_id='$category_id'";
$cat_res = mysqli_query($conn, $cat_sql);
$cat_row = mysqli_fetch_assoc($cat_res);
$category_name = $cat_row['name'];

// fetch sub category name if selected
if ($sub_id > 0) {
    $sub_sql = "SELECT name FROM sub_categories WHERE sub_categories_id='$sub_id'";
    $sub_res = mysqli_query($conn, $sub_sql);
    $sub_row = mysqli_fetch_assoc($sub_res);
    $sub_name = $sub_row['name'];
} else {
    $sub_name = $category_name;
}
?>
<h1><?= $sub_name ?> Collection</h1>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div>
        <p><?= $row['product_name'] ?></p>
        <p>Price: <?= $row['price'] ?></p>
    </div>
<?php } ?>

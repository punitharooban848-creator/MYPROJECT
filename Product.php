<?php
include("db.php");

$category_id = $_GET['cat'] ?? 0;

$sql = "SELECT products.* 
        FROM products
        INNER JOIN sub_categories 
        ON products.sub_categories_id = sub_categories.sub_categories_id
        WHERE sub_categories.category_id = '$category_id'";


$result = $conn->query($sql);

?>
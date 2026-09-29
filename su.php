<?php
include("db.php");

if(isset($_GET['sub_id']))
{
    $sub_id = (int)$_GET['sub_id'];

    $sql = "SELECT * FROM products WHERE sub_categories_id = $sub_id";
    $result = mysqli_query($conn, $sql);
}
?>
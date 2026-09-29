<?php
session_start();
include("db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_GET['id']))
{
    $cart_id = $_GET['id'];

    $delete = $conn->prepare(
        "DELETE FROM cart 
         WHERE cart_id=? AND user_id=?"
    );

    $delete->bind_param("ii",$cart_id,$user_id);

    $delete->execute();
}

header("Location: cart_view.php");
exit();

?>
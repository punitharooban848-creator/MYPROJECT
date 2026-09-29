<!DOCTYPE html>
<html>
<head>
    <title>Cart Payment</title>

<style>

body{
    background-color:#f5f5f5;
    font-family:Arial, sans-serif;
}

.container{
    width:800px;
    margin:50px auto;
    background:white;
    border:4px double black;
    padding:30px;
    border-radius:10px;
}

h1{
    text-align:center;
    font-family:"Bauhaus 93";
    font-size:40px;
}


.cart-box{
    border:2px solid black;
    padding:20px;
    margin-bottom:20px;
}


.product{
    display:flex;
    justify-content:space-between;
    border-bottom:1px solid gray;
    padding:10px;
}


.total{
    text-align:right;
    font-size:25px;
    font-weight:bold;
}


label{
    font-weight:bold;
}


input,select{
    width:100%;
    height:35px;
    padding:5px;
    margin-bottom:15px;
    border:2px solid black;
}


.payment{
    border:2px solid black;
    padding:20px;
}


button{

    background:green;
    color:white;
    padding:12px 30px;
    border:none;
    border-radius:8px;
    font-size:18px;
    cursor:pointer;
}


button:hover{
    background:darkgreen;
}


</style>

</head>


<body>


<div class="container">


<h1>Payment</h1>


<div class="cart-box">

<h2>Order Summary</h2>


<div class="product">
<span>Designer Saree</span>
<span>Rs. 5000</span>
</div>


<div class="product">
<span>Kurtis</span>
<span>Rs. 2500</span>
</div>


<div class="total">
Total : Rs. 7500
</div>


</div>



<div class="payment">


<h2>Customer Details</h2>


<form action="payment_success.php" method="post">


<label>Name</label>
<input type="text" name="name" required>


<label>Email</label>
<input type="email" name="email" required>


<label>Phone Number</label>
<input type="text" name="phone" required>


<label>Address</label>
<input type="text" name="address" required>

<label>Card Number</label>
<input type="text" name="card_number"
placeholder="XXXX XXXX XXXX XXXX">

<button type="submit">
Place Order
</button>
<button type="submit"><a class="update" href="http://localhost/MYPROJECT/home.php">
Cancel
</a></button>


</form>


</div>


</div>


</body>
</html>
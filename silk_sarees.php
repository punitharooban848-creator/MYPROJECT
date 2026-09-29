<?php
include("db.php");

$sql = "SELECT * FROM products";
$result = mysqli_query($conn,$sql);
?>
 <!DOCTYPE html>
 <html>
 <head>
    <title>sarees page</title>
    <link rel="stylesheet" href="categories.css">
 </head>
 <body>
     <!-- menubar table -->
        <table class="menu">
          <tr class="">
            <th class="menu"><a href="home.php" >Home</a></th>
            <th class="menu"><a href="Casual.php" >Casual</a></th>
            <th class="menu"><a href="Party.php" >Party</a></th>
            <th class="menu"><a href="Office.php" >Office</a></th>
            <th class="menu"><a href="Wedding.php" >Wedding</a></th>
          </tr>
        </table> 
     <!--cart icon coding-->
    <div class="topdiv">        
       <h1 class="headding01"> The Flawless Curve</h1> <a href="home.php"><img class="logo"  src="LOGO.png" alt="LOGO.png" height="200px" width="250px"> </a>
     <!-- <a href="cart.html" class="cart">🛒 Cart</a> -->
    </div>

    

    <!-- menubar table -->
    <div class="navbar">
        <ul>
             <li class="dropdown">
      <a href="#">Categories</a>
        <ul class="dropdown-menu">
            <li><a href="sarees.php">Sarees</a></li><br>
            <li><a href="gowns.php">Gowns</a></li><br>
            <li><a href="kurtis.html">Kurtis</a></li><br>
            <li><a href="jeans.html">Jeans</a></li><br>
            <li><a href="tops.html">Tops</a></li><br>
            <li><a href="Frocks.html">Frocks</a></li><br>
            <li><a href="Salwar.html">Salwar Kameez</a></li><br>
            <li><a href="Dupatta.html">Dupatta Sets</a></li><br>
            <li><a href="Lehanga.html">Lehanga</a></li><br>
        </ul>
            </li>
         </ul>
    </div>
<br>
 </body>
</html>

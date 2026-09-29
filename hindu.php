<?php
include("db.php");

$ids = "29";
$category_name = "Hindu Bridel Collection";

if(isset($_GET['sub_id']))
{
    $sub_id = intval($_GET['sub_id']);

    // Get selected sub category name
    $name_sql = "SELECT name FROM sub_categories 
                 WHERE sub_categories_id='$sub_id'";

    $name_result = mysqli_query($conn, $name_sql);

    if(mysqli_num_rows($name_result) > 0)
    {
        $name_row = mysqli_fetch_assoc($name_result);
        $category_name = $name_row['name'];
    }


    // Filter selected category products
    $sql = "SELECT * FROM products 
            WHERE sub_categories_id='$sub_id'";
}
else
{
    // Default Casual Wears products
    $sql = "SELECT * FROM products 
            WHERE sub_categories_id IN ($ids)";
}


$result = mysqli_query($conn, $sql);


// Sub Categories

$sub_sql = "SELECT * FROM sub_categories ORDER BY category_id";
$sub_result = mysqli_query($conn, $sub_sql);


$menu = [];

while($row = mysqli_fetch_assoc($sub_result))
{
    $menu[$row['category_id']][] = $row;
}

?>

<!DOCTYPE html>
<html>
 <head>
  <title>Hindu_Wedding_page</title>
   
    <style>
        body { background-color:white; }

        .topdiv  {  width:100%; height:270px; border: 4px double black; padding:0px; margin:0px; }


        .headding01{ font-family: "Bauhaus 93", sans-serif; font-size: 90px; text-align: left; margin-left: 10px; margin-top:50px ; }


        .logo{ margin-top:-600px; margin-left: 990px; border: 4px double black; }



        .menu{  background-color: #000000; border:2px solid rgb(0, 0, 0); color: #ffffff; height:20px; width:900px;  margin-top:10px; cursor: pointer; }
        
        .menu a{   color: #ffffff; text-decoration: none; }

        .one{ width:20%; text-align: center; vertical-align: top; border: 5px double #000000; padding: 10px; border-radius: 10px; }
        
                .navbar { margin-top:10px; background-color: #ffffff; border: 2px solid #000; width: 200px; position: relative; text-align: center; }

        .navbar ul { list-style: none; margin: 0; padding: 0; }

        .navbar ul li { position: relative;}

        .navbar ul li a { display: block; padding: 8px; color: black; text-decoration: none; }

          /* MAIN DROPDOWN */
        .dropdown-menu { display: none; position: absolute; top: 100%; left: 0; width: 200px; background: white; border: 1px solid black; z-index: 999; }

        .dropdown:hover .dropdown-menu { display: block; }

          /* hover effect */
        .dropdown-menu li a:hover { background: #555; color: white; }

          /* sub menu */
        .sub-menu { display: none; position: absolute; left: 100%; top: 0; background: white; width: 200px; border: 1px solid #ccc; }

        .sub-dropdown:hover .sub-menu { display: block; }


        .img{ margin-left:10px; }


        .buybutton{ display:inline-block; padding:10px 20px; background:green; color:white; text-decoration:none; 
                     border:2px solid green; border-radius:10px; margin-right:10px; }

        .buybutton:hover{ background:darkgreen; }

        .addtocartbutton{ display:inline-block; padding:10px 20px; background:red; color:white; text-decoration:none; 
                      border:2px solid red; border-radius:10px; }

        .addtocartbutton:hover{ background:darkred; }

        .viewbutton{ display:inline-block; padding:5px 10px; background:black; color:white; text-decoration:none; 
                      border:2px solid black; border-radius:10px; }

        .viewbutton:hover{ background:hash; }
        
        h2{ font-family: "Cooper Black", sans-serif; text-align: center; font-size: 30px;  }
        
        .buybutton{ position:; top: 300px; right: 120px; display: right; gap: 15px; align-items: center; margin: 0; display: inline-block; } 
    
                .footer {
                background: #333;
                color: #fff;
                text-align: center;
                padding: 20px;
                margin-top: 40px;
                    }
   
        .footer a {
                color: #f1f1f1;
                margin: 0 10px;
                text-decoration: none;
                    }
    
        .footer a:hover {
                color: #00ffcc;
                    }            
        .logouticon{
                       position: absolute; /* Header top right corner ku fix pannum */
                       top: 0px;
                       left: 0px;
  
                       display: right;      /* Ore line la vaikum */
                       gap: 15px;          /* Rendukulla gap */
                       align-items: center;
                       margin: 0;          /* Purana margin ellam 0 aakidu */
                       display: inline-block;

        }

    </style>
</head>
 <body>
      <a href="login.php"><img class="logouticon" height="50px" width="50px" src="icons8-logout-100.gif" alt="logout icon"></a>

     <!--cart icon coding-->
    <div class="topdiv">        
       <h1 class="headding01"> The Flawless Curve</h1> <a href="home.php"><img class="logo"  src="LOGO.png" alt="LOGO.png" height="200px" width="250px"> </a>
     <!-- <a href="cart.html" class="cart">🛒 Cart</a> -->
    </div>

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

<!-- menubar table -->
<div class="navbar">
    <ul>
        <li class="dropdown">
            <a href="#">Categories</a>

            <ul class="dropdown-menu">

                <!-- Sarees -->
                <li class="sub-dropdown">
                    <a href="#">Sarees ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[1] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Gowns -->
                <li class="sub-dropdown">
                    <a href="#">Gowns ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[2] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Kurtis -->
                <li class="sub-dropdown">
                    <a href="#">Kurtis ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[3] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Jeans -->
                <li class="sub-dropdown">
                    <a href="#">Jeans ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[4] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Tops -->
                <li class="sub-dropdown">
                    <a href="#">Tops ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[5] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Frocks -->
                <li class="sub-dropdown">
                    <a href="#">Frocks ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[6] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Salwar Kameez -->
                <li class="sub-dropdown">
                    <a href="#">Salwar Kameez ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[7] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Dupatta Sets -->
                <li class="sub-dropdown">
                    <a href="#">Dupatta Sets ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[8] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Pants -->
                <li class="sub-dropdown">
                    <a href="#">Pants ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[13] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Blouse -->
                <li class="sub-dropdown">
                    <a href="#">Blouse ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[14] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Skirts -->
                <li class="sub-dropdown">
                    <a href="#">Skirts ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[15] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Designer Dresses -->
                <li class="sub-dropdown">
                    <a href="#">Designer Dresses ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[16] as $cat){ ?>
                        <li>
                            <a href="Casual.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                <?php echo $cat['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>

            </ul>
        </li>
    </ul>
</div>

        
        <!-- cart icon coding-->
        <a href="cart_view.php"><img class="carticon" height="50px" width="50px" src="icons8-shopping-cart-100.png" alt="Cart Icon"></a>
        <h2 class="category-title">
    <?php echo $category_name; ?>
</h2>

<table class="producttable">
<tr>

<?php
$count = 0;

while($row = mysqli_fetch_assoc($result))
{
?>
    <td class="one">
        <img src="<?php echo $row['image']; ?>" width="200" height="250"><br><br>

        <b><?php echo $row['name']; ?></b><br><br>

        <b>Rs. <?php echo $row['price']; ?></b><br><br>

        <p>Stock : <?php echo $row['stock_quantity']; ?></p>

                <!-- BUY BUTTON -->
            <a class="buybutton"
               href="order_place.php?id=<?php echo $row['product_id']; ?>">
               Buy
            </a>
                <!-- ADD TO CART BUTTON -->
            <a class="addtocartbutton" href="add_to_cart.php?id=<?php echo $row['product_id']; ?>">
               Add to Cart
            </a><br><br>
                <!-- VIEW DETAILS BUTTON -->
            <a  class= "viewbutton" href="product_details.php?id=<?php echo $row['product_id']; ?>">
                View Details
            </a>
    </td>
<?php
$count++;

if($count % 3 == 0)
{
    echo "</tr><tr>";
}
}
?>

</tr>
</table>
     <!-- Content of your page -->

  <div class="footer">
    <p>&copy; 2026 MyProject. All Rights Reserved.</p>
    <p>
      <a href="about.php">About Us</a> |
      <a href="contact.php">Contact</a> |
      <a href="privacy_policy.php">Privacy Policy</a>
    </p>
    <p>
      Follow us:
      <a href="#">Facebook</a> |
      <a href="#">Instagram</a> |
      <a href="#">Twitter</a>
    </p>
  </div>

</body>
</html>

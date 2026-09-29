<?php
session_start();

include("db.php");

$sql = "SELECT * FROM wedding";
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
  <title>Wedding_page</title>
    <style>
        body { background-color:white; }

        .topdiv  {  width:100%; height:270px; border: 4px double black; padding:0px; margin:0px; }

        .headding01{ font-family: "Bauhaus 93", sans-serif; font-size: 90px; text-align: left; margin-left: 10px; margin-top:50px; }

        .logo{ margin-top:-600px; margin-left: 990px; border: 4px double black; }

        .menu{  background-color: #000000; border:2px solid rgb(0, 0, 0); color: #ffffff; height:20px; width:900px;  margin-top:10px; cursor: pointer; }
        
        .menu a{   color: #ffffff; text-decoration: none; }

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

        .producttable{ width: %; height: 250px; object-fit: cover; border-radius: 5px; border-spacing: 20px; }

        .one{ width:20%; text-align: center; vertical-align: top; border: 5px double #000000; padding: 10px; border-radius: 10px;}

        .img{ margin-left:10px; }

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


<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="photo01">
    <a href="<?php echo $row['link']; ?>">

        <img src="http://localhost/MYPROJECT/wedding/<?php echo $row['image']; ?>"
             width="700"
             height="500"
             alt="<?php echo $row['name']; ?>">

    </a>
</div>
<?php } ?>
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

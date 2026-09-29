<?php
session_start();

include("db.php");

//  get sub_id from URL
if (isset($_GET['sub_id'])) {
    $sub_id = $_GET['sub_id'];
    $sql = "SELECT * FROM products WHERE category_id = 5 AND sub_categories_id = '$sub_id'";
} else {
    // sub_id illana sarees category da ella products-um fetch pannuradhu
    $sql = "SELECT * FROM products WHERE category_id = 5";
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


if (isset($_GET['sub_id'])) {
    $sub_id = intval($_GET['sub_id']);
    $sql = "SELECT * FROM products WHERE category_id = 5 AND sub_categories_id = '$sub_id'";

    // Sub category name fetch
    $sub_name_sql = "SELECT name FROM sub_categories WHERE sub_categories_id = '$sub_id'";
    $sub_name_result = mysqli_query($conn, $sub_name_sql);
    $sub_row = mysqli_fetch_assoc($sub_name_result);
    $sub_name = $sub_row['name'];
} else {
    $sql = "SELECT * FROM products WHERE category_id = 5";
    $sub_name = "Sarees"; // default category name
}

?>
 <!DOCTYPE html>
 <html>
 <head>
    <title>Tops page</title>
     <style>
        body { background-color:white; }

        .topdiv  {  width:100%; height:270px; border: 4px double black; padding:0px; margin:0px; }

        .headding01{ font-family: "Bauhaus 93", sans-serif; font-size: 90px; text-align: left; margin-left: 10px; margin-top:50px; }

        .logo{ margin-top:-600px; margin-left: 990px; border: 4px double black; }

        .menu{ background-color: #000000; border:2px solid rgb(0, 0, 0); height:20px; width:900px;  margin-top:10px; cursor: pointer; }
  
        .menu a{   color: #ffffff; text-decoration: none; }

        .navbar { background-color: #ffffff; border: 2px solid #000; width: 200px; position: relative; text-align: center;  margin-top:10px; }

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

        .buy{ display:inline-block; padding:10px 20px; background:green; color:white; text-decoration:none; 
                     border:2px solid green; border-radius:5px; margin-right:10px; }

        .buy:hover{ background:darkgreen; }

        .add{ display:inline-block; padding:10px 20px; background:blue; color:white; text-decoration:none; 
                      border:2px solid blue; border-radius:5px; }

        .add:hover{ background:darkred; }

        h1{ text-align:center;}

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
    </div>

    <!-- menubar table -->
<div class="navbar">
    <ul>

        <li class="dropdown">
            <a href="#">Categories</a>

            <ul class="dropdown-menu">

                <!-- Sarees (category_id = 1) -->
                <li class="sub-dropdown">
                    <a href="#">Sarees ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[1] as $cat) { ?>
                            <li>
                                <a href="sarees.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                    <?php echo $cat['name']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

                <!-- Gowns (category_id = 2) -->
                <li class="sub-dropdown">
                    <a href="#">Gowns ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[2] as $cat) { ?>
                            <li>
                                <a href="Gowns.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
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
                        <?php foreach($menu[3] as $cat) { ?>
                            <li>
                                <a href="Kurthis.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
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
                        <?php foreach($menu[4] as $cat) { ?>
                            <li>
                                <a href="jeans.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
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
                        <?php foreach($menu[5] as $cat) { ?>
                            <li>
                                <a href="Tops.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
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
                        <?php foreach($menu[6] as $cat) { ?>
                            <li>
                                <a href="Frocks.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
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
                        <?php foreach($menu[7] as $cat) { ?>
                            <li>
                                <a href="Salwar.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
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
                        <?php foreach($menu[8] as $cat) { ?>
                            <li>
                                <a href="Dupatta.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
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
                        <?php foreach($menu[13] as $cat) { ?>
                            <li>
                                <a href="lehanga.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
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
                        <?php foreach($menu[14] as $cat) { ?>
                            <li>
                                <a href="blouse.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                    <?php echo $cat['name']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

                                                <!-- skirts -->
                <li class="sub-dropdown">
                    <a href="#">skirts ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[15] as $cat) { ?>
                            <li>
                                <a href="skirts.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                    <?php echo $cat['name']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

                                                <!-- Designer dresses -->
                <li class="sub-dropdown">
                    <a href="#">Designer dresses ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[16] as $cat) { ?>
                            <li>
                                <a href="designerdresses.php?sub_id=<?php echo $cat['sub_categories_id']; ?>">
                                    <?php echo $cat['name']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

            </ul>
        </li>

    </ul>
</div><br>    

   <h1><?php echo $sub_name; ?> Collection</h1>
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

        <b>Rs. <?php echo $row['price']; ?></b>

        <p>Stock : <?php echo $row['stock_quantity']; ?></p>
        
                <!-- BUY BUTTON -->
            <a class="buybutton"
               href="order_place.php?id=<?php echo $row['product_id']; ?>">
               Buy
            </a>

                <!-- ADD TO CART BUTTON -->
            <a  class= "addtocartbutton" href="add_to_cart.php?id=<?php echo $row['product_id']; ?>">
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
 </body>
</html>

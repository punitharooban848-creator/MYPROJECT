<?php
include("db.php"); 
session_start();


// Sub Categories
$sub_sql = "SELECT * FROM sub_categories ORDER BY category_id";
$sub_result = mysqli_query($conn, $sub_sql);

$menu = [];

while($row = mysqli_fetch_assoc($sub_result))
{
    $menu[$row['category_id']][] = $row;
}
// filter coding
$filter = "";
if (isset($_GET['sub_categories_id']) && $_GET['sub_categories_id'] != "") {
    $sub_id = intval($_GET['sub_categories_id']);
    $filter = "WHERE sub_categories_id=$sub_id";
}

$sql = "SELECT * FROM products $filter";
$result = $conn->query($sql);  

if(isset($_GET['id']))
{
    $id = intval($_GET['id']);

    // get image
    $res = $conn->query("SELECT image FROM products WHERE product_id=$id");
    $row = $res->fetch_assoc();

    // delete query
    $conn->query("DELETE FROM products WHERE product_id=$id");
}
    // delete image file
if(isset($_POST['id']))
{
    $id = intval($_POST['id']);

    // get image path
    $res = $conn->query("SELECT image FROM products WHERE product_id=$id");
    $row = $res->fetch_assoc();

    // delete product
    $conn->query("DELETE FROM products WHERE product_id=$id");

    // delete image file
    if($row && !empty($row['image'])) {
        $imgPath = __DIR__ . "/" . $row['image'];
        if(file_exists($imgPath)) {
            unlink($imgPath);
        }
    }

    echo "<script>
        alert('Deleted Successfully');
        window.location.href='view_products.php';
    </script>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>All Products</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }

        .navbar { background-color: #fff; border: 2px solid #000; width: 200px; position: relative; text-align: center;margin-top:50px; }

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

        .grid-container {  display: grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap: 20px; }

        .item { border: 5px double  #000000; padding: 10px; text-align: center; background: #f9f9f9; border-radius: 5px; }

        .item img { width: 100%; height: 250px; object-fit: cover; margin-bottom: 10px; }

        .btn1{ margin-left:50px; width: 100px; height: 20px; }

        .editbutton{ display:inline-block; padding:10px 20px; background:green; color:white; text-decoration:none; 
                     border:2px solid green; border-radius:5px; margin-right:10px; }

        .editbutton:hover{ background:darkgreen; }

        .deletbutton{ display:inline-block; padding:10px 20px; background:red; color:white; text-decoration:none; 
                      border:2px solid red; border-radius:5px; }

        .deletbutton:hover{ background:darkred; }

        h2{ font-family: "Cooper Black", sans-serif; text-align: center; font-size: 70px;  margin-top:-100px; }

        .addicon{ position: absolute; top: 20px; right: 120px; display: right; gap: 15px; align-items: center;  margin: 0; display: inline-block;}

        .editbutton{ position:; top: 300px; right: 120px; display: right; gap: 15px; align-items: center; margin: 0; display: inline-block; } 
        
        a.view-details { display: inline-block; padding: 10px 20px; background-color: #000000; color: #fff;              
                         text-decoration: none;    border-radius: 5px;      transition: background 0.3s ease; font-weight: bold; }

        a.view-details:hover { background-color: #000000;   /* hover effect */ }

        .backbutton{ padding:10px 20px; background:#000; color:#fff; text-decoration:none; border-radius:5px; }

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
<div class="arrow" onclick="showDashboard()">
    <a href="admin_dashboard.php"><img src="icons8-back-100.png". width="40" height="40"></a>
</div>
    <a href="login.php"><img class="logouticon" height="50px" width="50px" src="icons8-logout-100.gif" alt="logout icon"></a>

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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
                                    <?php echo $cat['name']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>

                            <!-- Bridel dresses -->
                <li class="sub-dropdown">
                    <a href="#">Bridel dresses ▶</a>
                    <ul class="sub-menu">
                        <?php foreach($menu[12] as $cat) { ?>
                            <li>
                                <a href="view_products.php?sub_categories_id=<?php echo $cat['sub_categories_id']; ?>">
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


        <!-- Add icon coding-->
        <a href="add_product.php"><img class="addicon" height="50px" width="50px" src="icons8-add-96.png" alt="Cart Icon"></a>
        <h2>All Products</h2>
    <div class="grid-container">
        <?php while($row = $result->fetch_assoc()) { ?>
            <div class="item">
                <!-- Use $row not $dress -->
                <img src="<?php echo $row['image']; ?>" width="240" height="400">
                <h3><?php echo $row['name']; ?></h3>
                <p>Rs <?php echo $row['price']; ?></p>

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
            <br><br>
                <!-- VIEW DETAILS BUTTON -->
            <a  class= "viewbutton" href="adminproduct_details.php?id=<?php echo $row['product_id']; ?>">
                View Details
            </a>
 
            </div>
        <?php } ?>
    </div>
</body>
</html>

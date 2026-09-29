<?php
include("db.php");


// ================= ADD CATEGORY =================

if(isset($_POST['add_category']))
{
    $category_name = mysqli_real_escape_string($conn,$_POST['category_name']);

    $sql = "INSERT INTO categories(name)
            VALUES('$category_name')";

    mysqli_query($conn,$sql);

    header("Location:manage_categories.php");
    exit;
}



// ================= DELETE CATEGORY =================

if(isset($_GET['delete_category']))
{
    $id = intval($_GET['delete_category']);


    // Delete sub categories first
    mysqli_query($conn,
    "DELETE FROM sub_categories 
     WHERE category_id='$id'");


    // Delete category
    mysqli_query($conn,
    "DELETE FROM categories
     WHERE category_id='$id'");


    header("Location:manage_categories.php");
    exit;
}




// ================= ADD SUB CATEGORY =================

if(isset($_POST['add_sub']))
{
    $category_id = intval($_POST['category_id']);

    $sub_name = mysqli_real_escape_string($conn,$_POST['sub_name']);


    mysqli_query($conn,
    "INSERT INTO sub_categories(category_id,name)
     VALUES('$category_id','$sub_name')");


    header("Location:manage_categories.php");
    exit;
}




// ================= DELETE SUB CATEGORY =================

if(isset($_GET['delete_sub']))
{
    $id = intval($_GET['delete_sub']);


    mysqli_query($conn,
    "DELETE FROM sub_categories
     WHERE sub_categories_id='$id'");


    header("Location:manage_categories.php");
    exit;
}




// Get categories

$cat_result = mysqli_query($conn,
"SELECT * FROM categories ORDER BY category_id DESC");



// Dropdown categories

$dropdown = mysqli_query($conn,
"SELECT * FROM categories ORDER BY name");

// EDIT CATEGORY 

if(isset($_POST['update_category']))
{
    $id = intval($_POST['category_id']);
    $name = mysqli_real_escape_string($conn,$_POST['category_name']);

    mysqli_query($conn,
    "UPDATE categories 
     SET name='$name'
     WHERE category_id='$id'");

    header("Location:manage_categories.php");
    exit;
}



// EDIT SUB CATEGORY 

if(isset($_POST['update_sub']))
{
    $id = intval($_POST['sub_id']);
    $name = mysqli_real_escape_string($conn,$_POST['sub_name']);

    mysqli_query($conn,
    "UPDATE sub_categories
     SET name='$name'
     WHERE sub_categories_id='$id'");

    header("Location:manage_categories.php");
    exit;
}


// UPDATE CATEGORY 

if(isset($_POST['update_category']))
{
    $id = intval($_POST['category_id']);
    $name = mysqli_real_escape_string($conn,$_POST['category_name']);

    mysqli_query($conn,
    "UPDATE categories 
     SET name='$name'
     WHERE category_id='$id'");

    header("Location:manage_categories.php");
    exit;
}



//  UPDATE SUB CATEGORY 

if(isset($_POST['update_sub']))
{
    $id = intval($_POST['sub_id']);
    $name = mysqli_real_escape_string($conn,$_POST['sub_name']);

    mysqli_query($conn,
    "UPDATE sub_categories
     SET name='$name'
     WHERE sub_categories_id='$id'");

    header("Location:manage_categories.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Manage Categories</title>


<style>

body{
    font-family:Arial;
    background:#f5f5f5;
}


.container{

    width:900px;
    margin:30px auto;
    background:white;
    padding:25px;
    border-radius:10px;

}


.box{

    border:1px solid #ddd;
    padding:20px;
    margin-bottom:25px;
    border-radius:10px;

}


input,select{

    width:300px;
    padding:10px;

}


button{

    padding:10px 20px;
    background:green;
    color:white;
    border:none;
    cursor:pointer;

}


table{

    width:100%;
    border-collapse:collapse;
    margin-top:15px;

}


th{

    background:black;
    color:white;

}


th,td{

    border:1px solid #ccc;
    padding:10px;
    text-align:center;

}


.delete{

    background: #630e0e;
    color:white;
    padding:6px 10px;
    text-decoration:none;
    border-radius:5px;

}

.edit{
    background: #f3852b;
    color:white;
    padding:6px 15px;
    text-decoration:none;
    border-radius:5px;
}

.edit, .delete{
    display:inline-block;
    margin:5px;
}
</style>

</head>


<body>
<div class="arrow" onclick="showDashboard()">
    <a href="admin_dashboard.php"><img src="icons8-back-100.png". width="40" height="40"></a>
</div>


<div class="container">


<h1>Manage Categories</h1>



<!-- ADD CATEGORY -->

<div class="box">

<h2>Add Category</h2>


<form method="post">


<input type="text"
name="category_name"
placeholder="Category Name"
required>


<button name="add_category">
Add Category
</button>


</form>


</div>

<!-- ADD SUB CATEGORY -->


<div class="box">


<h2>Add Sub Category</h2>


<form method="post">


<select name="category_id" required>

<option value="">
Select Category
</option>


<?php

while($row=mysqli_fetch_assoc($dropdown))
{

?>

<option value="<?php echo $row['category_id']; ?>">

<?php echo $row['name']; ?>

</option>


<?php

}

?>


</select>


<br><br>


<input type="text"
name="sub_name"
placeholder="Sub Category Name"
required>


<button name="add_sub">
Add Sub Category
</button>


</form>


</div>
 <!-- category edit-->
<?php

if(isset($_GET['edit_category']))
{
    $id=$_GET['edit_category'];

    $edit=mysqli_query($conn,
    "SELECT * FROM categories 
     WHERE category_id='$id'");

    $row=mysqli_fetch_assoc($edit);

?>

<div class="box">

<h2>Edit Category</h2>

<form method="post">

<input type="hidden"
name="category_id"
value="<?php echo $row['category_id']; ?>">


<input type="text"
name="category_name"
value="<?php echo $row['name']; ?>"
required>


<button name="update_category">
Update Category
</button>

</form>

</div>

<?php
}
?>

<!--sub category edit-->
<?php

if(isset($_GET['edit_sub']))
{
    $id=$_GET['edit_sub'];

    $edit=mysqli_query($conn,
    "SELECT * FROM sub_categories
     WHERE sub_categories_id='$id'");

    $row=mysqli_fetch_assoc($edit);

?>

<div class="box">

<h2>Edit Sub Category</h2>

<form method="post">

<input type="hidden"
name="sub_id"
value="<?php echo $row['sub_categories_id']; ?>">


<input type="text"
name="sub_name"
value="<?php echo $row['name']; ?>"
required>


<button name="update_sub">
Update Sub Category
</button>

</form>

</div>

<?php
}
?>


<!-- CATEGORY LIST -->


<div class="box">


<h2>Category List</h2>



<?php

while($cat=mysqli_fetch_assoc($cat_result))

{

?>


<h3>

<?php echo $cat['name']; ?>


<a class="edit"
href="?edit_category=<?php echo $cat['category_id']; ?>">
Edit
</a>

<a class="delete"
onclick="return confirm('Delete Category?')"
href="?delete_category=<?php echo $cat['category_id']; ?>">
Delete
</a>


</h3>



<table>


<tr>

<th>ID</th>
<th>Sub Category</th>
<th>Action</th>

</tr>



<?php


$sub_result=mysqli_query($conn,

"SELECT * FROM sub_categories
WHERE category_id='".$cat['category_id']."'");


if(mysqli_num_rows($sub_result)>0)

{


while($sub=mysqli_fetch_assoc($sub_result))

{


?>


<tr>


<td>

<?php echo $sub['sub_categories_id']; ?>

</td>


<td>

<?php echo $sub['name']; ?>

</td>


<td>


<a class="edit"
href="?edit_sub=<?php echo $sub['sub_categories_id']; ?>">
Edit
</a>

<a class="delete"
onclick="return confirm('Delete Sub Category?')"
href="?delete_sub=<?php echo $sub['sub_categories_id']; ?>">
Delete
</a>


</td>


</tr>


<?php

}

}

else

{
?>
<tr>
<td colspan="3">
No Sub Categories
</td>
</tr>
<?php
}
?>
</table>
<?php
}
?>
</div>
</div>
</body>

</html>

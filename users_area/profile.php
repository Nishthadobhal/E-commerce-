<!--connect file-->
<?php
include('../insert/connect.php');
include('../function/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- bootstrap css link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<!--font awesome link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--css link-->
<link rel="stylesheet" href="style.css">
<style>
  body{
    overflow-x:hidden ;
  }
.profile_img{
    width:90%;
    margin:auto;
    display:block;
    object-fit:contain;

}

</style>
    </head>

<body>
<!--nav bar-->
<div class="container-fluid p-0 "> <!--container fluid take 100% of the width-->
  <!--firstchild-->
<nav class="navbar navbar-expand-lg bg-info">
  <div class="container-fluid">
    <img src="../logo_php.png" class="logo" width="5%">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../card.php"><i class="fa-solid fa-cart-shopping"></i><sup>
            <?php
       cart_item_num();?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price:<?php total_cart_price(); ?>/-</a>
        </li>


      </ul>
      <form class="d-flex" role="search" action="" method="get">
<!--agar hame searchproduct vali different file attach na krke ishime add krnna tha toh another way was:
  getproduct() vala function jo hai vha if condition lgado ki agar search isset nhi h toh vo chlega aur all product dikhenge nhi toh only searched products dikhenge cal search_products() function   .. 
  way2: SEARCHPRODUCT.PHP FILE ADD KRDO ISKE ACTION M  -->
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data"/>
   

<!--inside this when we search the keyword after submittig this input field  the products which will match from the databse will appear on the screen.-->
<input type="submit" name="search_data_product" value="search" class="btn-outline-light">

      </form>
    </div>
  </div>
</nav>
<!--calling cart function-->
<?php
cart();
?>

<!--second child-->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<ul class="navbar-nav me-auto">
<?php
if(!isset($_SESSION['username'])){
  echo "    <li class='nav-item'>
    <a class='nav-link' href='#'> Welcome Guest </a>
  </li>";
}else{
  echo "    <li class='nav-item'>
    <a class='nav-link' href='#'> Welcome ".$_SESSION['username']." </a>
  </li>";
}

if(!isset($_SESSION['username'])){
  echo "    <li class='nav-item'>
    <a class='nav-link' href='user_login.php'> Login </a>
  </li>";
}else{
  echo  "    <li class='nav-item'>
    <a class='nav-link' href='logout.php'> Logout </a>
  </li>";
}
?>

</ul>
</nav>


<!--third child-->
<div class="bg-light">
  <h3 class="text-center">Hdiden Store</h3>
  <p class="text-center">communications is  at the heart of e-commerce and community</p>
</div>
<!--fourth child-->
<div class="row">
    <div class="col-md-2">
        <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
            <li  class="nav-item bg-info">
                <a  class="nav-link text-light" href="#">Your Profile</a>
            </li>
<?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT user_image FROM `user_table` WHERE user_id=$user_id";
    $result_image = mysqli_query($con, $query);

    if ($result_image && mysqli_num_rows($result_image) > 0) {
        $row_image = mysqli_fetch_assoc($result_image);
        $user_image = $row_image['user_image'];

        echo "<li class='nav-item'>
                <img src='./user_images/$user_image' class='profile_img my-4' alt='Profile Image'>
              </li>";
    } else {
        echo "<li class='nav-item text-light'>No profile image found</li>";
    }
} else {
    echo "<li class='nav-item text-light'>Please login first</li>";
}
?>


<li class="nav-item">
    <a class="nav-link  text-light" href="profile.php">Pending Orders</a>
</li>
<li class="nav-item">
    <a class="nav-link  text-light" href="profile.php?edit_account">Edit Account</a>
</li>
<li class="nav-item">
    <a class="nav-link  text-light" href="profile.php?my_orders">My Orders</a>
</li>
<li class="nav-item">
    <a class="nav-link  text-light" href="profile.php?delete_account">Delete Account</a>
</li>
<li class="nav-item">
    <a class="nav-link  text-light" href="logout.php">Logout</a>
</li>

    </ul>
    </div>
<div class="col-md-10">
   <?php  get_user_order_details();
   if(isset($_GET['edit_account'])){
    include('edit_account.php');
   }
   ?>
</div>
</div>

<!--last child include footer-->
<?php
include("../footer.php");
?>
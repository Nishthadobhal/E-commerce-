<?php
include('insert/connect.php');
include('function/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Cartify | All Products</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

<link rel="stylesheet" href="style.css">

<style>

body{
overflow-x:hidden;
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
background:url("images/hero.jpg") center/cover no-repeat fixed;
}

.logo{
height:40px;
object-fit:contain;
}

.product-wrapper{
margin-top:40px;
margin-bottom:40px;
padding:30px;
background:white;
border-radius:14px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
}

.section-title{
font-weight:600;
letter-spacing:0.5px;
}

.offcanvas .nav-link{
color:black !important;
}

.offcanvas .nav-link:hover{
color:#0d6efd !important;
}

</style>

</head>

<body>

<div class="container-fluid p-0">

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
<div class="container-fluid">

<a class="navbar-brand d-flex align-items-center" href="index.php">
<img src="cartify_logo.png" class="logo">
</a>

<form class="d-flex mx-auto w-50" role="search" action="" method="get">
<input class="form-control me-2" type="search" placeholder="Search products..." name="search_data">

<button class="btn btn-outline-light" type="submit" name="search_data_product">
<i class="fa fa-search"></i>
</button>
</form>

<ul class="navbar-nav align-items-center">

<?php
if(!isset($_SESSION['user_id'])){
echo "
<li class='nav-item'>
<a class='nav-link' href='./users_area/user_login.php'>Login</a>
</li>

<li class='nav-item'>
<a class='nav-link' href='./users_area/user_registration.php'>Register</a>
</li>";
}else{
echo "
<li class='nav-item'>
<a class='nav-link' href='./users_area/profile.php'>Account</a>
</li>

<li class='nav-item'>
<a class='nav-link' href='./users_area/logout.php'>Logout</a>
</li>";
}
?>

<li class="nav-item">
<a class="nav-link position-relative" href="card.php">
<i class="fa-solid fa-cart-shopping"></i>

<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
<?php cart_item_num(); ?>
</span>
</a>
</li>

<li class="nav-item">
<a class="nav-link">
₹ <?php total_cart_price(); ?>
</a>
</li>

<li class="nav-item ms-2">
<button class="btn btn-outline-light" data-bs-toggle="offcanvas" data-bs-target="#filterMenu">
<i class="fa-solid fa-bars"></i>
</button>
</li>

</ul>

</div>
</nav>

<?php cart(); ?>

<!-- PRODUCTS -->

<div class="container product-wrapper">

<h4 class="section-title mb-4">All Products</h4>

<div class="row g-4 justify-content-center">

<?php

if(!isset($_GET['search_data_product'])){
get_all_products();
}
else{
search_product();
}

get_unique_categories();
get_unique_brands();

?>

</div>

</div>

<!-- FILTER PANEL -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="filterMenu">

<div class="offcanvas-header">
<h5 class="offcanvas-title">Browse</h5>
<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
</div>

<div class="offcanvas-body">

<h6 class="fw-bold">Brands</h6>

<ul class="navbar-nav">

<?php
getbrands();
?>

</ul>

<h6 class="fw-bold mt-4">Categories</h6>

<ul class="navbar-nav">

<?php
getcategories();
?>

</ul>

</div>

</div>

<?php
include("./insert/footer.php");
?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
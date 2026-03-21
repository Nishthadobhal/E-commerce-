<?php
include('insert/connect.php');
include('function/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Cartify | Online Shopping</title>

<!-- bootstrap css link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

<!--font awesome-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

<link rel="stylesheet" href="style.css">

<style>

/* GENERAL */

body{
overflow-x:hidden;
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

background:url("images/hero.jpg") center/cover no-repeat fixed;
background-color:#f4f6f9;
}

/* LOGO */

.logo{
height:40px;
object-fit:contain;
}



/* SECTION TITLE */

.section-title{
font-weight:600;
color:#222;
}

/* PRODUCT CARD */

.card{
border:none;
border-radius:14px;
overflow:hidden;
background:#fff;
box-shadow:0 8px 20px rgba(0,0,0,0.08);
transition:all 0.3s ease;
}

.card:hover{
transform:translateY(-8px) scale(1.02);
box-shadow:0 15px 30px rgba(0,0,0,0.15);
}

.card img{
height:220px;
object-fit:cover;
}

.btn{
border-radius:8px;
font-size:14px;
}

.card-title{
font-weight:600;
}

.card-text{
color:#666;
font-size:14px;
}

.section-title{
font-weight:600;
letter-spacing:0.5px;
margin-bottom:20px;


}
/* OFFCANVAS LINKS */

.offcanvas .nav-link{
color:black !important;
}

.offcanvas .nav-link:hover{
color:#0d6efd !important;
}

.product-wrapper{
margin-top:40px;
margin-bottom:40px;
padding:30px;
background:white;
border-radius:14px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
position:relative;
z-index:5;
}
</style>

</head>

<body>

<div class="container-fluid p-0">

<!-- NAVBAR -->

<?php
include('navbar.php');
?>



<?php cart(); ?>

<!-- HERO IMAGE -->




<!-- PRODUCTS SECTION -->

<div class="container product-wrapper">

<h4 class="section-title mb-4">All Products</h4>

<div class="row g-4 justify-content-center">

<?php

if(!isset($_GET['search_data_product'])){
getproducts();
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


<!-- FOOTER -->

<div class="bg-dark text-light text-center p-3 mt-5">
<p class="mb-0">© 2026 Cartify | Developed by Nishtha</p>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
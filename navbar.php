<?php
$current_page = basename($_SERVER['PHP_SELF']);

// ensure functions always available
if(!function_exists('cart_item_num')){
    include_once(__DIR__ . '/function/common_function.php');
    include_once(__DIR__ . '/insert/connect.php');
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
<div class="container-fluid">

<!-- LOGO -->
<a class="navbar-brand d-flex align-items-center" href="/ecommerce/index.php">
<img src="/ecommerce/cartify-logo.svg" class="logo" alt="Cartify Logo">
</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav me-auto">

<li class="nav-item">
<a class="nav-link <?php if($current_page=='index.php') echo 'active'; ?>" href="/ecommerce/index.php">Home</a>
</li>

<li class="nav-item">
<a class="nav-link <?php if($current_page=='display_all.php') echo 'active'; ?>" href="/ecommerce/display_all.php">Products</a>
</li>

</ul>

<!-- SEARCH BAR -->
<?php 
if($current_page != 'user_login.php' && $current_page != 'user_registration.php'){ 
?>
<form class="d-flex w-100 mt-2" role="search" action="/ecommerce/index.php" method="get">
<input class="form-control me-2" type="search" placeholder="Search products..." name="search_data">

<button class="btn btn-outline-light" type="submit" name="search_data_product">
<i class="fa fa-search"></i>
</button>
</form>
<?php } ?>

<ul class="navbar-nav ms-auto">

<?php
if(!isset($_SESSION['username'])){
echo "
<li class='nav-item'>
<a class='nav-link' href='/ecommerce/users_area/user_login.php'>Login</a>
</li>

<li class='nav-item'>
<a class='nav-link' href='/ecommerce/users_area/user_registration.php'>Register</a>
</li>";
}
else{
echo "
<li class='nav-item dropdown'>
<a class='nav-link dropdown-toggle d-flex align-items-center' href='#' role='button' data-bs-toggle='dropdown'>
<i class='fa-solid fa-user me-1'></i> ".$_SESSION['username']."
</a>

<ul class='dropdown-menu dropdown-menu-end'>
<li><a class='dropdown-item' href='/ecommerce/users_area/profile.php'>My Profile</a></li>
<li><hr class='dropdown-divider'></li>
<li><a class='dropdown-item text-danger' href='/ecommerce/users_area/logout.php'>Logout</a></li>
</ul>
</li>";
}
?>

<li class="nav-item">
<a class="nav-link position-relative" href="/ecommerce/card.php">
<i class="fa-solid fa-cart-shopping"></i>
<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
<?php cart_item_num(); ?>
</span>
</a>
</li>

<li class="nav-item">
<a class="nav-link">₹ <?php total_cart_price(); ?></a>
</li>

<!-- HAMBURGER -->
<button class="btn btn-outline-light me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
<i class="fa-solid fa-bars"></i>
</button>

</ul>

</div>
</div>
</nav>
<!-- OFFCANVAS SIDEBAR -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasSidebar">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Browse</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body">

    <!-- Categories -->
    <h6 class="mb-2">Categories</h6>
    <ul class="navbar-nav">
      <?php getcategories(); ?>
    </ul>

    <hr>

    <!-- Brands -->
    <h6 class="mb-2">Brands</h6>
    <ul class="navbar-nav">
      <?php getbrands(); ?>
    </ul>

  </div>
</div>

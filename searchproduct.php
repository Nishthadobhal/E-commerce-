<!--connect file-->
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
    <title>Document</title>
    <!-- bootstrap css link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<!--font awesome link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--css link-->
<link rel="stylesheet" href="style.css">
    </head>

<body>
<!--nav bar-->
<div class="container-fluid p-0 "> <!--container fluid take 100% of the width-->
  <!--firstchild-->
<?php
include('navbar.php');
?>



<!--fourth child-->
 <div class="container mt-5">
<div class="row"> <!--column jitne bhi bnao unka sum 12 hona chahiye-->
<div class="col-md-10">
<!--products-->
<div class="row">
  <!--fetching products-->
<?php
if(isset($_GET['search_data_product'])){
search_product();
}

get_unique_categories();
get_unique_brands();
?>
 

  </div>
</div>


<!--side nav-->
<div class="col-md-2 sidebar ">
<!--brands to be displayed-->
<ul class="navbar-nav me-auto text-center">
<li class="nav-item bg-info">
  <a href="#" class="nav-link text-light"><h5 class="fw-bold text-center mt-3">Brands</h5></a>
</li>

<?php
getbrands();

?>

</ul>

<!--ccategories to be displayed-->
<ul class="navbar-nav me-auto text-center">
 <li class="nav-item bg-info">
  <a href="#" class="nav-link text-light"><h5 class="fw-bold text-center mt-4">Categories</h5></a>
</li>

<?php
getcategories();


?>


</ul>

 

</div>
</div>

<!-- last child-->
<div class="bg-dark text-light text-center p-3 mt-5">
<p class="mb-0">© 2026 Cartify | Developed by Nishtha</p>
</div>



</div>





    <!-- bootstrap js link -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
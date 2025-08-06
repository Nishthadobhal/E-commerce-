<!--connect file-->
<?php
include('../insert/connect.php');
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
    </head >

<body>
<!--nav bar-->
<div class="container-fluid p-0 "> <!--container fluid take 100% of the width-->
  <!--firstchild-->
<nav class="navbar navbar-expand-lg bg-info">
  <div class="container-fluid">
    <img src="logo_php.png" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>

      </ul>
      <form class="d-flex" role="search" action="" method="get">

        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data"/>
       
<input type="submit" name="search_data_product" value="search" class="btn-outline-light">

      </form>
    </div>
  </div>
</nav>


<!--second child-->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
<ul class="navbar-nav me-auto">
  <li class="nav-item">
    <a class="nav-link" href="#"> Welcome Guest </a>
  </li>
  <li class="nav-item">
<a class="nav-link" href="#">Login</a>
  </li>
</ul>
</nav>


<!--third child-->
<div class="bg-light">
  <h3 class="text-center">Hdiden Store</h3>
  <p class="text-center">communications is  at the heart of e-commerce and community</p>
</div>


<!--fourth child-->
<div class="row px-1">   <!--column jitne bhi bnao unka sum 12 hona chahiye-->
<div class="col-md-12">
<!--products-->
<div class="row">
    <?php
 if(!isset($_SESSION['username'])){
include('user_login.php');
 }else{
    include('../payment.php');
 }
 ?>
  </div>
</div>

<!-- last child-->
<div class="bg-info p-3 text-center p-0 mb-0">
  <p>Directed By Nishtha</p>
</div>

</div>







    <!-- bootstrap js link -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
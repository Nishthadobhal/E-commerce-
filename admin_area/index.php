<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
<!--bootstrap css link-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<!--css file link-->
<link href="../style.css" rel="stylesheet">
<!--font awesome link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .admin_image{
    width: 100px;
   object-fit: contain; 
}
</style>
    </head>
<body>
<!--navbar-->
<div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img  src="../logo_php.png" class="logo">
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Welcome Guest</a>
                    </li>
                </ul>
            </nav>
        </div>
    </nav>

<!-- second child -->
<div class="bg-light">
    <h3 class="text-center p-2">Manage Details</h3>
</div>

<!-- third child -->
<div class="row">
    <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
        <div class="p-3">
            <a href="#"> <img src="../pineapple.jpg" alt="" class="admin_image"></a>
            <p class="text-light text-center">Admin Name</p>
        </div>
        <div class="button text-center">
<button class="my-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert Products</a></button>
<button><a href="" class="nav-link text-light bg-info my-1">View Products</a></button>
<button><a href="index.php?insert_categories" class="nav-link text-light bg-info my-1">Insert Categories</a></button>
<button><a href="" class="nav-link text-light bg-info my-1">View Categories</a></button>
<button><a href="index.php?insert_brands" class="nav-link text-light bg-info my-1">Insert Brands</a></button>
<button><a href="" class="nav-link text-light bg-info my-1">View Brands</a></button>
<button><a href="" class="nav-link text-light bg-info my-1">All Orders</a></button>
<button><a href="" class="nav-link text-light bg-info my-1">All Payments</a></button>
<button><a href="" class="nav-link text-light bg-info my-1">List Users</a></button>
<button><a href="" class="nav-link text-light bg-info my-1">LogOut</a></button>

        </div>
    </div>
</div>

<!-- fourth child -->
<div class="container my-3">
    <?php 
if(isset($_GET['insert_categories'])){
     // This block will run if the user clicked that link
  include('insert_categories.php') ; 
}

if(isset($_GET['insert_brands'])){
     // This block will run if the user clicked that link
  include('insert_brands.php') ; 
}

?>
</div>




</div>






 <!-- bootstrap js link -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
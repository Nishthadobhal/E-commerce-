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
          <a class="nav-link" href="./users_area/user_registration.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="card. php"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a>
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
        <!-- <button class="btn btn-outline-light" type="submit">Search</button> -->

<!--inside this when we search the keyword after submittig this input field  the products which will match from the databse will appear on the screen.-->
<input type="submit" name="search_data_product" value="search" class="btn-outline-light">

      </form>
    </div>
  </div>
</nav>

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
    <a class='nav-link' href='./users_area/user_login.php'> Login </a>
  </li>";
}else{
  echo  "    <li class='nav-item'>
    <a class='nav-link' href='./users_area/user_login.php'> Logout </a>
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
<div class="row">   <!--column jitne bhi bnao unka sum 12 hona chahiye-->
<div class="col-md-10">
<!--products-->
<div class="row">
  <!--fetching products-->
   <?php
   //calling function
   if(!isset($_GET['search_data_product']))
{
 get_all_products();   
   }  //display pe jo products dikh rhe h vo.
   else{

search_product();
   }
    get_unique_categories(); // call function when we click on category .
    get_unique_brands(); //call function when we click on brands.
// $select_query="select * from `products` order by rand() limit 0,9"; //rand() means randomly showing elements on each refresh , limit 0,9 means upto 9 elements can be showed on the page.
// $result_query=mysqli_query($con,$select_query);
// while($row=mysqli_fetch_assoc($result_query)){
// $product_id=$row['product_id'];
// $product_title=$row['product_title'];
// $product_description=$row['product_description'];
// $product_image1=$row['product_image1'];
// $product_price=$row['product_price'];
// $category_id=$row['category_id'];
// $brand_id=$row['brand_id'];
// echo " <div class='col-md-4 mb-2' >
//      <div class='card' style='width: 18rem;'>
//   <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
//   <div class='card-body'>
//     <h5 class='card-title'>$product_title</h5>
//     <p class='card-text'>$product_description</p>
//     <a href='#' class='btn btn-info'>Add to Cart</a>
//      <a href='#' class='btn btn-secondary'>View more</a>
//   </div>
// </div>
//   </div>";
// }
  ?>
  <!-- <div class="col-md-4 mb-2 ">
     <div class="card" style="width: 18rem;">
  <img src="dress.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
    <a href="#" class="btn btn-info">Add to Cart</a>
     <a href="#" class="btn btn-secondary">View more</a>
  </div>
</div>
  </div> -->

  </div>
</div>


<!--side nav-->
<div class="col-md-2 bg-secondary p-0 ">
<!--brands to be displayed-->
<ul class="navbar-nav me-auto text-center">
<li class="nav-item bg-info">
  <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
</li>

<?php
getbrands();
// $select_brands="select * from `brands`";
// $result_brands=mysqli_query($con,$select_brands);
// // $row_data=mysqli_fetch_assoc($result_brands);
// // echo $row_data['brand_title'];
// while($row_data=mysqli_fetch_assoc($result_brands)){

//   $brand_title=$row_data['brand_title'];
//   $brand_id=$row_data['brand_id'];
//   // echo $brand_title; ise ek jagah dikh re the ssare brands
// echo "<li class='nav-item'>
//   <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
// </li>";
//}
?>
<!-- 
<li class="n">
  <a href="#" class="nav-link text-light"><h4> Brand 1</h4></a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link text-light"><h4>Brand 2</h4></a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link text-light"><h4>Brand 3</h4></a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link text-light"><h4>Brand 4</h4></a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link text-light"><h4>Brand 5</h4></a>
</li> -->
</ul>

<!--ccategories to be displayed-->
<ul class="navbar-nav me-auto text-center">
 <li class="nav-item bg-info">
  <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
</li>

<?php
getcategories();
// $select_categories="select * from `categories`";
// $result_category=mysqli_query($con,$select_categories);
// while($row_data=mysqli_fetch_assoc($result_category)){
// $category_id=$row_data['category_id'];
// $category_title=$row_data['category_title'];
// echo "<li class='nav-item'>
//   <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
// </li>";
// }

?>

<!--
<li class="n">
  <a href="#" class="nav-link text-light"><h4> Category 1</h4></a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link text-light"><h4>Category 2</h4></a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link text-light"><h4>Category 3</h4></a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link text-light"><h4>Category 4</h4></a>
</li>
<li class="nav-item">
  <a href="#" class="nav-link text-light"><h4>Category 5</h4></a>
</li> -->
</ul>

 

</div>
</div>

<!-- last child-->
<!-- <div class="bg-info p-3 text-center p-0">
  <p>Directed By Nishtha</p>
</div> -->
<?php
include("./insert/footer.php");
?>



</div>





    <!-- bootstrap js link -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
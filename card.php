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

<style>
  .cart_img{
    width: 80px;
    height: 80px;
    object-fit: contain;

 }
</style>
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
          <a class="nav-link" href="#">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="card.php"><i class="fa-solid fa-cart-shopping"></i>
          <sup>
            <?php
       cart_item_num();?></sup></a>
        </li>

      </ul>
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

<form action="" method="post">

<!--fourth child-->
<div class="container">
     <div class="row">
        <table class="table table-bordered text-center">
         
<!--php code to display dynamic data-->
<?php
  // function total_cart_price(){
global $con;
$ip=get_client_ip();
$total=0;
  $cart_query="select * from `cart_details` where ip_address='$ip'";
$result=mysqli_query($con,$cart_query);

$result_count=mysqli_num_rows($result);

if($result_count>0){
  echo " <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Remove</th>
                    <th colspan='2' >Operation</th>
                </tr>
                </thead>
                <tbody>";
                



while($row=mysqli_fetch_array($result)){
$product_id=$row['product_id'];
//prices arre present inside product table
$select_products="select * from `products` where product_id=$product_id";
$result_products=mysqli_query($con,$select_products);
while($row_product_price=mysqli_fetch_array($result_products)){
  

$price_table=$row_product_price['product_price'];
$product_title=$row_product_price['product_title'];
$product_image1=$row_product_price['product_image1'];

// $quantity = $row['quantity'] ?? 1;
$total += $price_table ;

?>
                <tr>
                    <td><?php echo $product_title ?></td>
                    <td><img src="admin_area\product_images\<?php echo $product_image1?>" alt="" 
                    class="cart_img"></td>
                        <!-- <td><input type="number" name="qty" id="" class='form-input w-50' ></td> -->
                    <td> <input type="number" name="qty" class='form-input w-50' > </td> 

                    <?php
 $get_ip_add=get_client_ip();
 if(isset($_POST['update_cart'])){
  $quantities=$_POST['qty'];
$update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_add'";
$result_products_quantity=mysqli_query($con,$update_cart);
$total=$total*$quantities;

 }


                    ?>


                        <td><?php echo $price_table?>/-</td>

                        <td><input type="checkbox" name="removeitem[]" value="<?php echo
                        $product_id ?> "
                        ></td>
                        <td>
                            
                             <input type="submit" value="update cart" name="update_cart" class="bg-info px-3 py-2">
                           
                               <input type="submit" value="Remove cart" name="remove_cart" class="bg-info px-3 py-2">
                        </td>
                    </td>
                </tr>

                <?php
               }}}

else{
  echo "<h2 class='text-center text-danger'>cart is empty</h2>";
}

 ?>
            </tbody>
</table>
<!--subtotal-->
<div class="d-flex mb-5">
  <?php
$ip=get_client_ip();
// $total=0;
  $cart_query="select * from `cart_details` where ip_address='$ip'";
$result=mysqli_query($con,$cart_query);
$result_count=mysqli_num_rows($result);
if($result_count>0){
echo "<h4 class='px-3'> subtotal: <strong class='text-info'> $total/- </strong></h4>
   <input type='submit' value='Continue Shopping' name='Continue_Shopping' class='bg-info px-3 py-2'>
 <button class='bg-secondary p-3 py-2 text-decoration-none'><a href='./users_area/checkout.php' class='text-light' >Checkout</a></button></a>";}
 else{
  echo "<input type='submit' value='Continue Shopping' name='Continue_Shopping' class='bg-info px-3 py-2 border-0'> ";
 }
 if(isset($_POST['Continue_Shopping'])){
  echo "<script>window.open('index.php','_self')</script>";
 }
  ?>

</div>
        </div>
     </div>
</form>

              <!--function to remove item-->
              <?php
function remove_cart_item(){
  global $con;
  $ip = get_client_ip();

  if(isset($_POST['remove_cart']) && isset($_POST['removeitem'])){
    foreach($_POST['removeitem'] as $remove_id){
      $delete_query = "DELETE FROM `cart_details` WHERE product_id = $remove_id AND ip_address = '$ip'";
      $run_delete = mysqli_query($con, $delete_query);
      if($run_delete){
        echo "<script>window.open('card.php','_self')</script>";
      }
    }
  

  }
}
remove_cart_item();

              ?>

<!-- last child-->
<div class="bg-info p-3 text-center p-0">
  <p>Directed By Nishtha</p>
</div>



</div>





    <!-- bootstrap js link -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html> 
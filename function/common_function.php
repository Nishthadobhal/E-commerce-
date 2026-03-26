<?php

function getproducts(){
    global $con;// use global keyword for declaring $con globally

    //condition to check isset or not
    if(!isset($_GET['category'])){ //if anything is not set then it will display the whole data,means agr hamne kisi bhi cheez mai click nhi kara category aur brand m se tab ye pura data dekhega....
if(!isset($_GET['brand'])){
    
$select_query="select * from `products` order by rand() limit 0,9"; //rand() means randomly showing elements on each refresh , limit 0,9 means upto 9 elements can be showed on the page.
$result_query=mysqli_query($con,$select_query);
while($row=mysqli_fetch_assoc($result_query)){
$product_id=$row['product_id'];
$product_title=$row['product_title']; 
$product_description=$row['product_description'];
$product_image1=$row['product_image1'];
$product_price=$row['product_price'];
$category_id=$row['category_id'];
$brand_id=$row['brand_id'];
echo " <div class='col-sm-6 col-md-6 col-lg-3 mb-4' >
     <div class='card'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
       <p class='card-text'>Price: $product_price/-</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Add to Cart</a>
   
  </div>
</div>
  </div>";
}
}
}
}

// getting all products in navbar pannel
function get_all_products(){
    global $con;// use global keyword for declaring $con globally

    //condition to check isset or not
    if(!isset($_GET['category'])){ //if anything is not set then it will display the whole data,means agr hamne kisi bhi cheez mai click nhi kara category aur brand m se tab ye pura data dekhega....
if(!isset($_GET['brand'])){
    
$select_query="select * from `products` order by rand() "; //rand() means randomly showing elements on each refresh , limit 0,9 means upto 9 elements can be showed on the page.
$result_query=mysqli_query($con,$select_query);
while($row=mysqli_fetch_assoc($result_query)){
$product_id=$row['product_id'];
$product_title=$row['product_title'];
$product_description=$row['product_description'];
$product_image1=$row['product_image1'];
$product_price=$row['product_price'];
$category_id=$row['category_id'];
$brand_id=$row['brand_id'];
echo " <div class='col-sm-6 col-md-6 col-lg-3 mb-4' >
     <div class='card'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
     <p class='card-text'>Price: $product_price/-</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Add to Cart</a>
    
  </div>
</div>
  </div>";
}
}
}
}


//get unique categories
function get_unique_categories(){
   global $con; 
    //condition to check isset or not
    if(isset($_GET['category'])){ 
        $category_id=$_GET['category'];
    
$select_query="select * from `products` where category_id=$category_id";
$result_query=mysqli_query($con,$select_query);
$num_of_rows=mysqli_num_rows($result_query);
if($num_of_rows==0){
    echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
}


while($row=mysqli_fetch_assoc($result_query)){
$product_id=$row['product_id'];
$product_title=$row['product_title'];
$product_description=$row['product_description'];
$product_image1=$row['product_image1'];
$product_price=$row['product_price'];
$category_id=$row['category_id'];
$brand_id=$row['brand_id'];
echo " <div class='col-sm-6 col-md-6 col-lg-3 mb-4' >
     <div class='card'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
     <p class='card-text'>Price: $product_price/-</p>
  <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Add to Cart</a>

  </div>
</div>
  </div>";
}
}
}

//getting uniqque brands
function get_unique_brands(){
  global $con;
  if(isset($_GET['brand'])){ //aagr hamne kisibhi  brand pe click kia.
    $brand_id=$_GET['brand'];//take out its i'd.
    $select_query="select * from `products` where brand_id=$brand_id";
    $result_query=mysqli_query($con,$select_query);
$num_of_rows=mysqli_num_rows($result_query);
if($num_of_rows==0){
  echo "<h2 class='text-center text-danger'> This brand is not available</h2>";
}
while($row=mysqli_fetch_assoc($result_query)){
  $product_id=$row['product_id'];
$product_title=$row['product_title'];
$product_description=$row['product_description'];
$product_image1=$row['product_image1'];
$product_price=$row['product_price'];
$category_id=$row['category_id'];
$brand_id=$row['brand_id'];
echo " <div class='col-sm-6 col-md-6 col-lg-3 mb-4' >
     <div class='card'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
     <p class='card-text'>Price: $product_price/-</p>
   <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Add to Cart</a>
   
  </div>
</div>
  </div>";
}
}
}

//displaying brands in sidenav
function getbrands(){
    global $con;
    $select_brands="select * from `brands`";
$result_brands=mysqli_query($con,$select_brands);
while($row_data=mysqli_fetch_assoc($result_brands)){
  $brand_title=$row_data['brand_title'];
  $brand_id=$row_data['brand_id'];
echo "<li class='nav-item'>
  <a href='index.php?brand=$brand_id' class='nav-link text-dark'>$brand_title</a>
</li>";
}}

//displaying categories in side nav
function getcategories(){
    global $con;
    $select_categories="select * from `categories`";
$result_category=mysqli_query($con,$select_categories);
while($row_data=mysqli_fetch_assoc($result_category)){
$category_id=$row_data['category_id'];
$category_title=$row_data['category_title'];
echo "<li class='nav-item'>
  <a href='index.php?category=$category_id' class='nav-link text-dark'>$category_title</a>
</li>";
}
}

//searching product function

function search_product(){
      global $con;// use global keyword for declaring $con globally
    if(isset($_GET['search_data_product'])){
      $search_data_value=$_GET['search_data'];
$search_query="select * from `products` where product_keywords like '%$search_data_value%' "; 
$result_query=mysqli_query($con,$search_query);
$num_of_rows=mysqli_num_rows($result_query);
if($num_of_rows==0){
  echo "<h2 class='text-center text-danger'>No results match .No product found on this category!</h2>";
}
while($row=mysqli_fetch_assoc($result_query)){
$product_id=$row['product_id'];
$product_title=$row['product_title'];
$product_description=$row['product_description'];
$product_image1=$row['product_image1'];
$product_price=$row['product_price'];
$category_id=$row['category_id'];
$brand_id=$row['brand_id'];
echo " <div class='col-sm-6 col-md-6 col-lg-3 mb-4' >
     <div class='card'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
<div class='card-body text-center'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
<p class='card-text text-success fw-bold'>₹$product_price</p>
   <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Add to Cart</a>

  </div>
</div>
  </div>";
}
}
}


//view details function //view product by its product id 
function view_details(){  //this run when we click on viewmore
 
    global $con;// use global keyword for declaring $con globally

    //condition to check isset or not
    if(isset($_GET['product_id'])){
    if(!isset($_GET['category'])){ //if anything is not set then it will display the whole data,means agr hamne kisi bhi cheez mai click nhi kara category aur brand m se tab ye pura data dekhega....
if(!isset($_GET['brand'])){
    
  $product_id=$_GET['product_id'];
$select_query="select * from `products` where product_id=$product_id"; //rand() means randomly showing elements on each refresh , limit 0,9 means upto 9 elements can be showed on the page.
$result_query=mysqli_query($con,$select_query);
while($row=mysqli_fetch_assoc($result_query)){
$product_id=$row['product_id'];
$product_title=$row['product_title'];
$product_description=$row['product_description'];
$product_image1=$row['product_image1'];
$product_image2=$row['product_image2'];
$product_image3=$row['product_image3'];
$product_price=$row['product_price'];
$category_id=$row['category_id'];
$brand_id=$row['brand_id'];
echo " <div class='col-sm-6 col-md-6 col-lg-3 mb-4' >
     <div class='card'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
     <p class='card-text'>Price: $product_price/-</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-dark'>Add to Cart</a>
   
  </div>
</div>
  </div>
  <div class='col-md-8'>
<!--related cards-->
<div class='row'>
  <div class='col-md-12'>
    <h4 class='text-center text-info mb-5'>Related Products</h4>
  </div>
  <div class='col-md-6'>
    <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
  </div>
   <div class='col-md-6'>
    <img src='./admin_area/product_images/$product_image3' class='card-img-top' alt='$product_title'>
  </div>
</div>
</div>
  ";
}
}
}
}}
//get  ip address function
function get_client_ip() {
    $ip = '';

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

function get_cart_condition(){
    $user_id = $_SESSION['user_id'] ?? null;
    $ip = get_client_ip();

    if($user_id){
        return "user_id=$user_id";
    } else {
        return "ip_address='$ip'";
    }
}
// echo "Client IP Address: " . get_client_ip();


//cart function 
function cart(){
  global $con;
  if(isset($_GET['add_to_cart'])){
    $ip=get_client_ip();
    $get_product_id=$_GET['add_to_cart'];
    // Get current logged in user ID
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
   $select_query = "SELECT * FROM `cart_details` 
                     WHERE product_id = '$get_product_id' 
                     AND (user_id = '$user_id' OR ip_address = '$ip')";

    $result_query=mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows>0){ //if already present h toh add matt kro cart mai
      echo "<script>alert('This item is already present inside cart')</script>";
echo "<script>window.open('index.php','_self')</script>"; //window will redirect into index page and open in the same tab 
    }
    else{

      $user_id = $_SESSION['user_id']??NULL;
      $insert_query = "INSERT INTO `cart_details` (user_id, product_id, ip_address, quantity)
VALUES (".($user_id ? $user_id : "NULL").", '$get_product_id', '$ip', 1)";
      $result_query=mysqli_query($con,$insert_query);
      if($result_query){
        echo "<script>alert('Item is added to the cart')</script>";
        echo "<script>window.open('index.php','_self')</script>";
      } else {
        echo "<script>alert('Error adding to cart')</script>";
      }
    }
  }

}

//function to get cart item numbers
function cart_item_num(){
if(isset($_GET['add_to_cart'])){
    global $con;
   $condition = get_cart_condition();
$select_query="select * from `cart_details` where $condition";
    $result_query=mysqli_query($con,$select_query);
    $count_cart_items=mysqli_num_rows($result_query);}
    else{
    global $con;
    $ip=get_client_ip();
    $select_query="select * from `cart_details` where ip_address='$ip' ";
    $result_query=mysqli_query($con,$select_query);
    $count_cart_items=mysqli_num_rows($result_query);
    }
    echo $count_cart_items;
  }

  //total price
  function total_cart_price(){
global $con;

$total=0;
 $condition = get_cart_condition();
$cart_query="select * from `cart_details` where $condition";
$result=mysqli_query($con,$cart_query);
while($row=mysqli_fetch_array($result)){
$product_id=$row['product_id'];
//prices arre present inside product table
$select_products="select * from `products` where product_id=$product_id";
$result_products=mysqli_query($con,$select_products);
while($row_product_price=mysqli_fetch_array($result_products)){
  
$total += $row_product_price['product_price'];

//   $product_price=array($row_product_price['product_price']);
//   $product_values=array_sum($product_price);
// $total+=$product_values;
}

}
echo  $total;
  }

  // get user order details
  function get_user_order_details(){
    global $con;
 if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else {
    echo "<script>alert('Please login first');</script>";
    echo "<script>window.open('./user_login.php','_self');</script>";
    exit(); // stop execution
}
     $get_details="select * from `user_table` where  user_id=$user_id";
     $result_query=mysqli_query($con,$get_details);
     while($row_query=mysqli_fetch_array($result_query)){
$user_id=$row_query['user_id'];
if(!isset($_GET['edit_account'])){
  if(!isset($_GET['my_orders'])){
    if(!isset($_GET['delete_account'])){
     $get_orders="select * from `user_orders` where user_id=$user_id and order_status='unpaid'";
   $result_orders_query=mysqli_query($con,$get_orders);
   $row_count=mysqli_num_rows($result_orders_query);
   if($row_count>0){


echo "
<div class='d-flex justify-content-center align-items-center' style='height:60vh;'>

  <div class='card p-5 text-center shadow' style='border-radius:20px; max-width:400px;'>

    <i class='fa-solid fa-clock fa-3x text-warning mb-3'></i>

<h4 class='mb-2'>
  You have 
  <span class='text-danger fw-bold'>$row_count</span> 
  pending ".($row_count == 1 ? "order" : "orders")."
</h4>
    <p class='text-muted'>Your order is placed. Payment will be collected on delivery.</p>

    <a href='profile.php?my_orders' class='btn btn-dark mt-3'>
      View Orders
    </a>

  </div>

</div>
";


  }else{
     echo "
<div class='col-md-9 content-area d-flex justify-content-center align-items-center'>
 <div class='card p-5 text-center border-0' style='max-width:480px; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.08);'>

    <i class='fa-solid fa-box-open fa-3x text-secondary mb-3'></i>

    <h4 class='text-success mb-2'>No Pending Orders</h4>

    <p class='text-muted'>You haven't placed any orders yet.</p>

    <a href='../display_all.php' class='btn btn-dark mt-3 w-100 '>
      Explore Products
    </a>

  </div>
</div>
";
  } 
    }
  }
}
     }
  }
?>
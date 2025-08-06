<?php
//including mysql connection file
// include('./insert/connect.php');
//getting products
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
echo " <div class='col-md-4 mb-2' >
     <div class='card' style='width: 18rem;'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
       <p class='card-text'>Price: $product_price/-</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
     <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
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
echo " <div class='col-md-4 mb-2' >
     <div class='card' style='width: 18rem;'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
     <p class='card-text'>Price: $product_price/-</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
     <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
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
echo " <div class='col-md-4 mb-2' >
     <div class='card' style='width: 18rem;'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
     <p class='card-text'>Price: $product_price/-</p>
  <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
   <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
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
echo " <div class='col-md-4 mb-2' >
     <div class='card' style='width: 18rem;'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
     <p class='card-text'>Price: $product_price/-</p>
   <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
    <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
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
  <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
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
  <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
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
echo " <div class='col-md-4 mb-2' >
     <div class='card' style='width: 18rem;'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
     <p class='card-text'>Price: $product_price/-</p>
   <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
<a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
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
echo " <div class='col-md-4 mb-2' >
     <div class='card' style='width: 18rem;'>
  <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
  <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
     <p class='card-text'>Price: $product_price/-</p>
    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to Cart</a>
     <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
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

// echo "Client IP Address: " . get_client_ip();


//cart function 
function cart(){
  if(isset($_GET['add_to_cart'])){
    global $con;
    $ip=get_client_ip();
    $get_product_id=$_GET['add_to_cart'];
    $select_query="select * from `cart_details` where ip_address='$ip' and product_id=$get_product_id ";
    $result_query=mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows>0){ //if already present h toh add matt kro cart mai
      echo "<script>alert('This item is already present inside cart')</script>";
echo "<script>window.open('index.php','_self')</script>"; //window will redirect into index page and open in the same tab 
    }
    else{
      $insert_query="insert into `cart_details` (product_id,ip_address,quantity) values ($get_product_id,'$ip',1)";
      $result_query=mysqli_query($con,$insert_query);
        echo "<script>alert('Item is added  to  the cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    }
  }

}

//function to get cart item numbers
function cart_item_num(){
if(isset($_GET['add_to_cart'])){
    global $con;
    $ip=get_client_ip();
    $select_query="select * from `cart_details` where ip_address='$ip' ";
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
$ip=get_client_ip();
$total=0;
  $cart_query="select * from `cart_details` where ip_address='$ip'";
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
?>
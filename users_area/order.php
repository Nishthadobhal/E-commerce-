<?php
include('../insert/connect.php');
include('../function/common_function.php');
if(isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
}

//get total items and total price of all items
$get_ip_address=get_client_ip();
 $total_price=0;
$cart_query_price="select * from `cart_details` where ip_address='$get_ip_address'";
$result_cart_price=mysqli_query($con,$cart_query_price);
$invoice_number=mt_rand();
$status='pending';
$count_products=mysqli_num_rows($result_cart_price);
while($row_price=mysqli_fetch_array($result_cart_price)){
    $product_id=$row_price['product_id'];
      $quantity   = $row_price['quantity'];
    $select_product="select * from `products` where product_id=$product_id";
$run_price=mysqli_query($con,$select_product);
$row_product_price = mysqli_fetch_assoc($run_price);
$total_price += $row_product_price['product_price']*$quantity;


//orders pending
$insert_pending_orders="Insert into `orders_pending` (user_id,invoice_number,product_id,quantity,order_status) values($user_id,$invoice_number,$product_id,$quantity,'$status')";
$result_pending_orders=mysqli_query($con,$insert_pending_orders);

}

$subtotal = $total_price;

$insert_orders="Insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) values($user_id,$subtotal,$invoice_number,$count_products,Now(),'$status')";
$result_query=mysqli_query($con,$insert_orders);
if($result_query){
    echo "<script>alert('orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}



//delete item from cart
$empty_cart="Delete from `cart_details` where ip_address='$get_ip_address'";
$result_delete=mysqli_query($con,$empty_cart);
?>

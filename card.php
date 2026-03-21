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
<title>Cart</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

<link rel="stylesheet" href="style.css">

<style>

.cart_img{
width:80px;
height:80px;
object-fit:contain;
}

.cart-container{
background:white;
padding:40px;
border-radius:14px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
margin-top:40px;
margin-bottom:40px;
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






<form action="" method="post">

<div class="container cart-container">
<div class="row">

<table class="table table-bordered text-center align-middle">

<?php

global $con;

$ip=get_client_ip();
$total=0;

$cart_query="select * from `cart_details` where ip_address='$ip'";
$result=mysqli_query($con,$cart_query);

$result_count=mysqli_num_rows($result);

if($result_count>0){

echo "
<thead class='table-light'>
<tr>
<th>Product Title</th>
<th>Product Image</th>
<th>Quantity</th>
<th>Total Price</th>
<th>Remove</th>
<th colspan='2'>Operation</th>
</tr>
</thead>
<tbody>
";

while($row=mysqli_fetch_array($result)){

$product_id=$row['product_id'];
$quantity=$row['quantity'];

$select_products="select * from `products` where product_id=$product_id";
$result_products=mysqli_query($con,$select_products);

while($row_product_price=mysqli_fetch_array($result_products)){

$price_table=$row_product_price['product_price'];
$product_title=$row_product_price['product_title'];
$product_image1=$row_product_price['product_image1'];

$subtotal=$price_table*$quantity;
$total+=$subtotal;

?>

<tr>

<td><?php echo $product_title ?></td>

<td>
<img src="admin_area/product_images/<?php echo $product_image1 ?>" class="cart_img">
</td>

<td>
<input type="number" name="qty[<?php echo $product_id ?>]" 
value="<?php echo $quantity ?>" 
class="form-control w-50 mx-auto">
</td>

<td><?php echo $subtotal ?>/-</td>

<td>
<input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>">
</td>

<td>

<input type="submit" value="Update Cart" name="update_cart" class="btn btn-info">

<input type="submit" value="Remove Cart" name="remove_cart" class="btn btn-danger">

</td>

</tr>

<?php
}
}
}
else{
echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
}

?>

</tbody>
</table>


<!-- UPDATE CART -->

<?php

if(isset($_POST['update_cart']) && isset($_POST['qty'])){

foreach($_POST['qty'] as $product_id=>$qty){

$update_cart="update `cart_details` set quantity=$qty 
where ip_address='$ip' AND product_id=$product_id";

mysqli_query($con,$update_cart);

}

echo "<script>window.open('card.php','_self')</script>";
}

?>


<div class="d-flex justify-content-between align-items-center mt-4">

<?php

$cart_query="select * from `cart_details` where ip_address='$ip'";
$result=mysqli_query($con,$cart_query);
$result_count=mysqli_num_rows($result);

if($result_count>0){

echo "

<h4>
Subtotal:
<strong class='text-info'>$total/-</strong>
</h4>

<div>

<input type='submit' value='Continue Shopping'
name='Continue_Shopping'
class='btn btn-info'>

<a href='users_area/payment.php' class='btn btn-secondary'>
Checkout
</a>

</div>

";

}

else{

echo "
<input type='submit' value='Continue Shopping'
name='Continue_Shopping'
class='btn btn-info'>
";

}

if(isset($_POST['Continue_Shopping'])){
echo "<script>window.open('index.php','_self')</script>";
}

?>

</div>

</div>
</div>

</form>


<?php

function remove_cart_item(){

global $con;

$ip=get_client_ip();

if(isset($_POST['remove_cart']) && isset($_POST['removeitem'])){

foreach($_POST['removeitem'] as $remove_id){

$delete_query="DELETE FROM `cart_details`
WHERE product_id=$remove_id AND ip_address='$ip'";

$run_delete=mysqli_query($con,$delete_query);

if($run_delete){
echo "<script>window.open('card.php','_self')</script>";
}

}

}

}

remove_cart_item();

?>


<!-- FOOTER -->

<div class="bg-dark text-light text-center p-3 mt-4">
<p class="mb-0">© 2026 Cartify | Developed by Nishtha</p>
</div>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
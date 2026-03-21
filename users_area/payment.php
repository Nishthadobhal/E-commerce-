<?php
session_start();
include('../insert/connect.php');
include('../function/common_function.php');

if(!isset($_SESSION['user_id'])){
    echo "<script>alert('Please login first')</script>";
    echo "<script>window.open('user_login.php','_self')</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// 🔥 TOTAL + PRODUCTS
$total = 0;
$condition = get_cart_condition();

$cart_query = "SELECT * FROM cart_details WHERE $condition";
$result = mysqli_query($con,$cart_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="../style.css">
<style>
body{
    background:#f5f7fa;
}

.card{
     max-width: 800px;
    margin: auto;
    border-radius:20px;
    transition:0.3s;
}

.card:hover{
    transform:scale(1.03);
}

.btn:hover{
    transform: scale(1.05);
    transition: 0.2s;
}
h2{
    margin-bottom: 25px;
}
</style>
</head>

<body>

<!-- 🔥 NAVBAR -->
<?php include('../navbar.php'); ?>

<div class="container my-5">

<h2 class="text-center fw-bold mb-4">Payment Options</h2>

<!-- 🔥 ORDER SUMMARY -->
<div class="card p-4 shadow mb-4">
<h4 class="mb-3">Order Summary</h4>

<?php
while($row = mysqli_fetch_array($result)){
    $product_id = $row['product_id'];

    $select_product = "SELECT * FROM products WHERE product_id=$product_id";
    $res = mysqli_query($con,$select_product);

    while($row_product = mysqli_fetch_array($res)){
        $total += $row_product['product_price'];

        echo "
        <div class='d-flex justify-content-between border-bottom py-2'>
            <span>".$row_product['product_title']."</span>
            <span>".$row_product['product_title']." (x".$row['quantity'].")</span>
            <span>₹".$row_product['product_price']."</span>
        </div>";
    }
}
?>
</div>

<!-- 🔥 TOTAL -->
<h3 class="text-center fw-bold my-4">
Total Payable: <span class="text-success fs-2">₹<?php echo $total; ?></span>
</h3>

<?php
if($total == 0){
    echo "<script>alert('Cart is empty')</script>";
    echo "<script>window.open('../index.php','_self')</script>";
}
?>

<!-- 🔥 PAYMENT OPTIONS -->
<div class="row justify-content-center">

<!-- ONLINE -->
<div class="col-md-5 mb-4">
<div class="card p-4 shadow text-center">

<h5><i class="fa-solid fa-credit-card me-2"></i>Online Payment</h5>
<p class="text-muted">UPI / PhonePe / GPay</p>

<a href="pay_online.php" class="btn btn-dark w-100">
Pay Now
</a>

</div>
</div>

<!-- COD -->
<div class="col-md-5 mb-4">
<div class="card p-4 shadow text-center">

<h5><i class="fa-solid fa-money-bill me-2"></i>Cash on Delivery</h5>
<p class="text-muted">Pay at delivery</p>

<a href="payment_success.php?status=unpaid" class="btn btn-outline-dark w-100">
Place Order
</a>

</div>
</div>

</div>

</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</html>


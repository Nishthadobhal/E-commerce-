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
$status = $_GET['status'] ?? 'unpaid';

//  GET CART DATA
$condition = get_cart_condition();
$cart_query = "SELECT * FROM cart_details WHERE $condition";
$result = mysqli_query($con,$cart_query);

$total = 0;
$total_products = 0;

while($row = mysqli_fetch_array($result)){
    $product_id = $row['product_id'];
    $total_products++;

    $select_product = "SELECT * FROM products WHERE product_id=$product_id";
    $res = mysqli_query($con,$select_product);

    while($row_price = mysqli_fetch_array($res)){
        $total += $row_price['product_price'];
    }
}

//  GENERATE INVOICE
$invoice_number = mt_rand();

$_SESSION['final_total'] = $total;
$_SESSION['invoice_no'] = $invoice_number;

//  INSERT ORDER
$insert_order = "INSERT INTO user_orders 
(user_id, amount_due, invoice_number, total_products, order_date, order_status)
VALUES ($user_id, $total, $invoice_number, $total_products, NOW(), '$status')";

$result_order = mysqli_query($con,$insert_order);

// CLEAR CART
$delete_cart = "DELETE FROM cart_details WHERE user_id=$user_id";
mysqli_query($con,$delete_cart);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Payment Success</title>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../style.css">
<style>
body{
    background:#f5f7fa;
}
</style>
</head>

<body>

<?php include('../navbar.php'); ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">

<div class="card p-5 shadow text-center" style="border-radius:20px; max-width:500px;">

<h2 class="text-success mb-3">🎉 Order Placed Successfully!</h2>

<p class="mb-2">Thank you for your purchase.</p>

<p><strong>Invoice No:</strong> <?php echo $_SESSION['invoice_no']; ?></p>
<p><strong>Total Amount:</strong> ₹<?php echo $_SESSION['final_total']; ?></p>

<p>
<strong>Status:</strong> 
<span class="<?php echo ($status=='paid') ? 'text-success' : 'text-warning'; ?>">
<?php echo ucfirst($status); ?>
</span>
</p>

<a href="../index.php" class="btn btn-dark mt-3 w-100">
Continue Shopping
</a>

</div>

</div>
<?php
unset($_SESSION['final_total']);
unset($_SESSION['invoice_no']);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php
include('../insert/connect.php');

// counts
$products = mysqli_num_rows(mysqli_query($con, "SELECT * FROM products"));
$orders = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user_orders"));
$paid = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user_orders WHERE order_status='paid'"));
$unpaid = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user_orders WHERE order_status='unpaid'"));
$users = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user_table"));
?>

<h4 class="mb-4">Dashboard Overview</h4>

<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white text-center p-3 shadow">
            <h6>Total Products</h6>
            <h3><?php echo $products; ?></h3>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white text-center p-3 shadow">
            <h6>Total Orders</h6>
            <h3><?php echo $orders; ?></h3>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white text-center p-3 shadow">
            <h6>Paid Orders</h6>
            <h3><?php echo $paid; ?></h3>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-dark text-center p-3 shadow">
            <h6>Unpaid Orders</h6>
            <h3><?php echo $unpaid; ?></h3>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-dark text-white text-center p-3 shadow">
            <h6>Total Users</h6>
            <h3><?php echo $users; ?></h3>
        </div>
    </div>

</div>
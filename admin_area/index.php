<?php
include('admin_auth.php');
include('../insert/connect.php');
include('../function/common_function.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    overflow-x:hidden;
}
.navbar {
    padding: 14px 20px !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}
/* Sidebar */
.sidebar {
    min-height: 100vh;
    background: linear-gradient(180deg, #1f1f1f, #2c2c2c);
    padding: 20px 15px;
    margin-top: 10px;

     border-radius: 10px;
}

.sidebar a {
    color: #ccc;
    padding: 10px;
    display: block;
    border-radius: 6px;
        margin-bottom: 8px;
    transition: 0.3s;
    text-decoration: none;
}

.sidebar a:hover {
    background-color: #0dcaf0;
    color: #000;
}

.sidebar .btn {
    margin-top: 20px;
}

.sidebar h5 {
    margin-top: 10px;
    margin-bottom: 25px;
}

.card {
    border: none;
    border-radius: 12px;
    transition: 0.3s;
}
.container-fluid {
    margin-top: 10px;
}
.card:hover {
    transform: translateY(-5px);
}

/* Card */
.dashboard-card{
    border-radius: 12px;
}

</style>

</head>
<body>

<!--  NAVBAR -->
<?php

include('./navbar.php');
?>
<!-- MOBILE TOGGLE -->
<nav class="navbar navbar-dark bg-dark d-md-none">
    <div class="container-fluid">
        <span class="navbar-brand">Admin Panel</span>
        <button class="btn btn-outline-light" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
            ☰
        </button>
    </div>
</nav>

<div class="container-fluid">
<div class="row">

    <!--  SIDEBAR -->
    <div class="col-md-2 sidebar p-3 collapse d-md-block" id="sidebarMenu">

        <h5 class="text-white text-center mb-4">Admin Panel</h5>

        <a href="index.php">Dashboard</a>
        <a href="insert_product.php">Insert Products</a>
        <a href="index.php?view_products">View Products</a>
        <a href="index.php?insert_categories">Insert Categories</a>
        <a href="index.php?view_categories">View Categories</a>
        <a href="index.php?insert_brands">Insert Brands</a>
        <a href="index.php?view_brands">View Brands</a>
        <a href="index.php?list_orders">All Orders</a>
        <a href="index.php?list_payments">All Payments</a>
        <a href="index.php?list_users">List Users</a>

        <a href="admin_logout.php" class="btn btn-danger mt-4 w-100">
            Logout
        </a>

    </div>

    <!-- MAIN CONTENT -->
    <div class="col-md-10 p-4">

        <h3 class="mb-4">Manage Details</h3>

        <div class="p-4 ">

        <?php

        //  DEFAULT DASHBOARD
        if(
            !isset($_GET['insert_categories']) &&
            !isset($_GET['insert_brands']) &&
            !isset($_GET['view_products']) &&
            !isset($_GET['edit_products']) &&
            !isset($_GET['delete_product']) &&
            !isset($_GET['view_categories']) &&
            !isset($_GET['view_brands']) &&
            !isset($_GET['edit_category']) &&
            !isset($_GET['delete_category']) &&
            !isset($_GET['edit_brand']) &&
            !isset($_GET['delete_brand']) &&
            !isset($_GET['list_orders']) &&
            !isset($_GET['list_payments']) &&
            !isset($_GET['list_users'])
        ){
            include('dashboard.php');
        }

        // 🔽 ROUTING
        if(isset($_GET['insert_categories'])){
            include('insert_categories.php');
        }

        if(isset($_GET['insert_brands'])){
            include('insert_brands.php');
        }

        if(isset($_GET['view_products'])){
            include('view_products.php');
        }

        if(isset($_GET['edit_products'])){
            include('edit_products.php');
        }

        if(isset($_GET['delete_product'])){
            include('delete_product.php');
        }

        if(isset($_GET['view_categories'])){
            include('view_categories.php');
        }

        if(isset($_GET['view_brands'])){
            include('view_brands.php');
        }

        if(isset($_GET['edit_category'])){
            include('edit_category.php');
        }

        if(isset($_GET['delete_category'])){
            include('delete_category.php');
        }

        if(isset($_GET['edit_brand'])){
            include('edit_brand.php');
        }

        if(isset($_GET['delete_brand'])){
            include('delete_brand.php');
        }

        if(isset($_GET['list_orders'])){
            include('list_orders.php');
        }

        if(isset($_GET['delete_order'])){
    $delete_id = (int) $_GET['delete_order'];

    $delete_query = "DELETE FROM `user_orders` WHERE order_id=$delete_id";
    $result = mysqli_query($con, $delete_query);

    if($result){
        echo "<script>alert('Order deleted successfully')</script>";
        echo "<script>window.open('index.php?list_orders','_self')</script>";
    }
}

        if(isset($_GET['list_payments'])){
            include('list_payments.php');
        }

if(isset($_GET['delete_payment'])){
    $delete_id = (int) $_GET['delete_payment'];

    $delete_query = "DELETE FROM user_payments WHERE payment_id=$delete_id";
    mysqli_query($con, $delete_query);

    echo "<script>alert('Payment deleted successfully')</script>";
    echo "<script>window.location.href='index.php?list_payments'</script>";
}

        if(isset($_GET['list_users'])){
            include('list_users.php');
        }

        if(isset($_GET['delete_user'])){
    $delete_id = (int) $_GET['delete_user'];

    $delete_query = "DELETE FROM user_table WHERE user_id=$delete_id";
    mysqli_query($con, $delete_query);

    echo "<script>alert('User deleted successfully')</script>";
    echo "<script>window.location.href='index.php?list_users'</script>";
}
        ?>

        </div>

    </div>

</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>
<?php 
include('../insert/footer.php')
?>
</html>
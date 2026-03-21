<?php
include('../insert/connect.php');
include('../function/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<!-- Main CSS -->
<link rel="stylesheet" href="../style.css">

<style>
body{
    background:#f5f7fa;
    overflow-x:hidden;
}

/* SIDEBAR */
.sidebar {
      margin-top: 0;
    background: #6c757d;
   height: calc(100vh - 140px);
    border-radius: 10px;
    padding: 20px;
}

.sidebar-link {
    display: block;
    padding: 10px 15px;
    margin: 6px 0;
    color: #ddd;
    text-decoration: none;
    border-radius: 6px;
    transition: 0.3s;
}

.sidebar-link:hover {
    background: #2c2c2c;
    color: #fff;
}

.sidebar-link.active {
    background: #0d6efd;
    color: white;
}
.bg-light {
    padding: 10px 0 !important;
}

/* CARD CENTER */
.content-area {
     min-height: calc(100vh - 200px);
       padding-bottom: 30px;
}
</style>

</head>

<body>

<!-- NAVBAR -->
<?php include('../navbar.php'); ?>

<?php cart(); ?>

<!-- PAGE TITLE -->
<div class="bg-light py-2 text-center">
<h4>My Account</h4>
<p class="mb-0 text-muted">Manage your profile & orders</p>
</div>

<!-- MAIN LAYOUT -->
<div class="container-fluid  mt-0 mb-5">
<div class="row">

<!-- 🔥 SIDEBAR -->
<div class="col-md-3">
<div class="sidebar">

<h5 class="text-center text-light mb-3">My Account</h5>

<div class="text-center mb-4">
<i class="fa-solid fa-user-circle fa-4x text-light"></i>
<p class="text-light mt-2"><?php echo $_SESSION['username']; ?></p>
</div>

<a href="profile.php" class="sidebar-link <?php if(!isset($_GET['edit_account']) && !isset($_GET['my_orders']) && !isset($_GET['delete_account'])) echo 'active'; ?>">
📦 Pending Orders
</a>

<a href="profile.php?edit_account" class="sidebar-link <?php if(isset($_GET['edit_account'])) echo 'active'; ?>">
✏️ Edit Profile
</a>

<a href="profile.php?my_orders" class="sidebar-link <?php if(isset($_GET['my_orders'])) echo 'active'; ?>">
🛒 My Orders
</a>

<a href="profile.php?delete_account" class="sidebar-link text-danger <?php if(isset($_GET['delete_account'])) echo 'active'; ?>">
🗑 Delete Account
</a>

<a href="logout.php" class="sidebar-link text-warning">
🚪 Logout
</a>

</div>
</div>

<!-- 🔥 CONTENT -->
<div class="col-md-9 d-flex justify-content-center align-items-center content-area">

<?php
get_user_order_details();

if(isset($_GET['edit_account'])){
    include('edit_account.php');
}

if(isset($_GET['my_orders'])){
    include('user_orders.php');
}

if(isset($_GET['delete_account'])){
    include('delete_account.php');
}
?>

</div>

</div>
</div>

<!-- FOOTER -->
<?php include('../insert/footer.php'); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
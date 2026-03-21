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
<title>User Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
body{
    background:#f5f7fa;
}
.card{
    border-radius:16px;
}
.card label {
    font-weight: 600;
    margin-bottom: 8px; 
    color: #000;         
}

.form-control {
    margin-top: 4px;    
}
.card input:focus {
    box-shadow: none;
    border-color: #000;
}
</style>
</head>

<body>

<!-- ✅ NAVBAR ADD -->
<?php include('../navbar.php'); ?>

<div class="container mt-4">
<h2 class="text-center mb-3">User Login</h2>

<div class="d-flex justify-content-center">
<div class="card p-4 shadow" style="width:500px;">

<form method="POST">

<!-- EMAIL -->
<div class="mb-3">
<label>Email</label>
<input type="email" class="form-control"
placeholder="enter email"
required name="user_email">
</div>

<!-- PASSWORD -->
<div class="mb-3">
<label>Password</label>
<input type="password" class="form-control"
placeholder="enter password"
required name="user_password">
</div>

<!-- BUTTON -->
<div class="mt-3">
<input type="submit"
class="btn btn-dark w-100"
name="user_login"
value="Login">

<p class="small fw-bold mt-2 text-center">
Don't have an account?
<a href="user_registration.php" class="text-danger">Register</a>
</p>
</div>

</form>

</div>
</div>
</div>

</body>
</html>

<?php
if(isset($_POST['user_login'])){

$user_email = $_POST['user_email'];  // ✅ email now
$user_password = $_POST['user_password'];

$select_query = "SELECT * FROM user_table WHERE user_email='$user_email'";
$result = mysqli_query($con,$select_query);

$row_count = mysqli_num_rows($result);
$row_data = mysqli_fetch_assoc($result);
$user_id = $row_data['user_id'];
$user_ip = get_client_ip();
//  MERGE CART
$update_cart = "UPDATE cart_details 
SET user_id=$user_id 
WHERE ip_address='$user_ip' AND user_id IS NULL";

mysqli_query($con, $update_cart);
// cart check
$select_query_cart = "SELECT * FROM cart_details WHERE ip_address='$user_ip'";
$select_cart = mysqli_query($con,$select_query_cart);
$row_count_cart = mysqli_num_rows($select_cart);

if($row_count > 0){

    if(password_verify($user_password,$row_data['password'])){

        $_SESSION['user_id'] = $row_data['user_id'];
        $_SESSION['username'] = $row_data['username'];

        echo "<script>alert('Login successful')</script>";

        if($row_count_cart == 0){
            echo "<script>window.open('profile.php','_self')</script>";
        } else {
            echo "<script>window.open('payment.php','_self')</script>";
        }

    } else {
        echo "<script>alert('Invalid password')</script>";
    }

}else{
    echo "<script>alert('Email not registered')</script>";
}
}
?>
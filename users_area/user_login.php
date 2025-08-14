
<?php
include('../insert/connect.php');
include('../function/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- bootstrap css link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<style>
    body{
        overflow-x:hidden;
    }
</style>
    </head>
<body>
    <div class="container-fluid my-3">
        <h2 class='text-center'>User Login</h2>
        <div class="row d-flex align-items-center justify-content-center  mt-5" >
            <div class='col-lg-12 col-xl-6'>
<form action="" method="POST" enctype='multipart/form-data'>
    <!-- username -->
<div class="form-outline mb-4">
    <label for="user_username" class="form-label">
Username
    </label>
    <input type="text" id="user_username" class="form-control"
    placeholder="enter username" autocomplete="off" required="required" 
    name="user_username">
</div>
   <!--password -->
<div class="form-outline mb-4">
    <label for="user_password" class="form-label">
Password
    </label>
    <input type="password" id="user_password" class="form-control"
    placeholder="enter password"  required="required" 
    name="user_password">
</div>
<!-- submit button -->
<div class="mt-4 pt-2">
    <input type="submit" class="bg-info py-2 px-3 border-0" name="user_login">
<p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?<a href="user_registration.php" class="text-danger">Register</a></p>
</div>

</form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['user_login'])){
$user_username=$_POST['user_username'];
$user_password=$_POST['user_password'];

$select_query="select * from `user_table` where username='$user_username'";
$result=mysqli_query($con,$select_query);
$row_count=mysqli_num_rows($result);
$row_data=mysqli_fetch_assoc($result);
$user_ip=get_client_ip();

//cart items
$select_query_cart="select * from `cart_details` where ip_address='$user_ip' ";
$select_cart=mysqli_query($con,$select_query_cart);
$row_count_cart=mysqli_num_rows($select_cart);
if($row_count>0){  //if the user is present
       $_SESSION['username']=$username;
    //data prsenet in db
if(password_verify($user_password,$row_data['password'])){
    if($row_count==1 and $row_count_cart==0){   //if the user don't have anything in the cart
   $_SESSION['username']=$username;
        echo "<script>alert('login successfuly')</script>";
echo "<script>window.open('profile.php','_self')</script>";
}else{
       $_SESSION['username']=$username;
    echo "<script>alert('login successfuly')</script>";
echo "<script>window.open('payment.php','_self')</script>";
}
}

else{
  echo "<script>alert('invalid credentials')</script>";  
}
}else{
//not present in db
echo "<script>alert('invalid credentials')</script>";

}

}
?>
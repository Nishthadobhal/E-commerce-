<?php
session_start();
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
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class='text-center'>New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center" >
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
    <!-- email -->
<div class="form-outline mb-4">
    <label for="user_email" class="form-label">
Email
    </label>
    <input type="email" id="user_email" class="form-control"
    placeholder="enter email" autocomplete="on" required="required" 
    name="user_email">
</div>
   <!-- image -->
<div class="form-outline mb-4">
    <label for="user_email" class="form-label">
 User Image
    </label>
    <input type="file" id="user_image" class="form-control" 
    name="user_image">
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
   <!--confirm user password -->
<div class="form-outline mb-4">
    <label for="conf_user_password" class="form-label">
Confirm User Password
    </label>
    <input type="password" id="conf_user_password" class="form-control"
    placeholder="enter password"  required="required" 
    name="conf_user_password">
</div>
   <!-- address -->
<div class="form-outline mb-4">
    <label for="user_address" class="form-label">
Address
    </label>
    <input type="text" id="user_address" class="form-control"
    placeholder="enter your address" autocomplete="on" required="required" 
    name="user_address">
</div>
   <!-- contact -->
<div class="form-outline mb-4">
    <label for="user_email" class="form-label">
Contact
    </label>
    <input type="number" id="user_contact" class="form-control"
    placeholder="enter mobile number" autocomplete="on" required="required" 
    name="user_contact">
</div>
<!-- submit button -->
<div class="mt-4 pt-2">
    <input type="submit" class="bg-info py-2 px-3 border-0" name="user_register">
<p class="small fw-bold mt-2 pt-1 mb-0">Already have an account?<a href="user_login.php" class="text-danger"> Login</a></p>
</div>

</form>
            </div>
        </div>
    </div>
</body>
</html>

<!--php code-->
<?php
if(isset($_POST['user_register'])){
$username=$_POST['user_username'];
$user_email=$_POST['user_email'];
$user_password=$_POST['user_password'];
//for storing password in encrypted form
//but we can't now use the databse password to login ...bcoz its value is different
$hash_password=password_hash($user_password,PASSWORD_DEFAULT);
$conf_user_password=$_POST['conf_user_password'];
$user_address=$_POST['user_address'];
$user_contact=$_POST['user_contact'];
$user_image=$_FILES['user_image']['name'];
$user_image_tmp=$_FILES['user_image']['tmp_name'];
$user_ip= get_client_ip();

//select query
$select_query="select * from `user_table` where user_email = '$user_email' 
   OR user_mobile = '$user_contact'";
$result=mysqli_query($con,$select_query);
$rows_count=mysqli_num_rows($result);
if($rows_count>0){ //data is already present in database
    echo "<script>alert('User with same email or mobile already exists!')</script>";
}else if($conf_user_password!=$user_password){
  echo "<script>alert('Password  don't match')</script>";
}
else{
  
move_uploaded_file($user_image_tmp,"./user_images/$user_image");
$insert_query="insert into `user_table` (username,password,user_email,user_image,user_ip,user_address,user_mobile)
values ('$username','$hash_password','$user_email','$user_image','$user_ip','$user_address','$user_contact')";

$sql_execute=mysqli_query($con,$insert_query);
if($sql_execute){
    echo "<script>alert('Data inserted successfully')</script>";
}else{
    die(mysqli_error($con));
}
}



//selecting cart items - if user is not logged in
$select_cart_items="select * from  `cart_details` where 
ip_address='$user_ip'";
$result_cart=mysqli_query($con,$select_cart_items);
$rows_count=mysqli_num_rows($result_cart);
if($rows_count>0){
    $_SESSION['username']=$username;
    echo "<script>alert('you have items in your cart')</script>";
echo "<script>window.open('checkout.php','_self ')</script>";
}else{
   echo "<script>alert('../index.php','_self ')</script>"; 
}


}
?>
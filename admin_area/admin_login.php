
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
        <h2 class='text-center'>Admin Login</h2>
        <div class="row d-flex align-items-center justify-content-center  mt-5" >
            <div class='col-lg-12 col-xl-6'>
<form action="" method="POST" enctype='multipart/form-data'>
    <!-- username -->
<div class="form-outline mb-4">
    <label for="admin_name" class="form-label">
admin name
    </label>
    <input type="text" id="admin_name" class="form-control"
    placeholder="enter admin name" autocomplete="off" required="required" 
    name="admin_name">
</div>
   <!--password -->
<div class="form-outline mb-4">
    <label for="password" class="form-label">
Password
    </label>
    <input type="password" id="password" class="form-control"
    placeholder="enter password"  required="required" 
    name="password">
</div>
<!-- submit button -->
<div class="mt-4 pt-2">
    <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login">
</div>

</form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if(isset($_POST['admin_login'])){
    $name = $_POST['admin_name'];
    $password = $_POST['password'];

    $select_query = "SELECT * FROM admin WHERE admin_username='$name'";
    $result = mysqli_query($con, $select_query);

    if(mysqli_num_rows($result) > 0){
        $row_data = mysqli_fetch_assoc($result);

        if(password_verify($password, $row_data['admin_password'])){
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_name'] = $name;

            echo "<script>alert('Login successful')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid credentials')</script>";
    }
}
?>

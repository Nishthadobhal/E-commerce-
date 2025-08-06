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
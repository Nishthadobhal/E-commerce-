<?php
include('../insert/connect.php');
include('../function/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>
     <!-- bootstrap css link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<style>
    img{
        width: 100%;
    }
</style>
    </head>

<body>
<!--php code to access user id-->
<?php
$user_ip= get_client_ip();
$get_user="select * from `user_table` where user_ip='$user_ip'";
$result=mysqli_query($con,$get_user);
$run_query=mysqli_fetch_array($result);
$user_id=$run_query['user_id'];

?>
   <div class="container">
    <h2 class="text-center text-info">payment Options</h2>
    <div class="row d-flex justify-content-center align-items-center my-5">
    <div class="col-md-6">
<a href="https://www.phonepay.com"><img src="upi.jpg" alt=""></a>
    </div>
         <div class="col-md-6">
<a href="order.php?user_id=<?php echo $user_id?>"><h2  class="text-center">Pay offline</h2></a>
    </div>
    </div>
   </div>
</body>
</html>
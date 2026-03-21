<?php
session_start();

if(!isset($_SESSION['user_id'])){
    echo "<script>alert('Please login first')</script>";
    echo "<script>window.open('user_login.php','_self')</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Processing Payment</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f7fa;
}

.loader {
  border: 6px solid #f3f3f3;
  border-top: 6px solid #212529;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 1s linear infinite;
  margin: auto;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">

<div class="card p-5 shadow text-center" style="border-radius:20px; width:400px;">

<div class="loader mb-4"></div>

<h4 class="mb-2">Processing Payment...</h4>
<p class="text-muted">Please do not refresh this page</p>

</div>

</div>

<!-- 🔥 AUTO REDIRECT AFTER 3 SECONDS -->
<script>
setTimeout(function(){
    window.location.href = "payment_success.php?status=paid";
}, 2000);
</script>

</body>
</html>
<?php
include('../insert/connect.php');
if(isset($_POST['insert_brand'])){
  $brand_tit=$_POST['brand_title'];//iske andr vo ayega jo ham dalna chhate hai brand ke andr
  //if vo brandd alreaady present ho
  $query="select * from `brands` where brand_title='$brand_tit'";
  $result2=mysqli_query($con,$query);
$number=mysqli_num_rows($result2);
  if($number>0)
{
echo "<script>alert('data already present in database') </script>";
}
  else{
  //query likhni hai jo database ke andr dalegi value ko
$insert_query="insert into `brands` (brand_title) values ('$brand_tit')";
$result=mysqli_query($con,$insert_query);
if($result){
  //added js
  echo "<script> alert('data has been entered succesfully') </script>";
}
}
}

?>

<h2 class="text-center">Insert Brands</h2>

<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info"><i class="fa-solid fa-receipt"></i></span>
    <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands"
    aria-label="Brands" aria-describedby="basic-addon1">
</div>

<div class="input-group w-10 mb-2 m-auto">
  <!-- <input type="submit" class="form-control bg-info" name="insert_cat"  value="Insert Categories"
    aria-label="username" aria-describedby="basic-addon1" class="bg-info"> -->
 
<button type="submit" name="insert_brand"  value="Insert brand"  class="bg-info p-2 my-3 border-0 ">Insert Brands</button>
</div>
</form>
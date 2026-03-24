<?php
include('../insert/connect.php');

include('admin_auth.php');
if(isset($_POST['insert_brand'])){
  $brand_tit=$_POST['brand_title'];//iske andr vo ayega jo ham dalna chhate hai brand ke andr
  //if vo brandd alreaady present ho
  $query="select * from `brands` where brand_title='$brand_tit'";
  $result2=mysqli_query($con,$query);
$number=mysqli_num_rows($result2);
 if($number>0){
  echo "<script>alert('Brand already exists')</script>";
  echo "<script>window.location.href='insert_product.php';</script>";
}
  else{
  //query likhni hai jo database ke andr dalegi value ko
$insert_query="insert into `brands` (brand_title) values ('$brand_tit')";
$result=mysqli_query($con,$insert_query);
if($result){
  echo "<script>alert('Brand added successfully')</script>";
  echo "<script>window.location.href='insert_product.php';</script>";
}
}
}

?>

<div class="d-flex justify-content-center mt-4">

    <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%; border-radius: 14px;">

        <h4 class="text-center mb-4">Add New Brand</h4>

        <form action="" method="post">

            <div class="mb-3">
                <label class="form-label">Brand Name</label>
                <input type="text" 
                       class="form-control py-2" 
                       name="brand_title" 
                       placeholder="Enter brand name" 
                       required>
            </div>

            <button type="submit" name="insert_brand" class="btn btn-dark w-100 py-2 mt-2">
                Add Brand
            </button>

        </form>

    </div>

</div>
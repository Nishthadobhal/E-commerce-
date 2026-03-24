<?php
include('admin_auth.php');
if(isset($_GET['edit_brand'])){
    $edit_brand = $_GET['edit_brand'] ?? null;
$edit_brand=$_GET['edit_brand'];
$get_brand="Select * from `brands` where brand_id=$edit_brand";
$result=mysqli_query($con,$get_brand);
$row=mysqli_fetch_assoc($result);
$brand_title=$row['brand_title'];

}
if(isset($_POST['edit_brd'])){
$brd_title=$_POST['brand_title'];

if($brd_title==''){
    echo "<script>alert('Brand title cannot be empty')</script>";
}
else{
    $update_query="update `brands` set brand_title='$brd_title' where brand_id=$edit_brand";
    $result_brd=mysqli_query($con,$update_query);

    if($result_brd){
        echo "<script>alert('Brand updated successfully')</script>";
        echo "<script>window.open('index.php?view_brands','_self')</script>";
    }
}


}
?>
<div class="d-flex justify-content-center mt-4">

<div class="card shadow p-4" style="max-width: 450px; width: 100%; border-radius: 12px;">

    <h4 class="text-center mb-4">Edit Brand</h4>

    <form action="" method="post">

        <div class="mb-3">
            <label class="form-label">Brand Title</label>
            <input type="text" 
                   name="brand_title" 
                   class="form-control"
                   value="<?php echo $brand_title ?>" 
                   required>
        </div>

        <button class="btn btn-dark w-100 py-2" name="edit_brd">
            Update Brand
        </button>

    </form>

</div>

</div>
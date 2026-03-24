<?php
include('admin_auth.php');
if(isset($_GET['edit_products'])){
    $edit_id=$_GET['edit_products'];
    
    $get_data="Select * from `products` where product_id=$edit_id";
$result=mysqli_query($con,$get_data);
$row=mysqli_fetch_assoc($result);
$product_title=$row['product_title'];
$product_description=$row['product_description'];
$product_keywords=$row['product_keywords'];
$category_id=$row['category_id'];
$brand_id=$row['brand_id'];
$product_image1=$row['product_image1'];

$product_price=$row['product_price'];
}

//fetching category name
$select_category="select *  from `categories` where category_id=$category_id";
$result_category=mysqli_query($con,$select_category);
$row_category=mysqli_fetch_assoc($result_category);
$category_title=$row_category['category_title'];

//fetching barnd name
$select_brand="select *  from `brands` where brand_id=$brand_id";
$result_brand=mysqli_query($con,$select_brand);
$row_brand=mysqli_fetch_assoc($result_brand);
$brand_title=$row_brand['brand_title'];


?>

<div class="d-flex justify-content-center mt-2">

<div class="card shadow-lg p-4" style="max-width: 500px; width: 100%; border-radius: 12px;">

<h4 class="text-center mb-4">Edit Product</h4>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-outline w-100 m-auto mb-4">
<label for="product_title" class="form-label mb-1">Product Title</label>
<input type="text" id="product_title" name="product_title" class="form-control" value="<?php  echo $product_title ?>" required="required">
    </div>

 <div class="form-outline w-100 m-auto mb-4">
<label for="product_title" class="form-label mb-1">Product Description</label>
<input type="text" id="product_desc" name="product_desc" class="form-control" value="<?php  echo $product_description ?>" required="required">
    </div>

 <div class="form-outline w-100 m-auto mb-4">
<label for="product_keywords" class="form-label">Product Keywords</label>
<input type="text" id="product_keywords" name="product_keywords" class="form-control"  value="<?php  echo $product_keywords ?>" required="required">
    </div>

 <div class="form-outline w-100 m-auto mb-4">
    <label for="product_category" class="form-label">Product Categories</label>
<select name="product_category" class="form-select">
<option value="<?php echo $category_id ?>"><?php echo $category_title ?></option>
<?php
$select_category_all="select *  from `categories`";
$result_category_all=mysqli_query($con,$select_category_all);
while($row_category_all=mysqli_fetch_assoc($result_category_all)){
$category_title=$row_category_all['category_title'];
$category_id=$row_category_all['category_id'];
echo "<option value='$category_id'>$category_title</option>";
};

?>
</select>
    </div>

     <div class="form-outline w-100 m-auto mb-4">
    <label for="product_brands" class="form-label">Product Brands</label>
<select name="product_brands" class="form-select">
<option value="<?php echo $brand_id ?>"><?php echo $brand_title ?></option>
<?php
$select_brand_all="select * from `brands`";
$result_brand_all=mysqli_query($con,$select_brand_all);
while($row_brand_all=mysqli_fetch_assoc($result_brand_all)){
    $brand_title=$row_brand_all['brand_title'];
    $brand_id=$row_brand_all['brand_id'];
    echo "<option value='$brand_id'>$brand_title</option>";
}


?>
</select>
    </div>

     <div class="form-outline w-100 m-auto mb-4">
<label for="product_images1" class="form-label">Product Image1</label>
<div class="d-flex align-items-center gap-2">
<input type="file" id="product_iamge1" name="product_image1" class="form-control">
<img src="./product_images/<?php echo $product_image1 ?>" 
     style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;">
</div>
    </div>

  
  


 <div class="form-outline w-100 m-auto mb-4">
<label for="product_price" class="form-label">Product Price</label>
<input type="text" id="product_price" name="product_price" class="form-control" value="<?php echo $product_price
 ?>" required="required">
    </div>


 <div class="w-100 m-auto">
<input type="submit"  name="edit_product"  value="update product" class="btn btn-dark w-100 py-2"">
    </div>
</form>
</div>
</div>


<?php
if(isset($_POST['edit_product'])){

$product_image1 = $_FILES['product_image1']['name'];
$temp_image1 = $_FILES['product_image1']['tmp_name'];
    $product_title=$_POST['product_title'];
      $product_desc=$_POST['product_desc'];
  $product_keywords=$_POST['product_keywords'];
  $product_category=$_POST['product_category'];
  $product_brands=$_POST['product_brands'];
    $product_price=$_POST['product_price'];

    

if($product_title=='' or $product_desc=='' or $product_keywords=='' or $product_price==''){
    echo "<script>alert('Please fill title, desc, keywords & price')</script>";
}

else{
    
  
//update query
$update_product="update `products` set 
product_title='$product_title',
product_description='$product_desc',
product_keywords='$product_keywords',
product_price='$product_price',
category_id='$product_category',
brand_id='$product_brands',
date=NOW()";

if($product_image1 != ''){
    move_uploaded_file($temp_image1, "./product_images/$product_image1");
    $update_product .= ", product_image1='$product_image1'";
}


// Finish query with ID
$update_product .= " where product_id=$edit_id";


$result_update=mysqli_query($con,$update_product);
if($result_update){
     echo "<script>alert('Product updated successfully')</script>";
      echo "<script>window.open('index.php?view_products','_self')</script>";
}
}


}
?>
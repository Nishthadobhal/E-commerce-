<?php
include('../insert/connect.php');

if(isset($_POST['insert_product'])){
    $product_title=$_POST['product_title'];
     $description=$_POST['description'];
      $product_keywords=$_POST['product_keywords'];
 $product_category=$_POST['product_category'];
  $product_brands=$_POST['product_brands'];
 $product_price=$_POST['product_price'];
 $product_status="true";

 //accessing images
  $product_image1=$_FILES['product_image1']['name'];
   $product_image2=$_FILES['product_image2']['name'];
    $product_image3=$_FILES['product_image3']['name'];


    //accessing image tmp name
  $temp_image1=$_FILES['product_image1']['tmp_name'];
   $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

 //checking empty condition
if($product_title=='' or $description=='' or $product_keywords=='' or $product_category=='' or $product_brands=='' or $product_price=='' or  
$product_image1=='' or $product_image2=='' or $product_image3==''){
    echo "<script>alert('please fill all the fields') </script>";
    exit();
}
else{
    //move all images in 1 folder
    move_uploaded_file($temp_image1,"./product_images/$product_image1");
move_uploaded_file($temp_image2,"./product_images/$product_image2");
move_uploaded_file($temp_image3,"./product_images/$product_image3");


//insert query
$insert_products="insert into `products` (product_title,product_description,product_keywords,
category_id,brand_id,product_image1,product_image2,product_image3,product_price,date,status) values ('$product_title','$description','$product_keywords',
'$product_category','$product_brands','$product_image1','$product_image2','$product_image3','$product_price',NOW(),'$product_status') ";
$result_query=mysqli_query($con,$insert_products);
if($result_query){
    echo "succesfully inserted products";
}

}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>
    <!--bootstrap css link-->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
     <!--css file link-->
<link href="../style.css" rel="stylesheet">
<!--font awesome link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="bg-light">
        <div class="container mt-3"> <!--mt-margin top-->
            <h1 class="text-center">Insert Products</h1>
<!--forms-->
<form action="" method="post" enctype="multipart/form-data">
<div  class="form-outline mb-4 w=50 m-auto">
    <label for="product_title" class="form-label">Product title</label>
    <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off"
    required="required">
</div>

<!--description-->
<div class="form-outline mb-4 w=50 m-auto">
    <label for="Description" class="form-label">Product Description</label>
    <input type="text" name="description" id="description" class="form-control" placeholder="Enter product Description" autocomplete="off"
    required="required">
</div>

<!--product keyword-->
<div class="form-outline mb-4 w=50 m-auto">
    <label for="Product_keywords" class="form-label">Product keywords</label>
    <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off"
    required="required">
</div>

<!--categories-->
<div class="form-outline mb-4 w=50 m-auto">
    <select name="product_category" id="" class="form-select">
        <option value="">select a category </option>
        <?php
$select_query="select * from `categories`";
$result_query=mysqli_query($con,$select_query);
while($row=mysqli_fetch_assoc($result_query)){
    $category_title=$row['category_title'];
    $category_id=$row['category_id'];
echo "<option value='$category_id'>$category_title</option>";
}

?>
        <!-- <option value="">category1</option>
         <option value="">category2</option> -->
    </select>
</div>


<!--brands-->
<div class="form-outline mb-4 w=50 m-auto">
    <select name="product_brands" id="" class="form-select">
        <option value="">select a brand </option>

        <?php
$select_query2="select * from `brands`";
$result_query2=mysqli_query($con,$select_query2);
while($row2=mysqli_fetch_assoc($result_query2)){
    $brand_id=$row2['brand_id'];
    $brand_title=$row2['brand_title'];
    echo " <option value='$brand_id'>$brand_title</option>";
}
        ?>
        <!-- <option value="">brand 1</option>
         <option value="">brand 2</option> -->
    </select>
</div>


<!--image 1-->
<div class="form-outline mb-4 w=50 m-auto">
    <label for="Product_image1" class="form-label">Product image 1</label>
    <input type="file" name="product_image1" id="product_image1" class="form-control" 
    required="required">
</div>


<!--image 2-->
<div class="form-outline mb-4 w=50 m-auto">
    <label for="Product_image2" class="form-label">Product image 2</label>
    <input type="file" name="product_image2" id="product_image2" class="form-control" 
    required="required">
</div>


<!--image 3-->
<div class="form-outline mb-4 w=50 m-auto">
    <label for="Product_image3" class="form-label">Product image 3</label>
    <input type="file" name="product_image3" id="product_image3" class="form-control" 
    required="required">
</div>

<!--price-->
<div class="form-outline mb-4 w=50 m-auto">
    <label for="Product_price" class="form-label">Product price
    </label>
    <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off"
    required="required">
</div>


<!--input field-->
<div class="form-outline mb-4 w=50 m-auto">
    <input type="submit" name="insert_product" class="btn btn-info  mb-3 px-3" value="Insert Products">
</div>


</form>
        </div>
    </div>
</body>
</html>
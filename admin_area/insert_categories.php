<?php
include('../insert/connect.php');
if(isset($_POST['insert_cat'])){
  $category_title=$_POST['cat_title'];

  //select data from databse
  $select_query="select * from `categories` where category_title='$category_title'";
$result_select=mysqli_query($con,$select_query);
$number=mysqli_num_rows($result_select); 
if($number>0){
  echo "<script>alert('thiss category is preseent in the database') </script>";
}
else{
  $insert_query="insert into `categories` (category_title) values ('$category_title') ";
$result=mysqli_query($con,$insert_query);
if($result){
  echo "<script>alert('category has been inserted succesfully') </script>";
}
}
}
?>
<h2 class="text-center">
    Insert Categories
</h2>

<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
    <span class="input-group-text bg-info"><i class="fa-solid fa-receipt"></i></span>
    <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories">
</div>

<div class="input-group w-10 mb-2 m-auto">
  <input type="submit" class=" bg-info border-0 p-2 my-3" name="insert_cat"  value="Insert Categories">
<!--  
<button class="bg-info p-2 my-3 border-0">Insert Categories</button> -->
</div>
</form>
<?php
include('../insert/connect.php');
include('admin_auth.php');
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
<div class="d-flex justify-content-center mt-4">

    <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%; border-radius: 14px;">

        <h4 class="text-center mb-4">Add New Category</h4>

        <form action="" method="post">

            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" 
                       class="form-control py-2" 
                       name="cat_title" 
                       placeholder="Enter category name" 
                       required>
            </div>

            <button type="submit" name="insert_cat" class="btn btn-dark w-100 py-2 mt-2">
                Add Category
            </button>

        </form>

    </div>

</div>
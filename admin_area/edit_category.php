<?php
include('admin_auth.php');
if(isset($_GET['edit_category'])){
$edit_category=$_GET['edit_category'];
$get_category="Select * from `categories` where category_id=$edit_category ";
$result=mysqli_query($con,$get_category);
$row=mysqli_fetch_assoc($result);
$category_title=$row['category_title'];

}
if(isset($_POST['edit_cat'])){
$cat_title=$_POST['category_title'];
$update_query="update `categories` set category_title='$cat_title' where 
category_id=$edit_category ";
$result_cat=mysqli_query($con,$update_query);
if($result_cat){
     echo "<script>alert('category updated successfully')</script>";
      echo "<script>window.open('./index.php?view_categories','_self')</script>";
}
}
?>
<div class="d-flex justify-content-center mt-4">

<div class="card shadow p-4" style="max-width: 450px; width: 100%; border-radius: 12px;">

    <h4 class="text-center mb-4">Edit Category</h4>

    <form action="" method="post">

        <div class="mb-3">
            <label class="form-label">Category Title</label>
            <input type="text" 
                   name="category_title" 
                   class="form-control"
                   value="<?php echo $category_title ?>" 
                   required>
        </div>

        <button class="btn btn-dark w-100 py-2" name="edit_cat">
            Update Category
        </button>

    </form>

</div>

</div>
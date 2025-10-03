<?php
if(isset($_GET['edit_account'])){
    $user_session_id=$_SESSION['user_id'];
    $select_query="select * from `user_table` where user_id=$user_session_id";
$result_query=mysqli_query($con,$select_query);
$row_fetch=mysqli_fetch_assoc($result_query);
$user_id=$row_fetch['user_id'];
$username=$row_fetch['username'];
$user_email=$row_fetch['user_email'];
$user_image=$row_fetch['user_image'];
$user_address=$row_fetch['user_Address'];
$user_mobile=$row_fetch['user_mobile'];
}

if(isset($_POST['user_update'])){
$update_id=$user_id;
$update_name=$_POST['user_username'];
$update_email=$_POST['user_email'];
$update_address=$_POST['user_address'];
$update_image = $_FILES['user_image']['name'];
$temp_image = $_FILES['user_image']['tmp_name'];
$update_mobile=$_POST['user_mobile'];
 if(!empty($update_image)){
        move_uploaded_file($temp_image, "user_images/$update_image");
        $update_img_query = ", user_image='$update_image'";
    } else {
        $update_img_query = ""; // don’t update image if none uploaded
    }
$update_query = "UPDATE `user_table` 
                     SET username='$update_name',
                         user_email='$update_email',
                         user_Address='$update_address',
                         user_mobile='$update_mobile'
                         $update_img_query
                     WHERE user_id=$update_id";

    $result_update = mysqli_query($con, $update_query);
    if($result_update){
        echo "<script>alert('Account updated successfully')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
    } else {
        echo "<script>alert('Update failed: ".mysqli_error($con)."')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .edit_img{
    width:90%;
    margin:auto;
    display:block;
    object-fit:contain;

}</style>
</head>
<body>
    <h3 class="text-center text-success mb-4">Edit Account</h3>
<form action="" method="post" enctype="multipart/form-data" class="text-center">
<div class="form-outline  mb-4">
    <label for="">username:</label>
<input type="text" class="form-control w-50 m-auto" name="user_username" value="<?php echo $username ?>">
</div>
<div class="form-outline  mb-4">
     <label for="">email:</label>
<input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo $user_email ?>">
</div>
<div class="form-outline  mb-4">
     <label for="">upload new profile pic:</label>
<input type="file" class="form-control w-50 m-auto" name="user_image" >
</div>
<div class="form-outline  mb-4">
     <label for="">user address:</label>
<input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_address ?>">
</div>
<div class="form-outline  mb-4">
 <label for="">user mobile:</label>
<input type="text" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile ?>">
</div>

<input type="submit" value="update" class="bg-info py-3 px-3 border-0" name="user_update">

</form>
</body>
</html>
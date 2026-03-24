<?php
include('admin_auth.php');
?>

<h4 class="text-center text-dark mb-4">All Brands</h4>

<div class="table-responsive">

<table class="table table-hover align-middle text-center shadow-sm">

    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Brand Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

<?php
$select_brand="select * from `brands`";
$result=mysqli_query($con,$select_brand);
$number=0;

while($row=mysqli_fetch_assoc($result)){
    $brand_id=$row['brand_id'];
    $brand_title=$row['brand_title'];
    $number++;
?>

<tr>

    <td><?php echo $number ?></td>

    <td><?php echo $brand_title ?></td>

    <td>
        <a href="index.php?edit_brand=<?php echo $brand_id ?>" class="text-primary">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    </td>

    <td>
        <a href="index.php?delete_brand=<?php echo $brand_id ?>" class="text-danger">
            <i class="fa-solid fa-trash"></i>
        </a>
    </td>

</tr>

<?php } ?>

    </tbody>
</table>

</div>
<?php
include('admin_auth.php');
?>
<h4 class="text-center text-dark mb-4">All Categories</h4>

<div class="card shadow-sm p-3">

<div class="table-responsive">

<table class="table table-hover align-middle text-center">

    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Category Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

<?php
$select_cat="select * from `categories`";
$result=mysqli_query($con,$select_cat);
$number=0;

while($row=mysqli_fetch_assoc($result)){
    $category_id=$row['category_id'];
    $category_title=$row['category_title'];
    $number++;
?>

<tr>

    <td><?php echo $number ?></td>

    <td><?php echo $category_title ?></td>

    <td>
        <a href="index.php?edit_category=<?php echo $category_id ?>" class="text-primary">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>
    </td>

    <td>
        <a href="index.php?delete_category=<?php echo $category_id ?>" 
           onclick="return confirm('Delete this category?')" 
           class="text-danger">
            <i class="fa-solid fa-trash"></i>
        </a>
    </td>

</tr>

<?php } ?>

    </tbody>

</table>

</div>
</div>
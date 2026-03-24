<?php
include('admin_auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<style>
    img:hover {
    transform: scale(1.1);
    transition: 0.2s;
}

td, th {
    border-right: 1px solid #dee2e6;
}

td:last-child, th:last-child {
    border-right: none;
}
table {
    border-radius: 10px;
    overflow: hidden;
}
</style>
<body>
 <?php
include('admin_auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
integrity="sha512-bUg4tPLEB1Y1gfD4kD93Bp5ixesFtN4cM6bq8oJElcWkCAr/gbP1rZMZ5gkAA2k+/9ogYfZ0Ad1aeS1jZg=="
crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
   <h3 class="text-center  text-dark mb-4 ">All Products</h3>
   <div class="table-responsive">
<table class="table table-hover align-middle text-center mt-3">
<thead class="table-dark">
    <tr>
        <th>Product ID</th>
        <th>Product Title</th>
        <th>Product Image</th>
        <th>Product Price</th>
        <th>Product Sold</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
</thead>
<tbody class="bg-secondary text-light">

<?php
$get_products="select * from `products`";
$result=mysqli_query($con,$get_products);
$number=0;
while($row=mysqli_fetch_assoc($result)){
$product_id=$row['product_id'];
$product_title=$row['product_title'];
$product_image1=$row['product_image1'];
$product_price=$row['product_price'];
$status=$row['status'];
$number++;
?>

   <tr class='text-center align-middle'>
        <td> <?php echo $number; ?> </td>
         <td> <?php echo $product_title; ?> </td>
          <td><img src="./product_images/<?php echo $product_image1; ?>" 
     style="width: 70px; height: 70px; object-fit: cover; border-radius: 8px;"></td>
           <td><?php echo $product_price; ?>/-</td>
      
           <td>
<?php
$get_count="select * from `orders_pending` where product_id=$product_id";
$result_count=mysqli_query($con,$get_count);
$rows_count=mysqli_num_rows($result_count);
echo $rows_count;

?>
           </td>


        <td> <?php echo $status; ?></td>
            <td> <a href='index.php?edit_products=<?php echo $product_id ?>' class='text-dark'> <i class='fa-solid fa-pen-to-square'></i> </a> </td>
              <td> <a href='index.php?delete_product=<?php echo $product_id ?>' class='text-dark'> <i class='fa-solid fa-trash'></i> </a> </td>
        
    </tr>
<?php

}


?>


 
</tbody>
   </table>
   </div>
</body>
</html>
</body>
</html>
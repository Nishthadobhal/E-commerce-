<?php

include('../insert/connect.php');

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else {
    die("User not logged in");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Orders</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#f5f7fa;
}
</style>
</head>

<body>

<div class="container mt-3">

<h3 class="text-center fw-bold mb-3" style="color:#2c3e50;">
My Orders
</h3>

<?php
$get_order_details="select * from `user_orders` where user_id=$user_id AND amount_due > 0";
$result_orders=mysqli_query($con,$get_order_details);

if(mysqli_num_rows($result_orders)==0){
    echo "<div class='text-center text-muted mt-5'>No Orders Yet</div>";
}
?>

<div class="card shadow p-4 rounded-4 mt-2">
<div class="table-responsive">
<table class="table table-bordered table-hover align-middle text-center mt-3">

<thead class="table-dark">
<tr>
<th>S1 no</th>
<th>Amount Due</th>
<th>Total Products</th>
<th>Invoice Number</th>
<th>Date</th>
<th>Status</th>
</tr>
</thead>

<tbody class="align-middle">

<?php
$number=1;
while($row_orders=mysqli_fetch_assoc($result_orders)){
$order_id=$row_orders['order_id'];
$amount_due=$row_orders['amount_due'];
$order_date = date("d M Y", strtotime($row_orders['order_date']));
$total_products=$row_orders['total_products'];
$invoice_number=$row_orders['invoice_number'];
$order_status=$row_orders['order_status'];

echo "
<tr>
<td>$number</td>
<td>₹$amount_due</td>
<td>$total_products</td>
<td>$invoice_number</td>
<td>$order_date</td>

";
                             
if($order_status == 'paid'){
    echo "<td class='text-success fw-bold'>Paid</td>";
} else {
    echo "<td class='text-warning fw-bold'>unpaid</td>";
}
echo "</tr>";

$number++;
}
?>

</tbody>
</table>
</div>
</div>
</div>

</body>
</html>
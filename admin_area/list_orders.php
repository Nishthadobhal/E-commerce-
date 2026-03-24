
<?php
include('admin_auth.php');
?>

<h4 class="text-center text-dark mb-4">All Orders</h4>

<?php
$get_orders="SELECT * FROM `user_orders`";
$result=mysqli_query($con,$get_orders);
$row_count=mysqli_num_rows($result);

if($row_count==0){
    echo "<h5 class='text-danger text-center mt-5'>No Orders Yet</h5>";
}
else{
?>

<div class="card shadow-sm p-3">

<div class="table-responsive">

<table class="table table-hover text-center align-middle">

    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Amount</th>
            <th>Invoice</th>
            <th>Products</th>
            <th>Date</th>
            <th>Status</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

<?php
$number=0;
while($row_data=mysqli_fetch_assoc($result)){
    $order_id=$row_data['order_id'];
    $amount_due=$row_data['amount_due'];
    $invoice_number=$row_data['invoice_number'];
    $total_products=$row_data['total_products'];
    $order_date=$row_data['order_date'];
    $order_status=$row_data['order_status'];

    $number++;

    // status badge
    $status_badge = ($order_status=='pending') 
        ? "<span class='badge bg-warning text-dark'>Pending</span>"
        : "<span class='badge bg-success'>Completed</span>";

    echo "
    <tr>
        <td>$number</td>
        <td>₹$amount_due</td>
        <td>$invoice_number</td>
        <td>$total_products</td>
        <td>$order_date</td>
        <td>$status_badge</td>
        <td>
            <a href='index.php?delete_order=$order_id'
               onclick=\"return confirm('Delete this order?')\"
               class='text-danger'>
               <i class='fa-solid fa-trash'></i>
            </a>
        </td>
    </tr>";
}
?>

    </tbody>
</table>

</div>
</div>

<?php } ?>
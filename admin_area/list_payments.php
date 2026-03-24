<?php
include('admin_auth.php');
?>

<h4 class="text-center text-dark mb-4">All Payments</h4>

<?php
$get_payments="SELECT * FROM `user_payments`";
$result=mysqli_query($con,$get_payments);
$row_count=mysqli_num_rows($result);

if($row_count==0){
    echo "<h5 class='text-danger text-center mt-5'>No Payments Received Yet</h5>";
}
else{
?>

<div class="card shadow-sm p-3">

<div class="table-responsive">

<table class="table table-hover text-center align-middle">

    <thead class="table-dark">
        <tr>
            <th>S.no</th>
            <th>Invoice</th>
            <th>Amount</th>
            <th>Payment Mode</th>
            <th>Date</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

<?php
$number=0;

while($row_data=mysqli_fetch_assoc($result)){
    $payment_id = $row_data['payment_id'];
    $amount = $row_data['amount'];
    $invoice_number = $row_data['invoice_number'];
    $payment_mode = $row_data['payment_mode'];
    $date = $row_data['date'];

    $number++;

    echo "
    <tr>
        <td>$number</td>
        <td>$invoice_number</td>
        <td>₹$amount</td>
        <td><span class='badge  text-dark'>$payment_mode</span></td>
        <td>$date</td>
        <td>
            <a href='index.php?delete_payment=$payment_id'
               class='text-danger'
               onclick=\"return confirm('Delete this payment?')\">
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
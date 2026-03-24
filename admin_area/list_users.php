<?php
include('admin_auth.php');
?>

<h4 class="text-center text-dark mb-4">All Users</h4>

<?php
$get_users="SELECT * FROM `user_table`";
$result=mysqli_query($con,$get_users);
$row_count=mysqli_num_rows($result);

if($row_count==0){
    echo "<h5 class='text-danger text-center mt-5'>No Users Yet</h5>";
}
else{
?>

<div class="card shadow-sm p-3">

<div class="table-responsive">

<table class="table table-hover text-center align-middle">

    <thead class="table-dark">
        <tr>
            <th>Sno.</th>
            <th>Username</th>
            <th>Email</th>
            <th>Address</th>
            <th>Mobile</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

<?php
$number=0;

while($row_data=mysqli_fetch_assoc($result)){
    $user_id=$row_data['user_id'];
    $username=$row_data['username'];
    $user_email=$row_data['user_email'];
    $user_address=$row_data['user_Address'];
    $user_mobile=$row_data['user_mobile'];

    $number++;

    echo "
    <tr>
        <td>$number</td>
        <td>$username</td>
        <td>$user_email</td>
        <td>$user_address</td>
        <td>$user_mobile</td>
        <td>
            <a href='index.php?delete_user=$user_id'
               class='text-danger'
               onclick=\"return confirm('Delete this user?')\">
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
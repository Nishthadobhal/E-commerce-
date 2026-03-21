<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
if(isset($_POST['send_email_otp'])){
    unset($_SESSION['email_verified']); // reset old OTP
    $new_email = $_POST['user_email'];

    if($new_email != $_SESSION['old_email']){

        $otp = rand(100000,999999);
        $_SESSION['email_otp'] = $otp;
        $_SESSION['new_email'] = $new_email;

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cartify.project@gmail.com';
            $mail->Password = 'agealttcfzqvyooq';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('cartify.project@gmail.com', 'Cartify');
            $mail->addAddress($new_email);

            $mail->isHTML(true);
            $mail->Subject = 'Email Change OTP';
            $mail->Body = "<h3>Your OTP is: <b>$otp</b></h3>";

            $mail->send();

            echo "<script>alert('OTP sent to new email')</script>";

        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }

    } else {
        echo "<script>alert('Email not changed')</script>";
    }
}


// VERIFY OTP
if(isset($_POST['verify_email_otp'])){
    if(trim($_POST['email_otp_input']) == $_SESSION['email_otp']){
        $_SESSION['email_verified'] = true;
        echo "<script>alert('Email Verified')</script>";
    } else {
        echo "<script>alert('Invalid OTP')</script>";
    }
}

if(isset($_GET['edit_account'])){
    $user_session_id=$_SESSION['user_id'];
    $select_query="select * from `user_table` where user_id=$user_session_id";
$result_query=mysqli_query($con,$select_query);
$row_fetch=mysqli_fetch_assoc($result_query);
$user_id=$row_fetch['user_id'];
$username=$row_fetch['username'];
$user_email=$row_fetch['user_email'];

$_SESSION['old_email'] = $user_email;

$user_address=$row_fetch['user_Address'];
$user_mobile=$row_fetch['user_mobile'];
}

if(isset($_POST['user_update'])){
$update_id=$_SESSION['user_id'];
$update_name=$_POST['user_username'];
if(isset($_SESSION['email_verified'])){
    $update_email = $_SESSION['new_email']; // verified email
} else {
    $update_email = $_SESSION['old_email']; // keep old
}
$update_address=$_POST['user_address'];


$update_mobile=$_POST['user_mobile'];
  // EMAIL VERIFY CHECK
    if($update_email != $_SESSION['old_email']){
        if(!isset($_SESSION['email_verified'])){
            echo "<script>alert('Please verify new email first')</script>";
             echo "<script>window.open('profile.php?edit_account','_self')</script>";
            exit();
        }
    }
$update_query = "UPDATE `user_table` 
                     SET username='$update_name',
                         user_email='$update_email',
                         user_Address='$update_address',
                         user_mobile='$update_mobile'
                     WHERE user_id=$update_id";

    $result_update = mysqli_query($con, $update_query);
    if($result_update){
      $_SESSION['username'] = $update_name;
       unset($_SESSION['email_otp']);
        unset($_SESSION['email_verified']);
        unset($_SESSION['new_email']); 

        echo "<script>alert('Account updated successfully')</script>";
        echo "<script>window.open('profile.php?edit_account','_self')</script>";
    } else {
        echo "<script>alert('Update failed: ".mysqli_error($con)."')</script>";
    }
}
?>
<!-- UI START -->
<div class="d-flex justify-content-center align-items-center" style="min-height:70vh;">

  <div class="card p-4 shadow rounded-4" style="width: 450px;">

    <h4 class="text-center mb-4 text-success">Edit Account</h4>

    <form action="" method="post">

      <!-- Username -->
      <div class="mb-3">
        <label class="form-label fw-semibold">Username</label>
        <input type="text" class="form-control" name="user_username"
        value="<?php echo $username ?>" required>
      </div>

      <!-- Email -->
     <!-- Email -->
<div class="mb-3">
  <label class="form-label fw-semibold">Email</label>
  <input type="email" class="form-control" name="user_email"
  value="<?php echo $user_email ?>" required>

  <button type="submit" name="send_email_otp" class="btn btn-secondary btn-sm mt-2">
    Verify Email
  </button>

  <?php  
if(isset($_SESSION['email_otp'])){  
echo "<p style='color:green;'>OTP generated</p>";  
}  
?>

</div> 

<!-- OTP -->
<?php if(isset($_SESSION['email_otp']) && !isset($_SESSION['email_verified'])){ ?>
<div class="mb-3 border p-3 rounded bg-light">
  <label class="fw-semibold">Enter OTP</label>
  <input type="text" name="email_otp_input" class="form-control mt-2"
  placeholder="Enter OTP here">

  <button type="submit" name="verify_email_otp" class="btn btn-success btn-sm mt-2">
    Verify OTP
  </button>
</div>
<?php } ?>

      <!-- Address -->
      <div class="mb-3">
        <label class="form-label fw-semibold">Address</label>
        <input type="text" class="form-control" name="user_address"
        value="<?php echo $user_address ?>" required>
      </div>

      <!-- Mobile -->
      <div class="mb-3">
        <label class="form-label fw-semibold">Mobile</label>
        <input type="text" class="form-control" name="user_mobile"
        value="<?php echo $user_mobile ?>" required>
      </div>

      <!-- Button -->
      <button type="submit" class="btn btn-dark w-100 mt-3" name="user_update">
        Update Profile
      </button>

    </form>

  </div>

</div>
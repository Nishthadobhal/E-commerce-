<?php
session_start();
$env = parse_ini_file(__DIR__ . '/../.env');
putenv("MAIL_PASS=" . $env['MAIL_PASS']);
include('../insert/connect.php');
include('../function/common_function.php');
if(!isset($_POST['send_otp']) && !isset($_POST['verify_otp']) && !isset($_POST['user_register'])){
    $_SESSION = []; // 🔥 reset only for fresh load
}
// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

// SEND OTP
if(isset($_POST['send_otp'])){
    $email = $_POST['user_email'];

    if(empty($_POST['user_username'])){
        echo "<script>alert('Enter username first')</script>";
    } else {
        $_SESSION['username'] = $_POST['user_username'];

        $check = "SELECT * FROM user_table WHERE user_email='$email'";
        $result = mysqli_query($con,$check);

        if(mysqli_num_rows($result)>0){
          echo "<script>
alert('⚠️ This email is already registered. Please login instead.');
window.location.href='user_login.php';
</script>";
 exit();
        } else {
            $otp = rand(100000,999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'cartify.project@gmail.com'; 
                $mail->Password =  getenv('MAIL_PASS'); 
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('cartify.project@gmail.com', 'Cartify Team');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'OTP Verification';
                $mail->Body = "
             <h2>Cartify Verification</h2>
<p>Your OTP is: <b>$otp</b></p>
<p>This OTP is valid for 60 seconds.</p>
                ";

                $mail->send();

                echo "<script>alert('OTP sent to your email')</script>";

            } catch (Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
        }
    }
}

// VERIFY OTP
if(isset($_POST['verify_otp'])){
    $_SESSION['username'] = $_POST['user_username'];

    if($_POST['otp'] == $_SESSION['otp']){
        $_SESSION['verified'] = true;
        unset($_SESSION['otp']);
        echo "<script>alert('OTP Verified')</script>";
    } else {
        echo "<script>alert('Invalid OTP')</script>";
    }
}

// REGISTER USER
if(isset($_POST['user_register'])){
    if(!isset($_SESSION['verified'])){
        echo "<script>alert('Please verify OTP first')</script>";
    } else {
        $username = $_SESSION['username'];
        $user_email = $_SESSION['email'];
        $user_password = $_POST['user_password'];
        $hash_password = password_hash($user_password,PASSWORD_DEFAULT);
        $conf_password = $_POST['conf_user_password'];
        $user_address = $_POST['user_address'];
        $user_contact = $_POST['user_contact'];

        if($user_password != $conf_password){
            echo "<script>alert('Passwords do not match')</script>";
        } else {

            $insert_query = "INSERT INTO user_table 
            (username,user_email,password,user_address,user_mobile)
            VALUES ('$username','$user_email','$hash_password','$user_address','$user_contact')";

            $result = mysqli_query($con,$insert_query);

            if($result){
                unset($_SESSION['verified']);
                unset($_SESSION['email']);
                unset($_SESSION['username']);

                echo "<script>alert('Registration Successful')</script>";
                echo "<script>window.open('user_login.php','_self')</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- bootstrap css link -->
      <link rel="stylesheet" href="../style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<style>
  body {
  background: #f5f7fa;
}
form {
  max-width: 800px;
}
.card {
  border-radius: 16px;
}
h2 {
  margin-bottom: 0px;
}
.card input {
  padding: 10px;
  font-size: 14px;
}

.card label {
  font-weight: 500;
  margin-bottom: 5px;
}
</style>
<body>
    <?php include('../navbar.php'); ?>
    <div class="container-fluid mt-3 my-1">
        <h2 class='text-center mb-2'>New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center" >
            <div class='col-lg-12 col-xl-6'>

            <div class="container d-flex justify-content-center mt-2">
  <div class="card p-4 shadow rounded-4" style="width: 600px;">

<form action="" method="POST" enctype='multipart/form-data'>
    <?php $disabled = !isset($_SESSION['verified']) ? 'disabled' : ''; ?>

    <!-- username -->
<div class="form-outline mb-4">
    <label for="user_username" class="form-label">
Username
    </label>
  <input type="text" name="user_username" class="form-control"
value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : ''; ?>" required>
</div>
    <!-- email -->
<div class="form-outline mb-4">
  <label>Email</label>
    <div class="d-flex">
       <input type="email" name="user_email" class="form-control me-2"
value="<?php echo $_SESSION['email'] ?? ''; ?>"
<?php if(isset($_SESSION['verified'])) echo "readonly"; ?> required>
       

        <button type="submit" name="send_otp" class="btn btn-secondary">
            Send OTP
        </button>
    </div>
</div>

<?php if(isset($_SESSION['otp']) && !isset($_SESSION['verified'])){ ?>
<div class="form-outline mb-3">
<label>Enter OTP</label>
<div class="d-flex">
<input type="text" name="otp" class="form-control me-2" required>
<button type="submit" name="verify_otp" class="btn btn-success">
Verify
</button>
</div>
</div>
<?php } ?>



   <!--password -->
<div class="form-outline mb-4">
    <label for="user_password" class="form-label" >
Password
    </label>
    <input type="password" id="user_password" class="form-control" <?php echo $disabled; ?>
    placeholder="enter password"  required="required" 
    name="user_password">
</div>
   <!--confirm user password -->
<div class="form-outline mb-4">
    <label for="conf_user_password" class="form-label">
Confirm User Password
    </label>
    <input type="password" id="conf_user_password" class="form-control" <?php echo $disabled; ?>
    placeholder="enter password"  required="required" 
    name="conf_user_password">
</div>
   <!-- address -->
<div class="form-outline mb-4">
    <label for="user_address" class="form-label">
Address
    </label>
    <input type="text" id="user_address" class="form-control" <?php echo $disabled; ?>
    placeholder="enter your address" autocomplete="on" required="required" 
    name="user_address">
</div>
   <!-- contact -->
<div class="form-outline mb-4">
    <label for="user_email" class="form-label">
Contact
    </label>
    <input type="number" id="user_contact" class="form-control" <?php echo $disabled; ?>
    placeholder="enter mobile number" autocomplete="on" required="required" 
    name="user_contact">
</div>
<!-- submit button -->
<div class="mt-4 pt-2">
    <input type="submit"
class="btn btn-dark w-100 py-2"
name="user_register"
value="Register"  <?php if(!isset($_SESSION['verified'])) echo "disabled"; ?>>
<p class="small fw-bold mt-2 pt-1 mb-0">Already have an account?<a href="user_login.php" class="text-danger"> Login</a></p>
</div>

</form>
  </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>


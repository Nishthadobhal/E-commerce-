
<?php
include('../insert/connect.php');
include('../function/common_function.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- bootstrap css link -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
<style>
    body{
        overflow-x:hidden;
    }
</style>
    </head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow-lg p-4" style="width: 400px; border-radius: 12px;">
        
        <h3 class="text-center mb-4">Admin Login</h3>

        <form method="POST">

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Admin Email</label>
                <input type="email" name="admin_email"
                class="form-control"
                placeholder="Enter email" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                class="form-control"
                placeholder="Enter password" required>
            </div>

            <!-- Button -->
            <button class="btn btn-dark w-100 py-2" name="admin_login">
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>

<?php
if(isset($_POST['admin_login'])){
    $email = $_POST['admin_email'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT * FROM admin WHERE admin_email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        if(password_verify($password, $row['admin_password'])){
            $_SESSION['admin_id'] = $row['admin_id'];

            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Invalid password')</script>";
        }
    } else {
        echo "<script>alert('Admin not found')</script>";
    }
}
?>

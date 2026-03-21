<?php
session_start();

if(!isset($_SESSION['admin_logged_in'])){
    echo "<script>alert('Admin login required')</script>";
    echo "<script>window.open('admin_login.php','_self')</script>";
    exit;
}
?>

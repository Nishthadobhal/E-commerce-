<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>

<nav class="navbar navbar-dark bg-dark px-4">

    <span class="navbar-brand d-flex align-items-center text-white">
        <img src="../cartify_logo.png" width="30" class="me-2">
        Cartify Admin
    </span>

    <div class="d-flex align-items-center text-white">

        <a href="../index.php" class="btn btn-outline-light btn-sm me-2">
            Home
        </a>

        <span class="me-3">
            Welcome Admin
        </span>

        <a href="admin_logout.php" class="btn btn-danger btn-sm">
            Logout
        </a>

    </div>

</nav>
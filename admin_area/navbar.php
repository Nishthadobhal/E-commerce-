<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<style>
.admin-logo {
  height: 40px !important;
  width: auto !important;
  object-fit: contain;
}

/* mobile ke liye */
@media (max-width: 768px){
  .admin-logo {
    height: 30px !important;
  }
}
</style>
<nav class="navbar navbar-dark bg-dark px-4">

    <span class="navbar-brand d-flex align-items-center text-white">
       <img src="../cartify-logo.svg" class="admin-logo me-2">
        
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
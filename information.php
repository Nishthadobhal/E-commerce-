<?php

session_start();
echo "wellcome".$_SESSION['username'];
echo "and your password  is".$_SESSION['password'];

 
?>
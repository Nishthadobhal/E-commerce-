<?php
//remove all username and password and have to  enter all tehe values  again
session_start();
session_unset();
session_destroy();

echo"variables destroyed";  
?>
<?php

session_start();
if(isset($_SESSION['username'])){
$_SESSION['username']="khanam";
$_SESSION['password']="coding";
echo "session data is saved" ;
}
else{
    echo "login to contiue";
}
?>
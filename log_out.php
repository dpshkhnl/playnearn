<?php
session_start();
$_SESSION['username'] = "";
session_destroy();
header("Location: login.php");
setcookie("login_error","Log out Successfull",time()+1);

?>
<?php

// Include config file
require_once "db.php";
require_once "session.php";

extract($_REQUEST);
////////////// Login
if ($username) {
$new_pass = md5($password);
$str = "SELECT * FROM `admin` WHERE username = '$username' AND password = '$new_pass'";
$query = mysqli_query($link, $str);
if(mysqli_num_rows($query)==1){
	session_start();
	$_SESSION['username']=$username;
	header("Location: index.php");
}else{
	header("Location: login.php");
	setcookie("login_error","Invalid Login ID",time()+1);
	}
 
 }
 ////////////End Login
?>
<?php
session_start();
// include('config/dbcon.php');
// include('authentication.php');
if(isset($_POST['logout_btn']))
{ 
session_destroy();
	//unset($_SESSION['auth']);
	//unset($_SESSION['auth_user']);
	$_SESSION['status']="logged out successfully";
	header('location:login.php');
	exit();
}

?>
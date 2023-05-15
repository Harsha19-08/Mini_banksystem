<?php
session_start();
if(!isset($_SESSION['login_id'])){
	
	echo "<script>document.location.href='login.php?err=timeout'</script>";
	exit(0);
}


?>
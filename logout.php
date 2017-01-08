<?php 
if ($_GET['role']=='customer') {
	session_start();
	session_unset();//Unset all session variable
	session_destroy();//Destroy session
	header("location: login.php");
}else if($_GET['role']=='admin'){
	session_start();
	session_unset();//Unset all session variable
	session_destroy();//Destroy session
	header("location: customer-login.php");
}else if($_GET['role']=='register'){
	session_start();
	session_unset();//Unset all session variable
	session_destroy();//Destroy session
	header("location: register.php");
}else{
	session_start();
	session_unset();//Unset all session variable
	session_destroy();//Destroy session
	header("location: index.php");
}
 ?>

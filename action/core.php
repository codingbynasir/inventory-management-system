<?php 
// Start Session
session_start();

// Go to admin login if accessing admin dashboard
if (!$_SESSION['username']) {
	header("location: login.php");
}
 ?>
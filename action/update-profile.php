<?php
class update
{
	
	function __construct()
	{

	}
	public function Settings($name,$username,$email){
		$connection= new mysqli("localhost","root","","inventory");
		$uname=$_SESSION['username'];
		$sql="UPDATE admin SET name= '$name', username= '$username', email= '$email' WHERE username ='$uname'";
		if ($connection->query($sql)==TRUE) {
			return true;
		}else{
			return false;
		}
	}
	public function changePass($currentpassword,$newPassword,$rePassword){
		
		$conn= new mysqli("localhost","root","","inventory");
		$uname=$_SESSION['username'];
		$hashpass=md5($newPassword);
		$sql="UPDATE admin SET password='$hashpass' WHERE username = '$uname'";
		if ($conn->query($sql)==TRUE) {
			return TRUE;
		}else{
			return false;
		}
	}
} 

?>
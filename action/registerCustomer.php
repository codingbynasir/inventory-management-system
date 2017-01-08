php<?php
	require 'db_connection.php';
	$valid['success'] = array('success' => false, 'messages' => array());
	if ($_POST) {
		$name=$_POST['name'];
		$username=$_POST['username'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$mobile=$_POST['mobile'];
		$Shipping_location=$_POST['Shipping_location'];
		$billing_method=$_POST['billing_method'];
		$sql="SELECT * FROM customer WHERE username='$username'";
		$result=$connection->query($sql);
		if ($result->num_rows>0) {
			$valid['success']=true;
			$valid['messages']="Username already exist, choose another username";
		}else{
			$password=md5($password);
			$insert="INSERT INTO customer(name,username,email,password,mobile,shipping_location,billing_method) VALUES('$name','$username','$email','$password','$mobile','$Shipping_location','$billing_method')";
			if ($connection->query($insert)) {
				$valid['success']=true;
				$valid['messages']="Registration successfully completed";
			}else{
				$valid['success']=true;
				$valid['messages']="Unable to register";
			}
		}
	$connection->close();
	echo json_encode($valid);
	}
	

?>
<?php
	// Including database connection
	require 'db_connection.php';
	// Creating associative array for store the message
	$valid['success'] = array('success' => false, 'messages' => array());
	if ($_POST) {
		$name=$_POST['name'];		//Getting brand name from brand_name input field
		$username=$_POST['username'];	//Getting brand name from brand_name input field
		$email=$_POST['email'];		//Getting brand name from brand_name input field
		$password=md5($_POST['password']);	//Getting brand name from brand_name input field
		$sql="INSERT INTO admin(name, username, email, password) VALUES('$name','$username','$email','$password')";
		if ($connection->query($sql)==true) {
			$valid['success']=true;				//If brand is inserted success will be true
			$valid['messages']='<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong>New admin is successfully added</div>';
			
		}else{
			$valid['success']=false;			//If brand is not inserted success will be false
			$valid['messages']='<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>New admin is not added</div>';
		}
		$connection->close();					//Closing Connection
		//As our datatype is json, we will echo the json encoded value
		echo json_encode($valid);				
	}

?>
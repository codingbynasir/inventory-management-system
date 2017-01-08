<?php
	// Including database connection
	require 'db_connection.php';
	// Creating associative array for store the message
	$valid['success'] = array('success' => false, 'messages' => array());
	if ($_POST) {
		$brandName=$_POST['brand_name'];		//Getting brand name from brand_name input field
		$company_name=$_POST['company_name'];	//Getting brand name from brand_name input field
		$status=$_POST['status'];
		$sql="INSERT INTO brand(brand_name,company,status) VALUES('$brandName','$company_name',$status)";
		if ($connection->query($sql)) {
			$valid['success']=true;				//If brand is inserted success will be true
			$valid['messages']="Brand is successfully added";
		}else{
			$valid['success']=false;			//If brand is not inserted success will be false
			$valid['messages']="Error in adding brand";
		}
		$connection->close();					//Closing Connection
		//As our datatype is json, we will echo the json encoded value
		echo json_encode($valid);				
	}

?>
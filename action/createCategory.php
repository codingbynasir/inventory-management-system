<?php
	// Adding database connection
	require 'db_connection.php';
	// Associative array for storing messaging and success
	$valid['success'] = array('success' => false, 'messages' => array());
	if ($_POST) {
		$cat_name=$_POST['cat_name'];		//Cat_name from cat_name input field
		$status=$_POST['status'];			//status from status selection field
		//Checking the database either the cat is already exist in database
		$check_data="SELECT * FROM category WHERE cat_name='$cat_name'";
		$check_result=$connection->query($check_data);
		if ($check_result->num_rows>0) {
			$valid['success']=true;
			$valid['messages']='<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-ban"></i> </strong>Category already exist</div>';
		}else{
			//If cat is not stored in database, insert it in the category table of database
			$sql="INSERT INTO category(cat_name, status) VALUES('$cat_name','$status')";
			if ($connection->query($sql)) {
				$valid['success']=true;
				$valid['messages']='<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok-sign"></i> </strong>Category added successfully</div>';
			}else{
				$valid['success']=true;
				$valid['messages']='<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><span class="glyphicon glyphicon-remove"></span> </strong>Category is not inserted for unknown reason</div>';
			}
		}
		$connection->close();		//Closing the connection
		// As our datatype is json, we have to print the encoded json data
		echo json_encode($valid);
	}

?>
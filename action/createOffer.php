<?php
	require 'db_connection.php';
	$valid['success'] = array('success' => false, 'messages' => array());
	if ($_POST) {
		$sku=$_POST['sku'];
		$type=$_POST['type'];
		$amount=$_POST['amount'];
		$status=$_POST['status'];
		$check_data="SELECT * FROM offers WHERE sku='$sku'";
		$check_result=$connection->query($check_data);
		if ($check_result->num_rows>0) {
			$valid['success']=true;
			$valid['messages']='<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-ban"></i> </strong>Product already exist with an offer</div>';
		}else{
			$sql="INSERT INTO offers(sku,type,active_status,amount) VALUES('$sku','$type',$status,'$amount')";
			if ($connection->query($sql)) {
				$valid['success']=true;
				$valid['messages']='<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok-sign"></i> </strong>Offer added successfully</div>';
			}else{
				$valid['success']=true;
				$valid['messages']='<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><span class="glyphicon glyphicon-remove"></span> </strong>Product already exist in an offer</div>';
			}
		}
		$connection->close();
		echo json_encode($valid);
	}

?>
<?php
	require 'db_connection.php';
	$valid['success'] = array('success' => false, 'messages' => array());
	if ($_POST) {
		$offer_id=$_POST['offer_id'];
		$sku=$_POST['sku'];
		$type=$_POST['type'];
		$amount=$_POST['amount'];
		$status=$_POST['status'];
		$sql="UPDATE offers SET sku='$sku',type='$type',active_status='$status',amount='$amount' WHERE offer_id='$offer_id'";

		if ($connection->query($sql)) {
			$valid['success']=true;
			$valid['messages']='<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok-sign"></i> </strong>Offer updated successfully</div>';
		}else{
			$valid['success']=true;
			$valid['messages']='<div class="alert alert-error alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><span class="glyphicon glyphicon-remove"></span> </strong>This offer is not updated now</div>';
		}
		
		$connection->close();
		echo json_encode($valid);
	}

?>
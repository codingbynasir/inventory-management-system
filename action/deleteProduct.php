<?php require 'db_connection.php';
	$sku=$_POST['sku'];
	$message['success'] = array('success' => false,'message'=>array() );
	if ($sku) {
		$sql="DELETE FROM product WHERE sku= {$sku}";
		if ($connection->query($sql)==TRUE) {
			$message['success']=TRUE;
			$message['message']="Product is deleted successfully";
		}else{
			$message['success']=FALSE;
			$message['message']="Product is not deleted !";
		}
	}
	$connection->close();
	echo json_encode($message);
 ?>
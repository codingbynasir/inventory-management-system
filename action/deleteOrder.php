<?php require 'db_connection.php';
	$order_id=$_POST['order_id'];
	$message['success'] = array('success' => false,'message'=>array() );
	if ($order_id) {
		$sql="DELETE FROM orders WHERE order_id= {$order_id}";
		if ($connection->query($sql)==TRUE) {
			$message['success']=true;
			$message['message']="Brand is deleted successfully";
		}else{
			$message['success']=false;
			$message['message']="Brand is not deleted !";
		}
	}
	$connection->close();
	echo json_encode($message);
 ?>
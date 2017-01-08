<?php require 'db_connection.php';
	$brand_id=$_POST['brand_id'];
	$message['success'] = array('success' => false,'message'=>array() );
	if ($brand_id) {
		$sql="DELETE FROM brand WHERE brand_id= {$brand_id}";
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
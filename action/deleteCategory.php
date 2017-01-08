<?php require 'db_connection.php';
	$cat_id=$_POST['cat_id'];
	$message['success'] = array('success' => false,'message'=>array() );
	if ($cat_id) {
		$sql="DELETE FROM category WHERE cat_id= {$cat_id}";
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
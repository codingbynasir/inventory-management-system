<?php require 'db_connection.php';
	$offer_id=$_POST['offer_id'];
	$message['success'] = array('success' => false,'message'=>array() );
	if ($offer_id) {
		$sql="DELETE FROM offers WHERE offer_id= {$offer_id}";
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
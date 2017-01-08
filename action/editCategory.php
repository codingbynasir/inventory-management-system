<?php require 'db_connection.php';
$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$catName = $_POST['edit_cat_name'];
  	$Status = $_POST['status']; 
  	$cat_id=$_POST['cat_id'];

	$sql = "UPDATE category SET cat_name = '$catName', status = '$Status' WHERE cat_id = '$cat_id'";

	if($connection->query($sql) == TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 
	$connection->close();

	echo json_encode($valid);
 
} // /if $_POST
?>
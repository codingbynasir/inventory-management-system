<?php require 'db_connection.php';
$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['editBrandName'];
	$companyName=$_POST['editCompanyName'];
  	$brandStatus = $_POST['status']; 
  	$brand_id=$_POST['brand_id'];

	$sql = "UPDATE brand SET brand_name = '$brandName', company='$companyName', status = '$brandStatus' WHERE brand_id = '$brand_id'";

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
<?php require 'db_connection.php';
	$brand_id=$_POST['brand_id'];
	$sql="SELECT * FROM brand WHERE brand_id=$brand_id";
	$result=$connection->query($sql);
	if ($result->num_rows) {
		$row=$result->fetch_array();
	}
	$connection->close();
	echo json_encode($row);
?>
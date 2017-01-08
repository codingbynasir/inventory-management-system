<?php require 'db_connection.php';
	$cat_id=$_POST['cat_id'];
	$sql="SELECT * FROM category WHERE cat_id=$cat_id";
	$result=$connection->query($sql);
	if ($result->num_rows) {
		$row=$result->fetch_array();
	}
	$connection->close();
	echo json_encode($row);
?>
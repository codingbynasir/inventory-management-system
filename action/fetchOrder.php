<?php 
require 'db_connection.php';
$sql="SELECT * FROM `orders` FULL JOIN product USING(sku)";
$result=$connection->query($sql);
$output=array('data'=>array());
if ($result->num_rows>0) {
	while ($row=$result->fetch_assoc()) {
		$order_id=$row['order_id'];
		if ($row['status']==1){
			$activeBrand='<label class="label label-success">Full paid</label>';
		}else{
			$activeBrand='<label class="label label-danger">Not paid</label>';
		}
		$button='<a href="order.php?action=edit&o='.$order_id.'" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i></a>
				<a type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeOrderModal" onclick="removeOrder('.$order_id.');"><i class="glyphicon glyphicon-trash"></i></a>
			';
		$output['data'][]= array(
			$order_id,
			$row['product_name'],
			$row['order_date'],
			$row['name'],
			$row['contact'],
			$row['quantity'],
			$row['grand_total'],
			$activeBrand,
			$button
			);
	}
}
$connection->close();
echo json_encode($output);
?>

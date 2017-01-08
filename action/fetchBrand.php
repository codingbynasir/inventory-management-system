<?php 
require 'db_connection.php';
$sql="SELECT * FROM brand";
$result=$connection->query($sql);
$output=array('data'=>array());
$i=0;
if ($result->num_rows>0) {
	while ($row=$result->fetch_array()) {
		$i++;
		$brand_id=$row[0];
		if ($row[3]==1){
			$activeBrand='<label class="label label-success">Available</label>';
		}else{
			$activeBrand='<label class="label label-danger">Not available</label>';
		}
		$button='
			<div class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Action<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a type="button" data-toggle="modal" data-target="#editBrandModal" onclick="editBrand('.$brand_id.');"><i class="glyphicon glyphicon-edit"></i>Edit</a></li>
					<li><a type="button" data-toggle="modal" data-target="#removeBrandModal" onclick="removeBrand('.$brand_id.');"><i class="glyphicon glyphicon-trash"></i>Delete</a></li>
				</ul>
			</div>
			';
		$output['data'][]= array(
			$i,
			$row[1],
			$row[2],
			$activeBrand,
			$button
			);
	}
		
}
$connection->close();
echo json_encode($output);
?>
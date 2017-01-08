<?php require_once 'database/check_database.php';
$object= new createDatabase;
$conn= new mysqli("localhost","root","");
if (!$conn->select_db("inventory")) {
	$object->create_db();
}else{
 ?>

<?php

require 'require/header.php';
?>
<?php 
	$product_sql="select * from product";
	$productResult=$connection->query($product_sql);
	$countProduct=$productResult->num_rows;

	$order_sql="select * from orders where 1";
	$orderResult=$connection->query($order_sql);
	$countOrder= $orderResult->num_rows;

	$lowstock_sql="select * from product where quantity<=3";
	$lowstockResult=$connection->query($lowstock_sql);
	$countLowstock=$lowstockResult->num_rows;
?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-success">
			<div class="panel-heading">
				<a href="product.php?action=manage" style="text-decoration:none;color:black;">
					Total Product
					<span class="badge pull pull-right"><?php echo $countProduct; ?></span>	
				</a>
			</div> <!--/panel-hdeaing-->
		</div> <!--/panel-->
		</div>
		<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<a href="order.php?action=manage" style="text-decoration:none;color:black;">
						Total Orders
						<span class="badge pull pull-right"><?php echo $countOrder; ?></span>
					</a>
						
				</div> <!--/panel-hdeaing-->
			</div> <!--/panel-->
		</div>
		<div class="col-md-4">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<a href="product.php?action=inventory-alert" style="text-decoration:none;color:black;">
						Low Stock
						<span class="badge pull pull-right"><?php echo $countLowstock; ?></span>	
					</a>
					
				</div> <!--/panel-hdeaing-->
			</div> <!--/panel-->
		</div>
	</div>
</div>

<?php require 'require/footer.php'; ?>

<?php } ?>


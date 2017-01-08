<?php if (isset($_GET['p'])==true) {?>
	<?php 
session_start();
require 'customer/header.php';
$sku=$_GET['p'];
 ?>
 <style type="text/css">
	 .product_image img {
	    max-height: 350px;
	    min-height: 200px;
	} 	

 </style>
 <?php
 $sql="SELECT * FROM product WHERE sku='$sku'";
 $result=$connection->query($sql);
 if ($result->num_rows==1) {
 	$row=$result->fetch_assoc();
 }
 ?>
 <div class="container">
	<h2 class="well well-sm"><?php echo $row['cat_name']; ?></h2>
 		<div class="row">
 			<div class="col-md-6">
 				<div class="product_image">
			 		<img src="<?php echo $row['product_images']; ?>">
			 	</div>
 			</div>
 			<div class="col-md-6">
 				<h3><?php echo $row['product_name']; ?></h3>
 				<hr>
 				<h5>Product Code: <?php echo $row['sku']; ?></h5>
 				<h5>Price: ৳<?php echo $row['price']; ?></h5>
 				<?php if ($row['quantity']>0) {
 					echo 'Availability: <span class="label label-success">In stock</span>';
 				}else{
 					echo 'Availability: <span class="label label-danger">Out of stock</span>';
 					} ?>
 				<hr>
 				<h5 class="text-justify"><strong>Short Description:</strong> <?php echo $row['description']; ?></h5>
 			</div>
 		</div>
 		<hr>
 	<div class="fb-comments" data-href="http://localhost/inventory/view.php" data-numposts="5"></div>
 </div>

 <?php require 'customer/footer.php'; ?>
<?php }else if ($_GET['offer']) {?>
	<?php 
	session_start();
	require 'customer/header.php';
	$offer_id=$_GET['offer'];
 ?>
 <style type="text/css">
	 .product_image img {
	    max-height: 350px;
	    min-height: 200px;
	} 	
	
 </style>
 <?php
 $sql="SELECT * FROM offers NATURAL JOIN product WHERE offer_id='$offer_id'";
 $result=$connection->query($sql);
 if ($result->num_rows==1) {
 	$row=$result->fetch_assoc();
 }
 ?>
 <div class="container">
	<h2 class="well well-sm"><?php echo $row['cat_name']; ?></h2>
 		<div class="row">
 			<div class="col-md-6">
 				<div class="product_image">
 					<h2><?php echo $row['amount']."% OFF"; ?></h2>
			 		<img src="<?php echo $row['product_images']; ?>">
			 	</div>
 			</div>
 			<div class="col-md-6">
 				<h3><?php echo $row['product_name']; ?></h3>
 				<hr>
 				<h5>Product Code: <?php echo $row['sku']; ?></h5>
 				<h4>Price: <strong>৳ <?php 
 					$offer=$row['amount'];
 					$regular=$row['price'];
 					$latest=$regular-(($offer/100)*$regular);
 					echo '<strong>'.$latest.'</strong>';
 				 ?></strong> <del><?php echo $row['price']; ?></del>

 				</h4>
 				<?php if ($row['quantity']>0) {
 					echo 'Availability: <span class="label label-success">In stock</span>';
 				}else{
 					echo 'Availability: <span class="label label-danger">Out of stock</span>';
 					} ?>
 				<hr>
 				<h5 class="text-justify"><strong>Short Description:</strong> <?php echo $row['description']; ?></h5>
 			</div>
 		</div>
 		<hr>
 		
 	<div class="fb-comments" data-href="http://localhost/inventory/view.php" data-numposts="5"></div>
 </div>

	<?php require 'customer/footer.php'; ?>

<?php }?>
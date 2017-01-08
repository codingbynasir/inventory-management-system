<?php session_start(); ?>
<?php require 'customer/header.php'; ?>
<div class="container">
	<h3>Search result: <?php echo $_GET['result']; ?></h3>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-2">
			
		</div>
		<div class="col-md-10">
		<?php
		$key=$_GET['result'];
		 $sql="SELECT * FROM product WHERE product_name LIKE '%$key%'";
		 $result=$connection->query($sql);
		 if ($result=$connection->query($sql)) {
		 	while ($row=$result->fetch_assoc()) {
		 	?>
		 	<div class="row">
				<div class="col-md-3">
				<a href="">
					<div class="row">
						<div class="col-md-6">
							<img src="<?php echo $row['product_images']; ?>" style="height: 100px; width: 100px;">
						</div>
						<div class="col-md-6">
							<span><?php echo $row['product_name']; ?></span>
							<div><a href="cat.php?o=<?php echo $row['cat_name']; ?>" title=""><?php echo $row['cat_name']; ?></a></div>
							<div>
								<a href="brands.php?o=<?php echo $row['brand_name']; ?>"><?php echo $row['brand_name']; ?></a>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-md-4">
					<p class="text-center"><?php echo $row['description']; ?></p>
				</div>
				<div class="col-md-5">
					<a href="view.php?p=<?php echo $row['sku']; ?>" class="btn btn-primary">View Details</a>
				</div>
			</div>
		 <?php }
		}else{
			echo "product not found";
		}
		  ?>
			
		</div>
	</div>
</div>
<?php require 'customer/footer.php'; ?>
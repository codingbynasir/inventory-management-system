<?php 
session_start();
require 'customer/header.php';

 ?>
 <style type="text/css">
 	ul li{
 		display: block;
 	}
.product-details a {
    text-decoration: none;
    color: gray;
    text-align: center;
}
.product-details a:hover{
	color: black;
}
 </style>

<?php $archive=$_GET['o'];
	$cat_list="SELECT * FROM category WHERE status=1";
	$cat_result=$connection->query($cat_list);
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-3 cat">
			<h3 class="well well-sm" style="margin: 0px;">All Categories</h3>
			<?php 
			if ($cat_result->num_rows>0) {
				echo '<ul class="list-group">';
				while ($row=$cat_result->fetch_assoc()) {
					$catName=$row['cat_name'];
					$CountProduct="SELECT * FROM product WHERE cat_name='$catName'";
					$count_result=$connection->query($CountProduct);
					$count=$count_result->num_rows;
				?>
					<li class="list-group-item"><a href="cat.php?o=<?php echo $row['cat_name']; ?>"><span class="glyphicon glyphicon-chevron-right"></span><?php echo $row['cat_name']; ?>
					<span class="badge pull-right"><?php echo $count; ?></span>
					</a></li>
				<?php }
				echo "</ul>";
			}
			 ?>
		</div>
		<div class="col-md-9">
			<?php $selectProduct="SELECT * FROM product WHERE status = 1 AND cat_name='$archive'";
			$product_result=$connection->query($selectProduct);
			if ($product_result->num_rows>0) {?>
				<div class="row">
				<?php while ($row=$product_result->fetch_assoc()) {?>
					<div class="col-md-3">
						<div class="product-details">
							<a href="view.php?p=<?php echo $row['sku']; ?>">
								<div class="product-image">
									<img src="<?php echo $row['product_images']; ?>" alt="" style="height: 200px; width: 200px;">
								</div>
								<div class="product-name">
									<h5><?php echo $row['product_name']; ?></h5>
								</div>
								<div class="price"><h5>&#2547; <?php echo $row['price']; ?></h5></div>
								<div class="text-center"><button class="btn btn-primary">View details</button></div>
							</a>
						</div>
					</div>
				<?php } ?>
				</div>
			<?php }else{?>
				<h2 class="text-center">No product found with this category</h2>
			<?php }
			 ?>
		</div>
	</div>
</div>
<?php require 'customer/footer.php'; ?>
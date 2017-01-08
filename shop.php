<?php session_start(); ?>
<?php require 'customer/header.php'; ?>
<style type="text/css">
	.item.col-md-3.text-center {
    padding: 10px;
}
img {
    padding: 10px;
    transition: 1s;
}

img:hover {
	transform: scale(1.15);
}
</style>
<div class="container">
	<div class="offer-product row">
			<?php $sql= "SELECT * FROM product WHERE status='1'";
			$result= $connection->query($sql);
			if ($result->num_rows) {
				while ($row=$result->fetch_assoc()) { ?>
					<div class="item col-md-3 col-sm-3 text-center">
					<a href="view.php?p=<?php echo $row['sku']; ?>"><img src="<?php echo $row['product_images']; ?>" alt="Owl Image" style="height: 200px"></a>
			      <div class="text-center"><?php echo $row['product_name']; ?></div>
			      <div class="text-center"><div> &#2547;  <?php echo $row['price']; ?></div></div>
			      <div class="text-center"><a href="view.php?p=<?php echo $row['sku']; ?>" title="" class="btn btn-primary">View Details</a></div>
			      </div>
			<?php }
			}
		 ?>
		</div>
</div>

<?php require 'customer/footer.php'; ?>
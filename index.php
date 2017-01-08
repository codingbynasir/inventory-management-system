<?php session_start();
    if (isset($_SESSION['customer'])) {
        # code...
    }else{

    } ?>
<?php require 'customer/header.php'; ?>
<link rel="stylesheet" href="owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="owl-carousel/owl.theme.css">
<style>
    #owl-demo .item{
      margin: 3px;
    }
    #owl-demo .item img{
      display: block;
      width: 100%;
      height: auto;
  }
  img {
    padding: 10px;
    transition: 1s;
}

img:hover {
	transform: scale(1.15);
}
.offer-product a {
    color: #2e343e;
}
</style>
<div class="container">
	<h2>Our Latest Product</h2>
	<div id="owl-demo">
	<?php 
		$sql="SELECT * FROM product";
		$result=$connection->query($sql);
		$count=$result->num_rows;
		if ($count>0) {
			while ($row=$result->fetch_assoc()) {?>
			
          
      <div class="item"><a href="view.php?p=<?php echo $row['sku']; ?>"><img src="<?php echo $row['product_images']; ?>" alt="Owl Image" style="height: 200px"></a>
      <div class="name text-center"><a href="view.php?p=<?php echo $row['sku']; ?>"><?php echo $row['product_name']; ?></a></div>
      <div class="regular-price text-center"> &#2547;  <?php echo $row['price']; ?></div>
      <div class="text-center"><a href="view.php?p=<?php echo $row['sku']; ?>" title="" class="btn btn-primary">View Details</a></div>
      </div>
      <?php 

			}
		}
	 ?>
    </div>
</div>

<div class="container"><hr>
	<h2>Special Offers</h2>
		<div class="offer-product row">
			<?php $offer= "SELECT * FROM offers NATURAL JOIN product WHERE status='1'";
			$result_offer= $connection->query($offer);
			if ($total_offer=$result_offer->num_rows) {
				$i=0;
				while ($i<4 && $row=$result_offer->fetch_assoc()) { ?>
				<a href="view.php?offer=<?php echo $row['offer_id']; ?>" class="text-center">
				  <div class="item col-md-3 col-sm-3"><img src="<?php echo $row['product_images']; ?>" alt="Owl Image" style="height: 200px">
				      <div class="text-center"><?php echo $row['product_name']; ?></div>
				      <div class="text-center"><del> &#2547;  <?php echo $row['price']; ?></del></div>
				      <div class="text-center">
				      	&#2547;  <?php 
				      		$x=$row['price'];
				      		$oldPrice=intval($x);
				      		$curPrice=$oldPrice-(($row['amount']/100.00)*$oldPrice);
				      		echo $curPrice;
				      	 ?>
				      </div>
				      <div class="text-center btn btn-primary">View Details</div>
			      </div>
			    </a>
			<?php $i++; }
			if ($total_offer>4) {?>
				<h3 class="pull-right">
					<a href="shop.php" class="label label-success">View all product <span class="glyphicon glyphicon-arrow-right"></span>
					</a>
				</h3>
			<?php }
			
			}
		 ?>
		</div>
</div>

<!-- Popular product -->
<div class="container"><hr>
	<h2>Popular product</h2>
	<div class="offer-product row">
		<?php 
		$popularProduct="SELECT * FROM product ORDER BY quantity DESC";
		$popularResult = $connection->query($popularProduct);
		if ($total_popular=$popularResult->num_rows) {
				$i=0;
				while ($i<4 && ($popular=$popularResult->fetch_assoc())) { ?>
				<a href="view.php?p=<?php echo $popular['sku']; ?>" class="text-center">
				  <div class="item col-md-3 col-sm-3"><img src="<?php echo $popular['product_images']; ?>" alt="Owl Image" style="height: 200px">
				      <div class="text-center"><?php echo $popular['product_name']; ?></div>
				      <div class="text-center"> &#2547;  <?php echo $popular['price']; ?></div>
				      
				      <div class="text-center btn btn-primary">View Details</div>
			      </div>
			    </a>
			<?php $i++; }
			if ($total_offer>4) {?>
				<h3 class="pull-right">
					<a href="shop.php" class="label label-success">View all product <span class="glyphicon glyphicon-arrow-right"></span>
					</a>
				</h3>
			<?php }
			
			} ?>
	</div>
</div>



<?php require 'customer/footer.php'; ?>
<script src="owl-carousel/owl.carousel.min.js"></script>
<script>
        $(document).ready(function() {
 
          $("#owl-demo").owlCarousel({

              autoPlay: 5000, //Set AutoPlay to 3 seconds

              items : 4,
              itemsDesktop : [1199,3],
              itemsDesktopSmall : [979,3]

          });

        });
    </script>
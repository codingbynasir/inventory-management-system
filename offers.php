<?php require 'require/header.php'; ?>
<?php if ($_GET['action']=='manage') {?>
	<div class="container">
		<ol class="breadcrumb">
			<li> <a href="inventory.php">Home</a></li>
			<li class="active">Manage Offers</li>
		</ol>
	</div>
<?php }elseif ($_GET['action']=='add') {?>
	<div class="container">
		<ol class="breadcrumb">
			<li> <a href="inventory.php">Home</a></li>
			<li class="active">Add new Offers</li>
		</ol>
	</div>
<?php }elseif ($_GET['action']=='update') { ?>
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="inventory.php" title="Home">Home</a></li>
			<li><a href="offers.php?action=manage">Manage Offers</a></li>
			<li class="active">Update Offer</li>
		</ol>
	</div>
<?php } ?>
<?php if ($_GET['action']=='manage') {?>
	<div class="container">
		<div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title"><span class="glyphicon glyphicon-edit"></span>  Manage Offers</h3>
		  </div>
		  <div class="panel-body">
		  	<div class="offerRemoveMessage"></div>
		  	<table class="table table-hover" >
			    <thead>
			      <tr>
			        <th class="text-center">sku code</th>
			        <th class="text-center">Photo</th>
			        <th class="text-center">Product Name</th>
			        <th class="text-center">Rate</th>
			        <th class="text-center">Offer Type</th>
			        <th class="text-center">Offer Amount</th>
			        <th class="text-center">Status</th>
			        <th class="text-center">Options</th>
			      </tr>
			    </thead>
			    <tbody>
			    <?php 
			    	$sql="SELECT * FROM offers NATURAL JOIN product";
			    	$result=mysqli_query($connection,$sql);
			    	if ($result->num_rows) {
			    		while ($row=$result->fetch_assoc()) {
			    		
			     ?>
			    	<tr>
			    		<td class="text-center"><?php echo $row['sku']; ?></td>
			    		<td><?php echo "<img src=".$row['product_images']." style='width: 50px; height: 30px;'>"; ?></td>
			    		<td class="text-center"><?php echo $row['product_name']; ?></td>
			    		<td class="text-center"><?php echo $row['price']; ?></td>
			    		<td class="text-center"><?php echo $row['type']; ?></td>
			    		<td class="text-center"><?php echo $row['amount']."%"; ?></td>
			    		<td class="text-center"><?php if ($row['active_status']==1) {
			    			echo '<label class="label label-success">Available</label>';
			    		}else{
			    			echo '<label class="label label-danger">Not Available</label>';
			    			} ?></td>
			    		<td class="text-center">
			    		<a href="view.php?offer=<?php echo $row['offer_id']; ?>" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
			    		<a href="offers.php?action=update&id=<?php echo $row['offer_id']; ?>" target="_blank" class="btn btn-info"><i class="fa fa-pencil-square" aria-hidden="true"></i></a> <a  onclick="deleteOffer('<?php echo $row['offer_id']; ?>')" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteOfferModal"><span class="glyphicon glyphicon-trash"></span></a></td>

			    	</tr>
			    <?php }	
			    	}else{?>
			    	<h2>No product is found to display</h2>
	    		<?php } ?>
			    </tbody>
			</table>
		  </div>
		</div>
	</div> <!--  Container -->
	<!-- Delete offer modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="deleteOfferModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span>Delete offer</h4>
	      </div>
	      <div class="modal-body">
	        <p>Do you really want to delete the offer?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <button class="btn btn-primary" id="deleteOfferBtn">Delete</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

<?php require 'require/footer.php'; ?>
<script src="custom/js/offers.js" type="text/javascript"></script>

<?php }elseif ($_GET['action']=='add') {?>
	
	<div class="container">
		<div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title"><span class="glyphicon glyphicon-plus-sign"></span>  Add a new Offer</h3>
		  </div>
		  <div class="panel-body">
		  	<div class="msg text-center"></div>
		    <form action="action/createOffer.php" method ="POST" class="form-horizontal" id="submitOfferForm">
			  <div class="form-group">
			    <label for="sku" class="col-sm-2 control-label">Select SKU</label>
			    <div class="col-sm-9">
			    	<select name="sku" class="form-control" id="sku">
			    		<option value="">Select a sku</option>
			    		<?php 
						$sql="SELECT * FROM product WHERE status = 1";
						$result=$connection->query($sql);
						if ($result->num_rows>0) {
							while ($row=$result->fetch_assoc()) {?>
							<option value="<?php echo $row['sku']; ?>"><?php echo $row['sku']; ?></option>
						<?php }
						}
						 ?>
			    	</select>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="offer_type" class="col-sm-2 control-label">Offer Type</label>
			    <div class="col-sm-9">
			      <input type="text" name="type" class="form-control" id="offer_type" placeholder="Enter offer type">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="amount" class="col-sm-2 control-label">Offer amount(%)</label>
			    <div class="col-sm-9">
			      <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter offer amount">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="status" class="col-sm-2 control-label">Status</label>
			    <div class="col-sm-9">
			    	<select name="status" class="form-control" id="status">
			    		<option value="">Select a sku</option>
			    		<option value="1">Available</option>
			    		<option value="0">Not Available</option>
			    	</select>
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-success" id="offerSubmitBtn"><span class="glyphicon glyphicon-plus-sign"></span> Add offer</button>
			      
			    </div>
			  </div>
			</form>
		  </div>
		</div>
	</div> <!--  Container -->

<?php require 'require/footer.php'; ?>
<script src="custom/js/offers.js" type="text/javascript"></script>
<?php }elseif ($_GET['action']='update') {?>
	<?php 
	$order_id=$_GET['id'];
	$offerUpdateSql="SELECT * FROM offers WHERE offer_id='$order_id'";
	$offerUpdateResult=$connection->query($offerUpdateSql);
	if ($offerUpdateResult->num_rows) {
		$updateRow=$offerUpdateResult->fetch_assoc();
	}
	 ?>
	<div class="container">
		<div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title"><span class="glyphicon glyphicon-edit"></span>  Update Offer</h3>
		  </div>
		  <div class="panel-body">
		  	<div class="msg text-center">
		  	</div>
		    <form action="action/editOffer.php" method ="POST" class="form-horizontal" id="updateOfferForm">
		    <input type="hidden" name="offer_id" value="<?php echo $updateRow['offer_id']; ?>">
			  <div class="form-group">
			    <label for="sku" class="col-sm-2 control-label">Product Code</label>
			    <div class="col-sm-9">
			    	<select name="sku" class="form-control" id="sku">
			    		<option value="<?php echo $updateRow['sku']; ?>"><?php echo $updateRow['sku']; ?></option>
			    		<?php 
						$sql="SELECT * FROM product WHERE status =1";
						$result=$connection->query($sql);
						if ($result->num_rows>0) {
							while ($row=$result->fetch_assoc()) {?>
							<option value="<?php echo $row['sku']; ?>"><?php echo $row['sku']; ?></option>
						<?php }
						}
						 ?>
			    	</select>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="offer_type" class="col-sm-2 control-label">Offer Type</label>
			    <div class="col-sm-9">
			      <input type="text" name="type" class="form-control" id="offer_type" placeholder="Enter offer type" value="<?php echo $updateRow['type']; ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="amount" class="col-sm-2 control-label">Offer amount(%)</label>
			    <div class="col-sm-9">
			      <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter offer amount" value="<?php echo $updateRow['amount']; ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="status" class="col-sm-2 control-label">Status</label>
			    <div class="col-sm-9">
			    	<select name="status" class="form-control" id="status">
			    		<?php if ($updateRow['active_status']==1) {?>
			    			<option value="1">Available</option>
			    			<option value="0">Not Available</option>
			    		<?php }elseif ($updateRow['active_status']==0) {?>
				    		<option value="0">Not Available</option>
				    		<option value="1">Available</option>
			    		<?php } ?>
			    	</select>
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-success" id="updateOfferBtn"> Update offer</button>
			      
			    </div>
			  </div>
			</form>
		  </div>
		</div>
	</div> <!--  Container -->

	<?php require 'require/footer.php'; ?>
<script src="custom/js/offers.js" type="text/javascript"></script>
<?php } ?>

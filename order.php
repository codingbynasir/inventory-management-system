<?php 
require 'database/db_connection.php';
require 'require/header.php';
?>
<div class="container">
	<ol class="breadcrumb">
	    <li><a href="index.php">Home</a></li>
	    <li><a href="order.php?action=manage">Order</a></li>
	    <li class="active">
	  	<?php if($_GET['action'] == 'add') { ?>
	  		Add Order
			<?php } else if($_GET['action'] == 'manage') { ?>
				Manage Order
			<?php }else if (isset($_GET['action'])=='edit') {
				echo "Edit order";
			}	?>
	  	</li>
	</ol>
</div>	

<!-- Manage Order Section -->
<?php if ($_GET['action']=='manage') { ?>
	<div class="container">
		<div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title"><span class="glyphicon glyphicon-edit"></span>  Manage Orders</h3>
		  </div>
		  <div class="panel-body">
		  	<table class="table" id="manageOrderTable">
		  		
		  		<thead>
		  			<tr>
		  				<th>Order ID</th>
		  				<th>Product name</th>
		  				<th>Order Date</th>
		  				<th>Client Name</th>
		  				<th>Client Contact</th>
		  				<th>Quantity</th>
		  				<th>Price</th>
		  				<th>status</th>
		  				<th style="width: 15%;">Option</th>
		  			</tr>
		  		</thead>
		  	</table>
		  </div>
		</div>
	</div> <!--  Container -->
<!-- Manage order section is ended here -->


<!-- Remove Order Modal -->
<div class="modal fade" tabindex="-1" role="dialog"  id="removeOrderModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i>Delete Order</h4>
        <p class="OrderRemoveMessage"></p>
      </div>
      <div class="modal-body">
	        <p>Do you really want to delete the order?</p>
	      </div>
	      <div class="modal-footer">
	        <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
	        <button class="btn btn-primary" id="removeOrderBtn">Delete</button>
	      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Add Order Section start-->
<?php }else if ($_GET['action']=='add'){ ?>
<style type="text/css">
.product-price{
	margin-left: 85px;
}
</style>
	<div class="container">
		<div class="panel panel-success">
		  <div class="panel-heading">
		    <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span>  Add new order</h3>
		  </div>
		  <div class="panel-body">
		  	<div class="msg">
		  		
		  	</div>
		  	<?php 
		  		$sql="SELECT * FROM product WHERE status=1";
		  		$result=$connection->query($sql);
		  	 ?>
		    <form class="form-horizontal" action="action/createOrder.php" method="POST" id="createOrderForm">
		      <div class="form-group">
		        <label for="date" class="col-sm-2 control-label text-left">Order date</label>
		        <div class="col-sm-10">
		          <input type="text" name="date" class="form-control" id="date" placeholder="Select date">
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="customer_name" class="col-sm-2 control-label text-left">Customer name</label>
		        <div class="col-sm-10">
		        	<input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter customer name"/>
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="contact" class="col-sm-2 control-label text-left">Customer contact</label>
		        <div class="col-sm-10">
		        	<input type="text" name="contact" id="contact" class="form-control" placeholder="Enter customer contact number" value="+880" />
		        </div>
		      </div>
		      <div class="row product-price">
		      	<div class="col-md-6 col-sm-6">
		      		<div class="form-group">
				        <label for="product" class="col-sm-2 control-label text-left">Product</label>
				        <div class="col-sm-10">
				        	<select name="product" id="product" class="form-control" >
				        		<option value="">Select Product</option>
				        		<?php 
				        		if ($result->num_rows>0) {
				        			while ($row=$result->fetch_assoc()) {?>
				        			  <option value="<?php echo $row['sku']; ?>"><?php echo $row['product_name']; ?></option>
				        		<?php } } ?>
				        	</select>
				        </div>
				      </div>
		      	</div>
		      	<div class="col-md-6 col-sm-6">
		      		<div class="form-group">
				        <label for="price" class="col-sm-3 control-label text-left">Price</label>
				        <div class="col-sm-9">
				        	<?php 

				        		$price="SELECT * FROM product WHERE sku="
				        	 ?>
				        	<input type="number" name="price" id="price" class="form-control" placeholder="Enter product price"/>
				        </div>
				    </div>
		      	</div>
		      </div>
		      
		      <div class="row product-price">
		      	<div class="col-md-6">
		      		<div class="form-group">
				        <label for="quantity" class="col-sm-2 control-label text-left">Quantity</label>
				        <div class="col-sm-10">
				        	<input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity of product"/>
				        </div>
				    </div>
				</div>
				<div class="col-md-6">
				      <div class="form-group">
				        <label for="subTotal" class="col-sm-3 control-label text-left">Sub Total</label>
				        <div class="col-sm-9">
				        	<input type="number" name="subTotal" id="subTotal" class="form-control" placeholder="Enter quantity of product"/>
				        </div>
				      </div>
				</div>
		      	</div>
		      <div class="row product-price">
		      	<div class="col-md-6">
		      		<div class="form-group">
			        <label for="vat" class="col-sm-2 control-label text-left">Vat</label>
			        <div class="col-sm-10">
			        	<input type="number" name="vat" id="vat" class="form-control" placeholder="Enter quantity of product"/>
			        </div>
			      </div>
		      	</div>
			    <div class="col-md-6">
			    	<div class="form-group">
				        <label for="total" class="col-sm-3 control-label text-left">Total</label>
				        <div class="col-sm-9">
				        	<input type="number" name="total" id="total" class="form-control" placeholder="Enter quantity of product"/>
				        </div>
			        </div>
			    </div>
		      </div>
		      <div class="row product-price">
		      	<div class="col-md-6">
		      		<div class="form-group">
			        <label for="discount" class="col-sm-2 control-label text-left">Discount</label>
			        <div class="col-sm-10">
			        	<input type="number" name="discount" id="discount" class="form-control" placeholder="Enter discount of product"/>
			        </div>
			      </div>
		      	</div>
			    <div class="col-md-6">
			    	<div class="form-group">
				        <label for="grand_total" class="col-sm-3 control-label text-left">Grand Total</label>
				        <div class="col-sm-9">
				        	<input type="number" name="grand_total" id="grand_total" class="form-control" placeholder="Enter quantity of product"/>
				        </div>
			        </div>
			    </div>
		      </div>
		      <div class="row product-price">
		      	<div class="col-md-6">
		      		<div class="form-group">
			        <label for="paid_amount" class="col-sm-2 control-label text-left">Paid amount</label>
			        <div class="col-sm-10">
			        	<input type="number" name="paid_amount" id="paid_amount" class="form-control" placeholder="Enter paid amount of product"/>
			        </div>
			      </div>
		      	</div>
			    <div class="col-md-6">
			    	<div class="form-group">
				        <label for="due_amount" class="col-sm-3 control-label text-left">Due amount</label>
				        <div class="col-sm-9">
				        	<input type="number" name="due_amount" id="due_amount" class="form-control" placeholder="Enter Due amount of product"/>
				        </div>
			        </div>
			    </div>
		      </div>
		      <div class="row product-price">
		      	<div class="col-md-6">
		      		<div class="form-group">
			        <label for="payment_type" class="col-sm-2 control-label text-left">Payment type</label>
			        <div class="col-sm-10">
			        	<select name="payment_type" id="payment_type" class="form-control">
			        		<option value="">Select payment type</option>
			        		<option value="Bkash">Bkash</option>
			        		<option value="DBBL">DBBL</option>
			        		<option value="Bank-transaction">Bank Transaction</option>
			        		<option value="Credit">Credit card</option>
			        		<option value="Payment-on-delivary">Payment on delivary</option>
			        	</select>
			        </div>
			      </div>
		      	</div>
			    <div class="col-md-6">
			    	<div class="form-group">
				        <label for="payment_status" class="col-sm-3 control-label text-left">Payment status</label>
				        <div class="col-sm-9">
				        		<select name="payment_status" class="form-control" id="payment_status">
				        			<option value="">Select payment status</option>
				        			<option value="1">Full Payment</option>
				        			<option value="2">Partial payment</option>
				        			<option value="3">Not paid</option>
				        		</select>
				        </div>
			        </div>
			    </div>
		      </div>
		      <div class="form-group">
		        <div class="col-sm-offset-2 col-sm-10">
		          <button class="btn btn-primary" id="orderBtn">Add Order</button>
		          <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase"></span>  Reset</button>
		        </div>
		      </div>
		    </form> <!-- Form end -->
		  </div>
		</div>	<!-- Panel-->
	</div> <!--  Container -->

<?php }elseif($_GET['action']=='edit'){ ?>
	<?php $n=$_GET['o'];
	$sql = "SELECT * FROM `orders` JOIN product ON orders.sku=product.sku WHERE order_id={$n}";
	$result=$connection->query($sql);
	if ($result->num_rows==1) {
		$row=$result->fetch_assoc();
	}
	 ?>
	 <div class="container">
		<div class="panel panel-success">
		  <div class="panel-heading">
		    <h3 class="panel-title"><span class="glyphicon glyphicon-edit"></span>  Edit order</h3>
		  </div>
		  <div class="panel-body">
		  	<div class="msg">
		  		
		  	</div>
		  	<?php 
		  		
		  	 ?>
		    <form class="form-horizontal" action="action/editOrder.php" method="POST" id="editOrderForm">
		      <div class="form-group">
		        <label for="date" class="col-sm-2 control-label text-left">Order date</label>
		        <div class="col-sm-10">
		          <input type="text" name="date" class="form-control" id="date" placeholder="Select date" value="<?php echo $row['order_date']; ?>">
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="customer_name" class="col-sm-2 control-label text-left">Customer name</label>
		        <div class="col-sm-10">
		        	<input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter customer name" value="<?php echo $row['name']; ?>" />
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="contact" class="col-sm-2 control-label text-left">Customer contact</label>
		        <div class="col-sm-10">
		        	<input type="text" name="contact" id="contact" class="form-control" placeholder="Enter customer contact number" value="<?php echo $row['contact']; ?>" />
		        </div>
		      </div>
		      <div class="row product-price">
		      	<div class="col-md-6 col-sm-6">
		      		<div class="form-group">
				        <label for="product" class="col-sm-2 control-label text-left">Product</label>
				        <div class="col-sm-10">
				        	<select name="product" id="product" class="form-control">
				        		
				        		<option value="<?php echo $row['sku']; ?>"><?php echo $row['product_name']; ?></option>
				        		<option value="">Select Product</option>
				        		<?php 
				        		$allProduct="SELECT * FROM product WHERE status=1";
				        		$result=$connection->query($allProduct);
				        		if ($result->num_rows>0) {
				        			while ($row=$result->fetch_assoc()) {?>
				        			  <option value="<?php echo $row['sku']; ?>"><?php echo $row['product_name']; ?></option>
				        		<?php } } ?>
				        	</select>
				        </div>
				      </div>
		      	</div>
		      	<div class="col-md-6 col-sm-6">
		      		<div class="form-group">
				        <label for="price" class="col-sm-3 control-label text-left">Price</label>
				        <div class="col-sm-9">
				        	<input type="text" name="price" id="price" class="form-control" value="<?php echo $row['product.price']; ?>" />
				        </div>
				    </div>
		      	</div>
		      </div>
		      
		      <div class="row product-price">
		      	<div class="col-md-6">
		      		<div class="form-group">
				        <label for="quantity" class="col-sm-2 control-label text-left">Quantity</label>
				        <div class="col-sm-10">
				        	<input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity of product" value="<?php echo $row['quantity']; ?>" />
				        </div>
				    </div>
				</div>
				<div class="col-md-6">
				      <div class="form-group">
				        <label for="subTotal" class="col-sm-3 control-label text-left">Sub Total</label>
				        <div class="col-sm-9">
				        	<input type="number" name="subTotal" id="subTotal" class="form-control" placeholder="Enter quantity of product"/>
				        </div>
				      </div>
				</div>
		      	</div>
		      <div class="row product-price">
		      	<div class="col-md-6">
		      		<div class="form-group">
			        <label for="vat" class="col-sm-2 control-label text-left">Vat</label>
			        <div class="col-sm-10">
			        	<input type="number" name="vat" id="vat" class="form-control" placeholder="Enter quantity of product"/>
			        </div>
			      </div>
		      	</div>
			    <div class="col-md-6">
			    	<div class="form-group">
				        <label for="total" class="col-sm-3 control-label text-left">Total</label>
				        <div class="col-sm-9">
				        	<input type="number" name="total" id="total" class="form-control" placeholder="Enter quantity of product" value="<?php echo $row['total']; ?>" />
				        </div>
			        </div>
			    </div>
		      </div>
		      <div class="row product-price">
		      	<div class="col-md-6">
		      		<div class="form-group">
			        <label for="discount" class="col-sm-2 control-label text-left">Discount</label>
			        <div class="col-sm-10">
			        	<input type="number" name="discount" id="discount" class="form-control" placeholder="Enter discount of product"/>
			        </div>
			      </div>
		      	</div>
			    <div class="col-md-6">
			    	<div class="form-group">
				        <label for="grand_total" class="col-sm-3 control-label text-left">Grand Total</label>
				        <div class="col-sm-9">
				        	<input type="number" name="grand_total" id="grand_total" class="form-control" placeholder="Enter quantity of product"/>
				        </div>
			        </div>
			    </div>
		      </div>
		      <div class="row product-price">
		      	<div class="col-md-6">
		      		<div class="form-group">
			        <label for="paid_amount" class="col-sm-2 control-label text-left">Paid amount</label>
			        <div class="col-sm-10">
			        	<input type="number" name="paid_amount" id="paid_amount" class="form-control" placeholder="Enter paid amount of product"/>
			        </div>
			      </div>
		      	</div>
			    <div class="col-md-6">
			    	<div class="form-group">
				        <label for="due_amount" class="col-sm-3 control-label text-left">Due amount</label>
				        <div class="col-sm-9">
				        	<input type="number" name="due_amount" id="due_amount" class="form-control" placeholder="Enter Due amount of product"/>
				        </div>
			        </div>
			    </div>
		      </div>
		      <div class="row product-price">
		      	<div class="col-md-6">
		      		<div class="form-group">
			        <label for="payment_type" class="col-sm-2 control-label text-left">Payment type</label>
			        <div class="col-sm-10">
			        	<select name="payment_type" id="payment_type" class="form-control">
			        		<option value="">Select payment type</option>
			        		<option value="Bkash">Bkash</option>
			        		<option value="DBBL">DBBL</option>
			        		<option value="Bank-transaction">Bank Transaction</option>
			        		<option value="Credit">Credit card</option>
			        		<option value="Payment-on-delivary">Payment on delivary</option>
			        	</select>
			        </div>
			      </div>
		      	</div>
			    <div class="col-md-6">
			    	<div class="form-group">
				        <label for="payment_status" class="col-sm-3 control-label text-left">Payment status</label>
				        <div class="col-sm-9">
				        		<select name="payment_status" class="form-control" id="payment_status">
				        			<option value="">Select payment status</option>
				        			<option value="1">Full Payment</option>
				        			<option value="2">Partial payment</option>
				        			<option value="3">Not paid</option>
				        		</select>
				        </div>
			        </div>
			    </div>
		      </div>
		      <div class="form-group">
		        <div class="col-sm-offset-2 col-sm-10">
		          <button class="btn btn-primary" id="editOrderBtn">Add Order</button>
		          <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase"></span>  Reset</button>
		        </div>
		      </div>
		    </form> <!-- Form end -->
		  </div>
		</div>	<!-- Panel-->
	</div> <!--  Container -->
<?php } ?>
<?php require 'require/footer.php'; ?>
<script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="custom/js/order.js" type="text/javascript"></script>
<script src="custom/js/editorder.js" type="text/javascript"></script>
<script type="text/javascript">
	$("#date").datepicker({
		format: "dd/mm/yyyy",
		autoclose: true
	});
</script>
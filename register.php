<?php session_start(); ?>
<?php require 'customer/header.php'; ?>
<?php
	if (isset($_SESSION['customer'])||isset($_SESSION['username'])) { ?>
		<div class="container">
			<h2>You already registered and logged in. To create a new account <a href="logout.php?role=register">log out first</a> or visit homepage</h2>
		</div>
	<?php }else{
 ?>

<div class="container">
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Please Register</h3>
	  </div>
	  <div class="panel-body">
	  <div id="msg"></div>
	  	<form class="form-horizontal" method="POST" action="action/registerCustomer.php" id="submitRegisterForm">
		  <div class="form-group">
		    <label for="name" class="col-sm-2 control-label">Name</label>
		    <div class="col-sm-10">
		      <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="username" class="col-sm-2 control-label">Username</label>
		    <div class="col-sm-10">
		      <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="email" class="col-sm-2 control-label">Email</label>
		    <div class="col-sm-10">
		      <input type="text" name="email" class="form-control" id="email" placeholder="Enter your email">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="password" class="col-sm-2 control-label">Password</label>
		    <div class="col-sm-10">
		      <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="mobile" class="col-sm-2 control-label">mobile</label>
		    <div class="col-sm-10">
		      <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter your phone number">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="Shipping_location" class="col-sm-2 control-label">Shipping location</label>
		    <div class="col-sm-10">
		      <input type="text" name="Shipping_location" class="form-control" id="Shipping_location" placeholder="Enter your Shipping location">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="billing_method" class="col-sm-2 control-label">Payment method</label>
		    <div class="col-sm-10">
		      <select name="billing_method" class="form-control" id="billing_method">
		      	<option value="">Select a billing method</option>
		      	<option value="Bkash">Bkash</option>
		      	<option value="DBBL">DBBL</option>
		      	<option value="Cash on delivary">Cash on delivary</option>
		      </select>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button class="btn btn-primary" id="registerFormBtn">Sign Up</button>
		    </div>
		  </div>
		</form>
	  </div>
	</div>
</div>
<?php } ?>
<?php require 'customer/footer.php'; ?>
<script src="customer/js/register.js" type="text/javascript"></script>
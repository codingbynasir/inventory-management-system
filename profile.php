<?php 	session_start(); ?>
<?php require 'customer/header.php';?>
<link rel="stylesheet" type="text/css" href="custom/css/profile.css">
	<?php if (isset($_SESSION['username'])) {?>
	<div class="container">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h2 class="panel-title"><?php echo $_SESSION['username']; ?></h2>
		  </div>
		  <div class="panel-body">
		    Panel content
		  </div>
		</div>
	</div>
	<?php }elseif(isset($_SESSION['customer'])){?>
		<?php 
			$user=$_SESSION['customer'];
			$customer_sql="SELECT * FROM customer WHERE username='$user'";
			$result_customer=$connection->query($customer_sql);
			if ($result_customer->num_rows) {
				while ($customer_row=$result_customer->fetch_assoc()) { ?>
			
		<div class="container text-center">
		    <div class="col-lg-12 col-sm-12">
			    <div class="card hovercard">
			        <div class="card-background">
			            <img class="card-bkimg" alt="" src="http://lorempixel.com/100/100/people/9/">
			            <!-- http://lorempixel.com/850/280/people/9/ -->
			        </div>
			        <div class="useravatar">
			            <img alt="" src="http://1.bp.blogspot.com/--ucL-rXn-Ec/VLwta4arOvI/AAAAAAAABHU/LzjxpJ_cA-g/s1600/wallpaper-for-facebook-profile-photo-738967.jpg">
			        </div>
			        <div class="card-info"> <span class="card-title"><?php echo $customer_row['name']; ?></span>

			        </div>
			    </div>
			    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
			        <div class="btn-group" role="group">
			            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-user " aria-hidden="true"></span>
			                <div class="hidden-xs">Overview</div>
			            </button>
			        </div>
			        <div class="btn-group" role="group">
			            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
			                <div class="hidden-xs">Favorites</div>
			            </button>
			        </div>
			        <div class="btn-group" role="group">
			            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			                <div class="hidden-xs">Complain</div>
			            </button>
			        </div>
			        <div class="btn-group" role="group">
			            <button type="button" id="following" class="btn btn-default" href="#tab4" data-toggle="tab"><i class="fa fa-wrench" aria-hidden="true"></i>
			                <div class="hidden-xs">Settings</div>
			            </button>
			        </div>
			    </div>

			    <div class="well">
			      <div class="tab-content">
			        <div class="tab-pane fade in active" id="tab1">
			          <table>
			          	<tr>
			          		<td>Name: </td>
			          		<td><?php echo $customer_row['name']; ?></td>
			          	</tr>
			          	<tr>
			          		<td>Username: </td>
			          		<td><?php echo $customer_row['username']; ?></td>
			          	</tr>
			          	<tr>
			          		<td>email: </td>
			          		<td><?php echo $customer_row['email']; ?></td>
			          	</tr>
			          	<tr>
			          		<td>phone: </td>
			          		<td><?php echo $customer_row['mobile']; ?></td>
			          	</tr>
			          	<tr>
			          		<td>Shipping location: </td>
			          		<td><?php echo $customer_row['shipping_location']; ?></td>
			          	</tr>

			          </table>
			        </div>
			        <div class="tab-pane fade in" id="tab2">
			          <h3>This is tab 2</h3>
			        </div>
			        <div class="tab-pane fade in" id="tab3">
			        <div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">Your complains</h3>
						  </div>
						  <div class="panel-body">
						    <?php $complain="SELECT * FROM complain WHERE username='$user'";
						    	$complain_query=$connection->query($complain);
						    	$complain_result=$complain_query->num_rows;
						    	if ($complain_result) {
						    		while ($row=$complain_query->fetch_assoc()) {?>
						    			<?php echo $row['title']; ?>
						    			<p><?php echo $row['complain']; ?></p>
						    	<?php }
						    	}
						     ?>
						  </div>
						</div>
			          
			        </div>
			        <div class="tab-pane fade in" id="tab4">
			          <h3>This is tab 4</h3>
			        </div>
			      </div>
			    </div>
			    
			</div>  
		</div>
		<?php }
			}
		?>
	<?php }else{
		header("location: customer-login.php");
	}
 ?>
 <?php require 'customer/footer.php'; ?>
 <script src="custom/js/profile.js" type="text/javascript"></script>

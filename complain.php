<?php session_start(); ?>
<?php require 'customer/header.php'; ?>
<?php if($_GET['action']=='add' ){ ?>

<!-- Adding customer complain  -->
<?php if (isset($_SESSION['customer'])) {
	$user=$_SESSION['customer'];
	$sql="SELECT * FROM customer WHERE username='$user'";
	$result=$connection->query($sql);
	if ($result->num_rows) {
		$row=$result->fetch_assoc();
	}
	 ?>
		<div class="container">
		<div class="message"></div>
			<form class="form-horizontal" action="action/createComplain.php" method="POST" id="createComplainForm">
			  <div class="form-group">
			    <label for="username" class="col-sm-2 control-label">username</label>
			    <div class="col-sm-10">
			      <input type="text" name="username" class="form-control" id="username" placeholder="username" value="<?php echo $row['username']; ?>" >
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="website" class="col-sm-2 control-label">website(optional)</label>
			    <div class="col-sm-10">
			      <input type="text" name="website" class="form-control" id="website" placeholder="Enter Website">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="title" class="col-sm-2 control-label">Title</label>
			    <div class="col-sm-10">
			      <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="complain" class="col-sm-2 control-label">Complain</label>
			    <div class="col-sm-10">
			      <textarea name="complain" rows="5" id="complain" style="width: 100%;"></textarea>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button  class="btn btn-primary" id="createComplainBtn">Submit your complain</button>
			    </div>
			  </div>
			</form>
			</div>
	
<!-- End of customer complain -->

<!-- Managing complain section -->
<?php }else if(isset($_SESSION['username'])){?>
	<div class="container">
		<h2>As you logged in as admin, you can't add any complain. Goto <a href="complain.php?action=manage">complain manage</a> page, or <a href="inventory.php">inventory home</a> page</h2>
	</div>
<!-- End of managing complain -->
<?php }else{?>
	<div class="container">
		<h3 class="text-center">To add a complain, <a href="customer-login.php">Sign in</a> first.</h3>
		<h3 class="text-center">New here? <a href="register.php">Sign up</a> now</h3>
	</div>

<?php }
}else if ($_GET['action']=='manage'){
	if (isset($_SESSION['username'])) {?>
		<div class="container">
			<div class="panel panel-info">
			  <div class="panel-heading">
			    <h3 class="panel-title">Customer complain</h3>
			  </div>
			  <div class="panel-body">
			  	<?php $complain="SELECT * FROM complain NATURAL JOIN customer";
			  		$result=$connection->query($complain);
			  		if ($result->num_rows>0) {
			  			while ($row=$result->fetch_assoc()) {?>
					    <div class="h2"><a href="complain.php?action=view&id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></div>
					    <h5>
					    	<a href="profile.php?user=<?php echo $row['username']; ?>"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
		  					<?php echo $row['name']; ?></a> <a href="date.php"><i class="glyphicon glyphicon-time"></i> <?php echo $row['time']; ?> </a> <a href=""><span class="glyphicon glyphicon-calendar"></span><?php echo $row['date']; ?></a>
						</h5>
						<div class="complain-body">
							<p><?php echo $row['complain']; ?></p>
						</div>
			  		<?php } }else{
			  			echo "No complain found!";
			  		}
			  	 ?>
			  </div>
			</div>
		</div>
	<?php require 'require/footer.php'; ?>
<?php }else{ 
		header("location:login.php");
	}
}elseif ($_GET['action']=='view') {
	if (isset($_SESSION['username'])) {
		$complain_id=$_GET['id'];
		$sql="SELECT * FROM complain WHERE id='$complain_id'";
		$result=$connection->query($sql);
		if ($result->num_rows) {
		while ($row=$result->fetch_assoc()) {?>
		<div class="container">
			<h3><?php echo $row['title']; ?></h3>
			<p class="text-justify"><?php echo $row['complain']; ?></p>
		</div>
	<?php }
		}
	}elseif (isset($_SESSION['customer'])){
		echo '<div class="container">
			<h2><strong>Bad Access: </strong> You can not access this page. Visit <a href="index.php" >home page</a></h2>
		</div>';
	}else{
		header("location: index.php");
	}

}else{
	header("location: customer-login.php");
	} ?>

<?php require 'customer/footer.php'; ?>
<script src="custom/js/complain.js" type="text/javascript" charset="utf-8"></script>
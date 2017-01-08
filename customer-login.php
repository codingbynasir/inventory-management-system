<?php require 'database/db_connection.php'; ?>
<?php require 'require/style.php'; ?>
<style type="text/css">
	.panel-footer.row {
    padding-right: 0px;
    padding-left: 0px;
    margin: 0px;
}
</style>
<?php 
	session_start();
	if (isset($_SESSION['username'])) {?>
		<h2 class="container text-center">You are already logged in as admin. Logout and login as <a href="logout.php?role=admin">customer</a> or visit <a href="inventory.php">inventory</a></h2>
	<?php }else{
	if (isset($_SESSION['customer'])) {
		header("location: index.php");
	}
 ?>



<?php 
	$errors= array();
	if ($_POST) {
		$username=$_POST['username'];
		$password=$_POST['password'];
		if (empty($username)||empty($password)) {
			if ($username=="") {
				$errors[]="Username is required";
			}
			if ($password=="") {
				$errors[]="Password is required";
			}
		}else{
			$sql="select * from customer where username='$username'";
			$result=$connection->query($sql);
			$rowCount= $result->num_rows;
			if ($rowCount==1) {
				$password=md5($password);
				$mainSql="select * from customer where username ='$username' and password = '$password'";
				$mainResult=$connection->query($mainSql);
				$countCustomer=$mainResult->num_rows;
				if ($countCustomer==1) {
					$row=$mainResult->fetch_assoc();
					$username=$row['username'];
					$_SESSION['customer']=$username;	//Setting session variable
					header("location: index.php");
				}else{
					$errors[]="Combination of username and password is mismatched!";
				}
			}else{
				$errors[]="User doesn't exist!";
			}
		}
	}


 ?>
<body>
<div class="container">
	<div class="login-form">
		<div class="row vertical">
			<div class="col-md-5 col-md-offset-4">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Customer Login Panel</h3>
					</div>
					<div class="panel-body">

						<div class="messages">
							<?php if($errors) {
								foreach ($errors as $key => $value) {
									echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';										
									}
								} ?>
						</div>

						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
							<fieldset>
								  <div class="form-group">
								    <label class="sr-only" for="exampleInputAmount">Username</label>
								    <div class="input-group">
								      <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
								      <input type="text" name="username" class="form-control" id="exampleInputAmount" placeholder="Enter username" autofocus>
								    </div>
								  </div>
								<div class="form-group">
								    <label class="sr-only" for="exampleInputAmount">Password</label>
								    <div class="input-group">
								      <div class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></div>
								      <input type="password" name="password" class="form-control" id="exampleInputAmount" placeholder="Enter password">
								    </div>
								  </div>							
								<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
									  <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
									  or
									  <a href="register.php" class="btn btn-default">Sign up</a>
									</div>
								</div>
								
							</fieldset>
						</form>
					</div>
					<!-- panel-body -->
					<div class="panel-footer row">
						<div class="col-md-6">
							<div class="text-left">
								<a href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to inventory</a>
							</div>
						</div>
						<div class="col-md-6">
							<div class="text-right">
								<a href="login.php">Go to admin Login <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /panel -->
			</div>
			<!-- /col-md-4 -->
		</div>
		<!-- /row -->
	</div>		
</div>
<!-- container -->	
<?php } ?>

<?php require 'require/script.php'; ?>






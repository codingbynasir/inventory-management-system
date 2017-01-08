<?php require 'database/db_connection.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inventory management system</title>
	<?php require 'require/style.php'; ?>
</head>
<?php 
	session_start();
	if (isset($_SESSION['customer'])) {?>
		<h2 class="container">You are already logged in as Customer. logout and login as <a href="logout.php?role=customer">admin</a> or visit <a href="index.php">home</a></h2>			
	<?php 
	 }
	else{
	 if (isset($_SESSION['username'])) {
		header("location: inventory.php");
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
			$sql="select * from admin where username='$username'";
			$result=$connection->query($sql);
			$rowCount= $result->num_rows;
			if ($rowCount==1) {
				$password=md5($password);
				$mainSql="select * from admin where username ='$username' and password = '$password'";
				$mainResult=$connection->query($mainSql);
				$countCustomer=$mainResult->num_rows;
				if ($countCustomer==1) {
					$row=$mainResult->fetch_assoc();
					$username=$row['username'];
					$_SESSION['username']=$username;	//Setting session variable
					header("location: inventory.php");
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
						<h3 class="panel-title">Admin Login Panel</h3>
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
									<div class="col-sm-offset-2 col-sm-10">
									  <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<!-- panel-body -->
					<div class="panel-footer">
						<div class="text-left">
							<a href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to inventory</a>
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






	<?php require 'require/footer.php'; ?>
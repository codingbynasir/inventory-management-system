<?php require 'require/header.php';
require 'action/update-profile.php';
$object=new update;
 ?>
	<?php 
			$uname=$_SESSION['username'];
			$query="select * from admin where username='$uname'";
			$result=$connection->query($query);
			$row = $result->fetch_assoc();
			
			 ?>
	<div class="border-box container">

		<?php if ($_GET['action']=='settings') {?>
			<?php 
			$array=array();
			if ($_POST) {
				$name=$_POST['name'];
				$username=$_POST['username'];
				$email=$_POST['email'];
				if (empty($name)||empty($email)) {
					$array[]='<div class="alert alert-warning alert-dismissible text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Warning!</strong> Field must not be empty</div>';
				}else{
					$update=$object->Settings($name,$username,$email);
					if ($update==true) {
						
						$array[]='<div class="alert alert-success alert-dismissible text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Success!</strong> Profile updated successfully</div>';

					}else{
						$array[]='<div class="alert alert-danger alert-dismissible text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Profile is not updated</div>';
					}
				}
			} 
			?>
			
			<h3 class="well well-sm">
				<i class="fa fa-wrench" aria-hidden="true"></i>  Update your profile
			</h3>
			<hr>
				<?php foreach ($array as $key => $value) {
					echo $value;
				} ?>
			<form class="form-horizontal" action="" method="POST">
			  <div class="form-group">
			    <label for="name" class="col-sm-2 control-label">Name</label>
			    <div class="col-sm-10">
			      <input type="text" name="name" class="form-control" id="name" value="<?php echo $row['name']; ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="username" class="col-sm-2 control-label">Username</label>
			    <div class="col-sm-10">
			      <input type="text" name="username" class="form-control" id="username" value="<?php echo $row['username']; ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="email" class="col-sm-2 control-label">Email</label>
			    <div class="col-sm-10">
			      <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email']; ?>">
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button class="btn btn-success">Save changes</button>
			    </div>
			  </div>
			</form>


		<?php }elseif ($_GET['action']=='change-pass') {?>
			<?php 
			$array=array();
			if ($_POST) {
				$currentpassword=$_POST['currentpassword'];
				$newPassword=$_POST['newPassword'];
				$rePassword=$_POST['rePassword'];
				if (empty($currentpassword)||empty($newPassword)||empty($rePassword)) {
					$array[]='<div class="alert alert-warning alert-dismissible text-center" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  <strong>Empty field!</strong> Firld must not be empty!
					</div>';
				}else{
					$user=$_SESSION['username'];
					$pass=md5($currentpassword);
					$query="SELECT * FROM admin where username='$user' and password='$pass'";
					$result=$connection->query($query);
					if ($result->num_rows) {
						if ($newPassword==$rePassword) {
						$update=$object->changePass($currentpassword,$newPassword,$rePassword);
							if ($update==true) {
								$array[]='<div class="alert alert-success alert-dismissible text-center" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>Success!</strong> Password is changed successfully
									</div>';

							}else{
								$array[]='<div class="alert alert-danger alert-dismissible text-center" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>Error!</strong> Password is not changed!
									</div>';
							}
						}else{
							$array[]='<div class="alert alert-danger alert-dismissible text-center" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong>mismatched error!</strong> Incorrect new password!
							</div>';
						}
					}else{
						$array[]='<div class="alert alert-warning alert-dismissible text-center" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  <strong>Error!</strong> Incorrect old password!
								</div>';
					}
				}
			} 
			?>
			<h3 class="well well-sm">
				<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Change password
			</h3>
			<hr>
				<?php foreach ($array as $key => $value) {
					echo $value;
				} ?>
			<form class="form-horizontal" action="" method="POST">
			  <div class="form-group">
			    <label for="current-password" class="col-sm-2 control-label">Current password</label>
			    <div class="col-sm-10">
			      <input type="password" name="currentpassword" class="form-control" id="current-password" placeholder="Enter current password">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="new-password" class="col-sm-2 control-label">new password</label>
			    <div class="col-sm-10">
			      <input type="password" name="newPassword" class="form-control" id="new-password" placeholder="Enter new password">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="repassword" class="col-sm-2 control-label">Re-enter password</label>
			    <div class="col-sm-10">
			      <input type="password" name="rePassword" class="form-control" id="repassword" placeholder="Re-enter new password">
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-success">Save changes</button>
			    </div>
			  </div>
			</form>


		<?php } ?>
	</div>

<?php require 'require/footer.php'; ?>
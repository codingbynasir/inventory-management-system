<?php require 'action/core.php'; ?>
<?php require 'database/db_connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Inventory management system project</title>
	<?php require 'style.php';?>
</head>
<style>
	li.dropdown:hover ul.dropdown-menu {
    display: block;
}
.container-fluid:hover {
    box-shadow: 2px 1px 10px 0px;
}
</style>
<body>
<header>

	<div class="menu container">
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="inventory.php">Inventory</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="dropdown active">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-btc"></i>Brand<span class="caret"></span></a>
		          <ul class="dropdown-menu navBrand">
		            <li><a href="#" data-toggle="modal" data-target="#addBrandModal">Add brand</a></li>
		            <li><a href="brand.php">Manage brand</a></li>
		            
		          </ul>
		        </li>
		        <li>
		          <a href="category.php"><span class="glyphicon glyphicon-th-list"></span>  Category</a>
		        </li>
		        <li class="dropdown ">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-product-hunt" aria-hidden="true"></i>  Product<span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="product.php?action=manage">Manage Product</a></li>
		            <li><a href="product.php?action=add">Add Product</a></li>
		          </ul>
		        </li>
		        <li class="dropdown ">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-product-hunt" aria-hidden="true"></i>Offers<span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="offers.php?action=manage">Manage offers</a></li>
		            <li><a href="offers.php?action=add">Add new offer</a></li>
		          </ul>
		        </li>
		        <li class="dropdown ">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart"></span>  Order<span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="order.php?action=manage">Manage order</a></li>
		            <li><a href="order.php?action=add">Add order</a></li>
		          </ul>
		        </li>
		        <li class="">
		         	<a href="complain.php?action=manage">Complain</a>
		        </li>
		      </ul>
		      
		      <ul class="nav navbar-nav navbar-right">
		      	<li><a href="index.php">Customer View</a></li>
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="update.php?action=settings"><i class="fa fa-wrench" aria-hidden="true"></i> Settings</a></li>
		            <li><a href="update.php?action=change-pass"><i class="fa fa-key" aria-hidden="true"></i> Change password</a></li>
		            <li><a type="button" data-target="#newAdminModal" data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i>  New Admin</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i> log out</a></li>
		          </ul>
		        </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</div>
</header>

<!-- Add new admin modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newAdminModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-plus-sign"></i>Add a new admin</h4>
      </div>
      <form class="form-horizontal" action="action/createAdmin.php" method="POST" id="submitAdminForm">
      <div class="modal-body">
        <div class="msg"></div>
        
		  <div class="form-group">
		    <label for="name" class="col-sm-3 control-label">Name</label>
		    <div class="col-sm-9">
		      <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="username" class="col-sm-3 control-label">Username</label>
		    <div class="col-sm-9">
		      <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="email" class="col-sm-3 control-label">Email</label>
		    <div class="col-sm-9">
		      <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="password" class="col-sm-3 control-label">Password</label>
		    <div class="col-sm-9">
		      <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
		    </div>
		  </div>
		  
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
        <button class="btn btn-primary" id="newAdminBtn">Save changes</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
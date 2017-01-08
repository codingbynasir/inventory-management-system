<?php require 'database/db_connection.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>Inventory management system</title>
	<?php require 'require/style.php'; ?>
    <link rel="stylesheet" type="text/css" href="customer/css/style.css">
</head>
<style type="text/css">
    li:hover {
    color: #555;
    background-color: #e7e7e7;
}
li.search-form:hover {
    background: #334f6f;
}
*{
    margin: 0;
    padding: 0;
}
</style>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header id="header" class="header">
	<div class="container">
		
		<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="http://d2r8jqmejizzox.cloudfront.net/361456-853098-65x38-logofinal.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="navbar-collapse style= collapse in" id="bs-megadropdown-tabs" style="
    padding-left: 0px;
">
        <ul class="nav navbar-nav">
            <li class="shop"><a href="shop.php" title="">Shop</a></li>
            <li class="cat dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Category  <span class="glyphicon glyphicon-chevron-down"></span></a>
                <ul class="dropdown-menu">
                    <?php $cat_sql="SELECT * FROM category WHERE status=1";
                    $resultCat=$connection->query($cat_sql);
                    if ($resultCat->num_rows>0) {
                        while($row=$resultCat->fetch_assoc()){?>
                    <li><a href="cat.php?o=<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></a></li>
                    <?php } }
                     ?>
                </ul>
            </li>
            <li class="cat dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Brand  <span class="glyphicon glyphicon-chevron-down"></span></a>
                <ul class="dropdown-menu">
                    <?php $brand_sql="SELECT * FROM brand WHERE status=1";
                    $resultBrand=$connection->query($brand_sql);
                    if ($resultBrand->num_rows>0) {
                        while($row=$resultBrand->fetch_assoc()){?>
                    <li><a href="brands.php?o=<?php echo $row['brand_name']; ?>"><?php echo $row['brand_name']; ?></a></li>
                    <?php } }
                     ?>
                </ul>
            </li>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
        <li class="search-form">
            <form action="search.php" method="GET" class="navbar-form">
            <div class="form-group">
              <input type="text" name="result" class="form-control" placeholder="Search product" required>
            </div>
            <button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        </li>
        
            <?php if (isset($_SESSION['customer'])||isset($_SESSION['username'])) {?>
                <?php
                if (isset($_SESSION['customer'])) {
                    $username=$_SESSION['customer'];
                    $select_customer="SELECT * FROM customer WHERE username='$username'";
                    $result=$connection->query($select_customer);
                    if ($result->num_rows==1) {
                        $row=$result->fetch_assoc();
                    }
                }else if(isset($_SESSION['username'])){
                    $username=$_SESSION['username'];
                    $select_customer="SELECT * FROM admin WHERE username='$username'";
                    $result=$connection->query($select_customer);
                    if ($result->num_rows==1) {
                        $row=$result->fetch_assoc();
                    }
                }
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong><?php echo $row['name']; ?></strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul style="background-color:white;" class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong><?php echo $row['username'] ?></strong></p>
                                        <p class="text-left small"><?php echo $row['email']; ?></p>
                                        <p class="text-left">
                                            <a href="profile.php" class="btn btn-primary btn-block btn-sm">Profile</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="logout.php" class="btn btn-danger btn-block">logout</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <?php if (isset($_SESSION['customer'])) {?>
                    <li><a href="complain.php?action=add">Add a complain</a></li>
                <?php }elseif (isset($_SESSION['username'])) {?>
                    <li><a href="inventory.php">Admin dashboard</a></li>
            <?php } }else{ ?>
            <li>
              <a href="customer-login.php">SIGN IN</a>
            </li>
            <?php } ?>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
</header><!-- /header -->
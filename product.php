<?php require 'database/db_connection.php';
	require 'require/header.php';
 ?>
 <style type="text/css">
 input[type=file] {
    display: block;
    padding: 15px;
}
.row.upload-area {
    padding-left: 52px;
}
 </style>

 <?php if ($_GET['action']=='manage'){ ?>
 <div class="container">
 	<div class="breadcrumb-area">
 		<ol class="breadcrumb">
 			<li><a href="index.php">Home</a></li>
 			<li><a href="product.php?action=manage">Product</a></li>
 			<li>Manage</li>
 		</ol>
 	</div>
 	<div class="panel panel-info">
	  <div class="panel-heading">
	    <h3 class="panel-title"><span class="glyphicon glyphicon-edit"></span> Manage products</h3>
	  </div>
	  <div class="panel-body">
	  <div class="productRemoveMessage"></div>

	  <div class="row">
      <div class="col-md-6">
          <label for="">Show</label>
          <select name="">
            <option value="">5</option>
            <option value="">10</option>
            <option value="">15</option>
            <option value="">20</option>
            <option value="">25</option>
          </select>
          <label for="">categories</label>
      </div>
      <div class="col-md-6 text-right">
          <form action="action/fetchproduct.php" method="POST">
          	<label for="search">Search</label>
          	<input type="text" name="search" id="search">
          </form>
      </div>  
    </div>
    <div class="result">
    	
    </div>

	    <table class="table table-hover" >
		    <thead>
		      <tr>
		        <th class="text-center">sku code</th>
		        <th class="text-center">Photo</th>
		        <th class="text-center">Product Name</th>
		        <th class="text-center">Brand</th>
		        <th class="text-center">Category</th>
		        <th class="text-center">Rate</th>
		        <th class="text-center">Quantity</th>
		        <th class="text-center">Status</th>
		        <th class="text-center">Options</th>
		      </tr>
		    </thead>
		    <tbody>
		    <?php 
		    	$sql="SELECT * FROM product";
		    	$result=mysqli_query($connection,$sql);
		    	if ($result->num_rows) {
		    		while ($row=$result->fetch_assoc()) {
		    		
		     ?>
		    	<tr>
		    		<td class="text-center"><?php echo $row['sku']; ?></td>
		    		<td><?php echo "<img src=".$row['product_images']." style='width: 50px; height: 30px;'>"; ?></td>
		    		<td class="text-center"><?php echo $row['product_name']; ?></td>
		    		<td class="text-center"><?php echo $row['brand_name']; ?></td>
		    		<td class="text-center"><?php echo $row['cat_name']; ?></td>
		    		<td class="text-center"><?php echo $row['price']; ?></td>
		    		<td class="text-center"><?php echo $row['quantity']; ?></td>
		    		<td class="text-center"><?php if ($row['status']==1) {
		    			echo '<label class="label label-success">Available</label>';
		    		}else{
		    			echo '<label class="label label-danger">Not Available</label>';
		    			} ?></td>
		    		<td class="text-center">
		    		<a href="view.php?p=<?php echo $row['sku']; ?>" class="btn btn-success" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
		    		<a href="product.php?action=update&o=<?php echo $row['sku']; ?>" class="btn btn-info"><i class="fa fa-pencil-square" aria-hidden="true"></i></a> <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal"  onclick="deleteProduct('<?php echo $row['sku']; ?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		    	</tr>
		    <?php }	
		    	}else{?>
		    	<h2>No product is found to display</h2>
    		<?php } ?>
		    </tbody>
		</table>
	  </div>
	</div>
</div>


 
 <?php }elseif ($_GET['action']=='add') {?>
 
 <?php require 'action/createproduct.php';
	$product_object= new product; ?>
 	<div class="container">
 		<ol class="breadcrumb">
 			<li><a href="index.php">Home</a></li>
 			<li><a href="product.php?action=manage">Product</a></li>
 			<li>Add new product</li>
 		</ol>



 		<div class="panel panel-success">
	  <div class="panel-heading">
	    <h3 class="panel-title"><span class="glyphicon glyphicon-plus"></span> Add new product</h3>
	  </div>
	  <div class="panel-body">
	  <?php
	  $error= array();
	  	if ($_POST) {
	  		$product_name=$_POST['product_name'];
	  		$description=$_POST['description'];
	  		$brand_name=$_POST['brand_name'];
	  		$cat_name=$_POST['cat_name'];
	  		$quantity=$_POST['quantity'];
	  		$price=$_POST['price'];
	  		$expire_date=$_POST['expire_date'];
	  		$sku_code=$_POST['sku_code'];
	  		$status=$_POST['status'];
	  		$file_name=$_FILES['file']['name'];
	  		$destination="image/".uniqid().date("Y-m-d-h-i-s").str_replace(" ", "_", $file_name);
	  		$filename=$_FILES['file']['tmp_name'];
	  		if (empty($product_name)||empty($description)||empty($brand_name)||empty($cat_name)||empty($quantity)||empty($price)||empty($sku_code)) {
	  			$error[]='<div class="alert alert-warning alert-dismissible text-center" role="alert">
						  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						  	<strong>Warning!</strong> Field must not be empty
						</div>';
	  		}else{
	  			$sql_brand="SELECT * FROM brand WHERE brand_name='$brand_name'";
	  			$sql_cat="SELECT * FROM category WHERE cat_name='$cat_name'";
	  			$result_brand=mysqli_query($connection,$sql_brand);
	  			$result_cat=mysqli_query($connection,$sql_cat);
	  			if ($result_brand->num_rows&&$result_cat->num_rows) {
	  				$sql_product="SELECT * FROM product WHERE product_name='$product_name'";
	  				$sql_sku="SELECT * FROM product WHERE sku='$sku_code'";
	  				$sku_exist=$connection->query($sql_sku);
	  				$product_exist=$connection->query($sql_product);
	  				if ($sku_exist->num_rows||$product_exist->num_rows) {
	  					if ($sku_exist->num_rows) {
	  						$error[]='<div class="alert alert-warning alert-dismissible text-center" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>Warning!</strong> SKU code already exists!
									  </div>';
	  					}
	  					if ($product_exist->num_rows) {
	  						$error[]='<div class="alert alert-warning alert-dismissible text-center" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>Warning!</strong> Product is already exists!
									  </div>';
	  					}
	  				}else{
	  					
	  						$check_insert=$product_object->createProduct($product_name,$description,$filename,$destination,$brand_name,$cat_name,$quantity,$price,$expire_date,$sku_code,$status);
		  					if ($check_insert) {
		  						$error[]='<div class="alert alert-success alert-dismissible text-center" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>Success!</strong> Product is added successfully;
									  </div>';
		  					}else{
		  						$error[]='<div class="alert alert-danger alert-dismissible text-center" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>Warning!</strong> Product is not inserted!
									  </div>';
		  					}
	  					
	  				}
	  			}else{
	  				if ($result_brand->num_rows==0) {
	  					$error[]='<div class="alert alert-warning alert-dismissible text-center" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>Warning!</strong> Invalid brand name
									  </div>';
	  				}
	  				if ($result_cat->num_rows==0) {
	  					$error[]='<div class="alert alert-warning alert-dismissible text-center" role="alert">
									  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  <strong>Warning!</strong> Invalid category name
									  </div>';
	  				}
	  			}
	  		}

	  	 }

	  	 // For Brand and category combobox
	  	 $select_brand="SELECT * FROM brand WHERE status=1";
	  	 $select_category="SELECT * FROM category WHERE status = 1";
	  	 $rs_brand=$connection->query($select_brand);
	  	 $rs_cat=$connection->query($select_category);
	   ?>
	   <!-- Printin error messages -->
	   <?php foreach ($error as $key => $value) {
	   		echo $value;
	   } ?>
		<!-- Product adding form -->
 		<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=add" method="POST" enctype="multipart/form-data" id="createOrderForm">
	      <div class="form-group">
	        <label for="product_name" class="col-sm-2 control-label text-left">Product Name</label>
	        <div class="col-sm-10">
	          <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter product name">
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="description" class="col-sm-2 control-label text-left">Description</label>
	        <div class="col-sm-10">
	        	<textarea name="description" cols="122" id="description" placeholder="Enter description of product"></textarea>
	          <!-- <input type="text" name="description" class="form-control" id="description" placeholder="Enter description of product"> -->
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="brand_name" class="col-sm-2 control-label text-left">Brand Name</label>
	        <div class="col-sm-10">
	        	<select name="brand_name" class="form-control" id="brand_name">
	        		<option value="">Select Brand</option>
	        	<?php if ($rs_brand->num_rows) {?>
	        		<?php while ($row=$rs_brand->fetch_assoc()) { ?>
	        		<option value="<?php echo $row['brand_name']; ?>"><?php echo $row['brand_name']; ?></option>
	        	<?php }
	        			}
	        	 ?>

	        	</select>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="cat_name" class="col-sm-2 control-label text-left">Category Name</label>
	        <div class="col-sm-10">

	        	<select name="cat_name" class="form-control" id="cat_name">
	        		<option value="">Select Brand</option>
	        	<?php if ($rs_cat->num_rows) {?>
	        		<?php while ($row=$rs_cat->fetch_assoc()) { ?>
	        		<option value="<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></option>
	        	<?php }
	        			}
	        	 ?>
	        	</select>
	          
	        </div>
	      </div>
	      <div class="row upload-area">
	      <div class="col-md-9">
	        <div class="form-group">
	        <label for="quantity" class="col-sm-2 control-label text-left">Quantity</label>
	        <div class="col-sm-10">
	          <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter quantity of product">
	          
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="price" class="col-sm-2 control-label text-left">Price</label>
	        <div class="col-sm-10">
	          <input type="text" name="price" class="form-control" id="price" placeholder="Enter price of product">
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="expire-date" class="col-sm-2 control-label text-left">Expired date</label>
	        <div class="col-sm-10">
	          <input type="text" name="expire_date" class="form-control" class="datepicker" id="expire-date" placeholder="Expire date">
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="sku_code" class="col-sm-2 control-label text-left">SKU Code</label>
	        <div class="col-sm-10">
	          <input type="text" name="sku_code" class="form-control" id="sku_code" placeholder="Enter Brand Name">
	        </div>
	      </div>

	      </div>

	      	<div class="col-md-3">
	      		<img id="imgpreview" alt="Image preview" style="width: 150px;height: 150px;">
	      		<div class="form-group">
			        
			          <input onchange="imagepreview(event);" id="fileupload" name="file" type="file" class="file file-loading">

		      </div>
	      	</div>
	      </div>



	      


	       <div class="form-group">
	              <label for="status-name" class="col-sm-2 control-label text-left">Status</label>
	              <div class="col-sm-10">
	                <select name="status" class="form-control" id="status-name">
	                  <option value="">Select</option>
	                  <option value="1">Available</option>
	                  <option value="2">Not Available</option>
	              </select>
	              </div>
	            </div>
	      <div class="form-group">
	        <div class="col-sm-offset-2 col-sm-10">
	          <button type="submit" class="btn btn-primary" id="add_product">Add Product</button>
	        </div>
	      </div>
	    </form>
	   </div>
	   </div>
 	</div>
 <?php }elseif ($_GET['action']=='inventory-alert') {?>
 	<div class="container">
 		<div class="breadcrumb-area">
 			<ol class="breadcrumb">
 				<li><a href="index.php">Home</a></li>
 				<li><a href="product.php?action=manage">Product</a></li>
 				<li class="active">Low Stock</li>
 			</ol>
 		</div>
 	</div>
 	<div class="container">
 	<div class="panel panel-info">
	  <div class="panel-heading">
	    <h3 class="panel-title"><span class="glyphicon glyphicon-edit"></span> Manage products</h3>
	  </div>
	  <div class="panel-body">
	  <div class="productRemoveMessage"></div>
	    <table class="table table-hover" >
		    <thead>
		      <tr>
		        <th class="text-center">sku code</th>
		        <th class="text-center">Photo</th>
		        <th class="text-center">Product Name</th>
		        <th class="text-center">Brand</th>
		        <th class="text-center">Category</th>
		        <th class="text-center">Rate</th>
		        <th class="text-center">Quantity</th>
		        <th class="text-center">Status</th>
		        <th class="text-center">Options</th>
		      </tr>
		    </thead>
		    <tbody>
		    <?php 
		    	$sql="SELECT * FROM product WHERE quantity<=3";
		    	$result=mysqli_query($connection,$sql);
		    	if ($result->num_rows) {
		    		while ($row=$result->fetch_assoc()) {
		    		
		     ?>
		    	<tr>
		    		<td class="text-center"><?php echo $row['sku']; ?></td>
		    		<td><?php echo "<img src=".$row['product_images']." style='width: 50px; height: 30px;'>"; ?></td>
		    		<td class="text-center"><?php echo $row['product_name']; ?></td>
		    		<td class="text-center"><?php echo $row['brand_name']; ?></td>
		    		<td class="text-center"><?php echo $row['cat_name']; ?></td>
		    		<td class="text-center"><?php echo $row['price']; ?></td>
		    		<td class="text-center"><?php echo $row['quantity']; ?></td>
		    		<td class="text-center"><?php if ($row['status']==1) {
		    			echo '<label class="label label-success">Available</label>';
		    		}else{
		    			echo '<label class="label label-danger">Not Available</label>';
		    			} ?></td>
		    		<td class="text-center">
		    		<a href="view.php?p=<?php echo $row['sku']; ?>" class="btn btn-success" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
		    		<a href="product.php?action=update&o=<?php echo $row['sku']; ?>" class="btn btn-info"><i class="fa fa-pencil-square" aria-hidden="true"></i></a> <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteProductModal"  onclick="deleteProduct('<?php echo $row['sku']; ?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
		    	</tr>
		    <?php }	
		    	}else{?>
		    	<h2>No product is found to display</h2>
    		<?php } ?>
		    </tbody>
		</table>
	  </div>
	</div>
</div>

 <?php }elseif ($_GET['action']=='update' && isset($_GET['o'])){ ?>


<style>
.row.upload-area {
	padding-left: 50px;
}
input#fileupload {
    padding: 5px 14px;
}
</style>
<?php 
	$msg=array();
	$sk=$_GET['o'];
	if ($_POST) {
		$product_name=$_POST['product_name'];
		$description=$_POST['description'];
		$brand_name=$_POST['brand_name'];
		$cat_name=$_POST['cat_name'];
		$quantity=$_POST['quantity'];
		$price=$_POST['price'];
		$date=$_POST['expire_date'];
		$sku_code=$_POST['sku_code'];
		$status=$_POST['status'];
		$file_name=$_FILES['file']['name'];
	  	$destination="image/".uniqid().date("Y-m-d-h-i-s").str_replace(" ", "_", $file_name);
	  	$filename=$_FILES['file']['tmp_name'];
	  	if (move_uploaded_file($filename, $destination)){
	  		$sql="UPDATE product SET sku='$sku_code', product_name='$product_name',description='$description',product_images='$destination',brand_name='$brand_name',cat_name='$cat_name',quantity='$quantity',price='$price',expire_date='$date',status='$status' WHERE sku='$sk'";
	  		if ($connection->query($sql)==TRUE) {
	  			
	  			$msg[]='<div class="alert alert-success alert-dismissible text-center" role="alert">
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong>Product is updated successfully</div>';
	  		}else{
	  			$msg[]='<div class="alert alert-danger alert-dismissible text-center" role="alert">
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong>Product is not updated!</div>';
	  		}
	  	}else{
	  		$sql="UPDATE product SET sku='$sku_code', product_name='$product_name',description='$description',brand_name='$brand_name',cat_name='$cat_name',quantity='$quantity',price='$price',expire_date='$date',status='$status' WHERE sku='$sk'";
	  		if ($connection->query($sql)==TRUE) {
	  			$msg[]='<div class="alert alert-success alert-dismissible text-center" role="alert">
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong>Product is updated successfully</div>';
	  		}else{
	  			$msg[]='<div class="alert alert-danger alert-dismissible text-center" role="alert">
  				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong>Product is not updated!</div>';
	  		}
	  	}
	}
 ?>

<?php $pr=$_GET['o']; ?>
	<div class="container">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><span class="glyphicon glyphicon-edit"></span>Update Product</h3>
		  </div>
		  <div class="panel-body">
		  	<div class="update-msg">
		  		<?php foreach ($msg as $key => $value) {
		  			echo $value;
		  		} ?>
		  	</div>
		  	<?php $sql="SELECT * FROM product WHERE sku='$pr'";
		  		$result=$connection->query($sql);
		  		if ($result->num_rows==1) {
		  			$row=$result->fetch_assoc();
		  	 ?>
		    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>?action=update&o=<?php echo $pr; ?>" method="POST" enctype="multipart/form-data" id="createOrderForm">
		      <div class="form-group">
		        <label for="product_name" class="col-sm-2 control-label text-left">Product Name</label>
		        <div class="col-sm-10">
		          <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter product name" value="<?php echo $row['product_name']; ?>">
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="description" class="col-sm-2 control-label text-left">Description</label>
		        <div class="col-sm-10">
		          <input type="text" name="description" class="form-control" id="description" placeholder="Enter product name" value="<?php echo $row['description']; ?>">
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="brand_name" class="col-sm-2 control-label text-left">Brand Name</label>
		        <div class="col-sm-10">
		        	<select name="brand_name" class="form-control" id="brand_name">
		        		<option value="<?php echo $row['brand_name']; ?>"><?php echo $row['brand_name']; ?></option>
		        	<?php
		        		$brName=$row['brand_name'];
		        		$selectAllBrand="SELECT * FROM brand";
		        		$brandResult=$connection->query($selectAllBrand);
		        	 if ($brandResult->num_rows) {?>
		        		<?php while ($brand=$brandResult->fetch_assoc()) { ?>
		        		<option value="<?php echo $brand['brand_name']; ?>"><?php echo $brand['brand_name']; ?></option>
		        	<?php }
		        			}
		        	 ?>

		        	</select>
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="cat_name" class="col-sm-2 control-label text-left">Category Name</label>
		        <div class="col-sm-10">

		        	<select name="cat_name" class="form-control" id="cat_name">
		        		<option value="<?php echo $row['cat_name']; ?>"><?php echo $row['cat_name']; ?></option>
		        	<?php
		        		$catName=$row['cat_name'];
		        		$selectCat="SELECT * FROM category";
		        		$resultCat=$connection->query($selectCat);
		        	 if ($resultCat->num_rows) {?>
		        		<?php while ($cat=$resultCat->fetch_assoc()) { ?>
		        		<option value="<?php echo $cat['cat_name']; ?>"><?php echo $cat['cat_name']; ?></option>
		        	<?php }
		        			}
		        	 ?>
		        	</select>
		          
		        </div>
		      </div>
		      <div class="row upload-area">
		      <div class="col-md-9">
		        <div class="form-group">
		        <label for="quantity" class="col-sm-2 control-label text-left">Quantity</label>
		        <div class="col-sm-10">
		          <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Enter quantity of product" value="<?php echo $row['quantity']; ?>">
		          
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="price" class="col-sm-2 control-label text-left">Price</label>
		        <div class="col-sm-10">
		          <input type="text" name="price" class="form-control" id="price" placeholder="Enter price of product" value="<?php echo $row['price']; ?>">
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="expire-date" class="col-sm-2 control-label text-left">Expired date</label>
		        <div class="col-sm-10">
		          <input type="text" name="expire_date" class="form-control" class="datepicker" id="expire-date" placeholder="Expire date" value="<?php echo $row['expire_date']; ?>">
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="sku_code" class="col-sm-2 control-label text-left">Product Code</label>
		        <div class="col-sm-10">
		          <input type="text" name="sku_code" class="form-control" id="sku_code" placeholder="Enter Brand Name" value="<?php echo $row['sku']; ?>">
		        </div>
		      </div>

		      </div>

		      	<div class="col-md-3">
		      		<img src="<?php echo $row['product_images']; ?>" id="imgpreview" alt="Image preview" style="width: 150px;height: 150px;">
		      		<div class="form-group">
				        
				          <input onchange="imagepreview(event);" id="fileupload" name="file" type="file" class="file file-loading">

			      </div>
		      	</div>
		      </div>



		      


		       <div class="form-group">
		              <label for="status-name" class="col-sm-2 control-label text-left">Status</label>
		              <div class="col-sm-10">
		                <select name="status" class="form-control" id="status-name">
		                  
		                  <?php if ($row['status']==1) {?>
		                  	<option value="1">Available</option>
		                  	<option value="0">Not Available</option>
		                  <?php }else if ($row['status']==0) { ?>
		                  	<option value="0">Not Available</option>
		                  	<option value="1">Available</option>
		                  <?php }else{ ?>
		                  	<option value="">Select status</option>
		                  	<option value="1">Available</option>
		                  	<option value="0">Not Available</option>
		                  <?php } ?>
		                  
		              </select>
		              </div>
		            </div>
		      <div class="form-group">
		        <div class="col-sm-offset-2 col-sm-10">
		          <button type="submit" class="btn btn-primary" id="add_product">Update Product</button>
		        </div>
		      </div>
		    </form>
		    <?php } ?>
		  </div>
		</div>
	</div>

<?php } ?>
 

<!--Product Delete Section -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteProductModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i>Delete Category</h4>
      </div>
        <div class="modal-body">
          <p>Do you really want to delete product?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" id="deleteProductBtn" data-loading-text="Loading..">Delete</button>
        </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




 <?php require 'require/footer.php'; ?>
<script src="custom/js/product.js" type="text/javascript"></script>
<script src="custom/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script  type="text/javascript">
	$("#expire-date").datepicker({
		format: "dd/mm/yyyy",
		autoclose: true
	});
</script>
<script>
  var imagepreview = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('imgpreview');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>
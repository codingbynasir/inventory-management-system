<?php require 'database/db_connection.php'; ?>

<!-- Add Brand Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus" aria-hidden="true"></i>Add Category</h4>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
      	<div class="modal-body">

      		<div class="alert alert-info alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			   <?php foreach ($msg as $key => $value) {
			   		echo $value;
			   } ?>
			</div>

	        <div class="form-group">
	            <label for="brand-name" class="control-label">Category name</label>
	            <input type="text" name="cat_name" class="form-control" id="brand-name" required/>
	          </div>
	          <div class="form-group">
	            <label for="company-name" class="control-label">Brand Name</label>
	            <input type="text" name="brand_name" class="form-control" id="company-name">
	          </div>
	          <div class="form-group">
	            <label for="status-name" class="control-label">Status</label>
	            <select name="status" class="form-control" id="brandStatus">
	            	<option value="">Select</option>
	            	<option value="1">Available</option>
	            	<option value="2">Not Available</option>
	            </select>
	          </div>
	    </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createBrandBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>


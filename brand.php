<?php require 'require/header.php'; ?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="inventory.php" title="">Inventory</a></li>
		<li class="active">Brand</li>
	</ol>
	<div class="panel panel-default">
		<div class="panel-heading">
			<i class="glyphicon glyphicon-edit"></i>Manage Brand
		</div>
		<div class="panel-body">
			<div class="remove-message"></div>
			<div class="action pull pull-right">
				<button class="btn btn-default" data-toggle="modal" data-target="#addBrandModal"><i class="glyphicon glyphicon-plus-sign"></i>Add Brand</button>
			</div>
			<table class="table" id="manageBrandTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Brand name</th>
						<th>Company</th>
						<th>Status</th>
						<th style="width: 15%;">Operations</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>


<!-- Add Brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="addBrandModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-plus"></i>Add Brand</h4>
      </div>
      <form class="form-horizontal" action="action/createBrand.php" method="POST" id="submitBrandForm">
      <div class="modal-body">
      	<div class="message"></div>
        
		  <div class="form-group">
		    <label for="BrandName" class="col-sm-3 control-label">Brand Name</label>
		    <div class="col-sm-9">
		      <input type="text" name="brand_name" class="form-control" id="BrandName" placeholder="Enter Brand Name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="company" class="col-sm-3 control-label">Company</label>
		    <div class="col-sm-9">
		      <input type="text" name="company_name" class="form-control" id="company" placeholder="Enter Company Name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-3 control-label">Status</label>
		    <div class="col-sm-9">
		      <select name="status" class="form-control" id="status">
		      	<option value="">Select status</option>
		      	<option value="1">Available</option>
		      	<option value="0">Not Available</option>
		      </select>
		    </div>
		  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" id="createBrandBtn" data-loading-text="Loading..">Save changes</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- EditBrandModal -->
<div class="modal fade" tabindex="-1" role="dialog"  id="editBrandModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <form class="form-horizontal" action="action/editBrand.php" method="POST" id="editBrandForm">
	      <div class="modal-body">
	      	<div class="edit-msg"></div>
	        
			  <div class="form-group">
			    <label for="editBrandName" class="col-sm-3 control-label">Brand Name</label>
			    <div class="col-sm-9">
			      <input type="text" name="editBrandName" class="form-control" id="editBrandName" placeholder="Enter Brand Name">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="editCompanyName" class="col-sm-3 control-label">Company</label>
			    <div class="col-sm-9">
			      <input type="text" name="editCompanyName" class="form-control" id="editCompanyName" placeholder="Enter Company Name">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-3 control-label">Status</label>
			    <div class="col-sm-9">
			      <select name="status" class="form-control" id="status">
			      	<option value="">Select status</option>
			      	<option value="1">Available</option>
			      	<option value="0">Not Available</option>
			      </select>
			    </div>
			  </div>
	      </div>
	      <div class="modal-footer editBrandFooter" id="editBrandFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button class="btn btn-primary" id="editBrandBtn" data-loading-text="Loading..">Save changes</button>
	      </div>
      </form>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Remove Brand Modal -->
<div class="modal fade" tabindex="-1" role="dialog"  id="removeBrandModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i>Remove Brand</h4>
        <p class="brandRemoveMessage"></p>
      </div>
      <div class="modal-body">
	        <p>Do you really want to remove the Brand?</p>
	      </div>
	      <div class="modal-footer">
	        <a type="button" class="btn btn-default" data-dismiss="modal">Cancel</a>
	        <button class="btn btn-primary" id="removeBrandBtn">Remove</button>
	      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php require 'require/footer.php'; ?>
<script src="custom/js/brand.js" type="text/javascript"></script>
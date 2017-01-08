<?php require 'require/header.php'; ?>
<link rel="stylesheet" type="text/css" href="custom/css/style.css"/>
<div class="container">
  <!-- <h2>Category management</h2> -->

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Manage Category</a></li>
    <li><a data-toggle="tab" href="#menu1">Add Category</a></li>
  </ul>

<!-- Category management -->
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     <ol class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li><a href="category.php">Category</a></li>
      <li class="active">Manage Category</li>
    </ol>

<div class="panel panel-info">
  <div class="panel-heading">
    <h2 class="panel-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Category Management</h2>
  </div>
  <div class="panel-body">
  
<div class="cat-content">
<div class="categoryRemoveMessage"></div>
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
          <label for="search">Search</label>
          <input type="text" name="search" id="search">
      </div>  
    </div>
    <div class="result"></div>


    <table class="table table-hover" >
    <thead style="border-top: 4px solid rgba(167, 152, 164, 0.34);">
      <tr>
        <th>#</th>
        <th>Category Name</th>
        <th>Status</th>
        <th class="text-center">Operation</th>
      </tr>
    </thead>

    <tbody>
    <?php 
    $serial=1;
    $sql="select * from category";
    $result=$connection->query($sql);
    if ($result->num_rows>0) {
      while ($row=$result->fetch_assoc()) {
        

     ?>
      <?php if ($row['status']==1) {?>
        <tr class="success">
        <td><?php echo $serial++; ?></td>
        <td><?php echo $row['cat_name']; ?></td>
        <td><span class="label label-success">Available</span></td>
        <td class="text-center"><a type="button" data-toggle="modal" onclick="editCategory('<?php echo $row['cat_id']; ?>')" data-target="#editCategoryModal" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span>Edit</a> <a type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteCategoryModal" onclick="deleteCategory('<?php echo $row['cat_id']; ?>')"><span class="glyphicon glyphicon-trash
"></span>Delete</a></td>
      </tr>

      <?php }elseif ($row['status']==0) {?>
        <tr class="danger">
        <td><?php echo $serial++; ?></td>
        <td><?php echo $row['cat_name']; ?></td>
        <td><span class="label label-danger">Not available</span></td>
        <td class="text-center"><a type="button" data-toggle="modal" data-target="#editCategoryModal" onclick="editCategory('<?php echo $row['cat_id']; ?>')" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span>Edit</a> <a type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteCategoryModal" onclick="deleteCategory('<?php echo $row['cat_id']; ?>')"><span class="glyphicon glyphicon-trash
"></span>Delete</a></td>
      </tr>
     <?php } ?>
      <?php 

      }
    }
      ?>
    </tbody>

    </table>

</div>
</div>
</div>


  
    </div>
    <div id="menu1" class="tab-pane fade">
    <ol class="breadcrumb">
      <li><a href="index.php">Home</a></li>
      <li><a href="category.php">Category</a></li>
      <li class="active">Add Category</li>
    </ol>
    <?php
    $arr=array(); 
    if ($_POST) {
      $cat_name=$_POST['cat_name'];
      $status=$_POST['status'];
      if (empty($cat_name)) {
        $arr[]="Field cant't be empty";
      }else{
        $sql="SELECT * FROM category WHERE cat_name='$cat_name'";
        $result=$connection->query($sql);
        if ($result->num_rows==0) {
          $catSql="INSERT INTO category(cat_name, status) VALUES('$cat_name','$status')";
          if ($connection->query($catSql)) {
            $arr[]="Category is inserted successfully";
          }else{
            $arr[]="Category is not inserted!!";
          }
        }else{
          $arr[]="Category is exists!";
        }
      }
    }
    $brand= "SELECT * FROM brand WHERE status=1";
    $brand_rs=$connection->query($brand);

     ?>
     <div class="msg">
       
     </div>
    <form class="form-horizontal" action="" method="POST" id="createCategoryForm">
      <div class="form-group">
        <label for="cat_name" class="col-sm-2 control-label">Category Name</label>
        <div class="col-sm-10">
          <input type="text" name="cat_name" class="form-control" id="cat_name" placeholder="Enter Category name" required>
        </div>
      </div>
       <div class="form-group">
              <label for="status-name" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select name="status" class="form-control" id="status">
                  <option value="">Select</option>
                  <option value="1">Available</option>
                  <option value="0">Not Available</option>
              </select>
              </div>
            </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button class="btn btn-primary" id="createCategoryBtn">Add Category</button>
        </div>
      </div>
    </form>
    </div>
    
  </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" tabindex="-1" role="dialog"  id="editCategoryModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i>Edit Category</h4>
      </div>
      <form class="form-horizontal" action="action/editCategory.php" method="POST" id="editCategoryForm">
        <div class="modal-body">
        <div class="edit-msg"></div>
          
        <div class="form-group">
          <label for="edit_cat_name" class="col-sm-3 control-label">Category Name</label>
          <div class="col-sm-9">
            <input type="text" name="edit_cat_name" class="form-control" id="edit_cat_name" placeholder="Enter Category Name">
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
        <div class="modal-footer editCategoryFooter" id="editCategoryFooter">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" id="editCategoryBtn" data-loading-text="Loading..">Save changes</button>
        </div>
      </form>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Delete Category Modal -->
<div class="modal fade" tabindex="-1" role="dialog"  id="deleteCategoryModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i>Delete Category</h4>
      </div>
        <div class="modal-body">
          <p>Do you really want to delete category?</p>
        </div>
        <div class="modal-footer" id="editCategoryFooter">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" id="deleteCategoryBtn" data-loading-text="Loading..">Delete</button>
        </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php require 'require/footer.php'; ?>
<!-- <script src="custom/js/creacat.js" type="text/javascript"></script> -->
<script src="custom/js/category.js" type="text/javascript"></script>

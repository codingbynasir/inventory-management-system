
function deleteCategory (cat_id=null) {
	 // alert(cat_name);
	if (cat_id) {
		$("#deleteCategoryBtn").unbind('click').bind('click',function() {
			$.ajax({
				url: 'action/deleteCategory.php',
				type: 'POST',
				data: {cat_id:cat_id},
				dataType: 'json',
				success:function (response) {
					if (response.success==true) {
						$("#deleteCategoryModal").modal('hide');
						location.reload();
						$(".categoryRemoveMessage").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong>'+response.messages+'</div>');
					}
				}
				
			});
			
		});
	}
}

function editCategory (cat_id=null) {
	if (cat_id) {
		// remove hidden brand id text
		$('#cat_id').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-brand-result').addClass('div-hide');
		// modal footer
		$('.editCategoryFooter').addClass('div-hide');
		$.ajax({
			url: 'action/selectCategory.php',
			type: 'POST',
			data: {cat_id : cat_id},
			dataType: 'json',
			success:function (response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-category-result').removeClass('div-hide');
				// modal footer
				$('.editCategoryFooter').removeClass('div-hide');

				$("#edit_cat_name").val(response.cat_name);
				$("#status").val(response.status);
				$(".editCategoryFooter").after('<input type="hidden" name="cat_id" id="cat_id" value="'+response.cat_id+'" />');
				// update brand form 
				$('#editCategoryForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var catName = $('#edit_cat_name').val();
					var status = $('#status').val();
					

					if(catName == "") {
						$("#edit_cat_name").after('<p class="text-danger">Brand Name field is required</p>');
						$('#edit_cat_name').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#edit_cat_name").find('.text-danger').remove();
						// success out for form 
						$("#edit_cat_name").closest('.form-group').addClass('has-success');	  	
					}


					if(status == "") {
						$("#status").after('<p class="text-danger">Status field is required</p>');

						$('#status').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#status").find('.text-danger').remove();
						// success out for form 
						$("#status").closest('.form-group').addClass('has-success');	  	
					}

					if(catName && status) {
						var form = $(this);

						$('#editCategoryBtn').button('loading');
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editCategoryBtn').button('reset');

									// reload the manage member table 
									location.reload();						  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('.edit-msg').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update brand form

			}
			
		});
	}

}
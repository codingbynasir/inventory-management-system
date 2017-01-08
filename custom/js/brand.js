var manageBrandTable;
$(document).ready(function(){
	$("#navbar-nav").addClass('active');
	manageBrandTable=$("#manageBrandTable").DataTable({
		'ajax' : 'action/fetchBrand.php',
		'order': []
	});

	$("#submitBrandForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$(".form-group").removeClass('has-error');
		var brandName=$("#BrandName").val();
		var companyName=$("#company").val();
		var status= $("#status").val();
		if (brandName=="") {
			$("#BrandName").after('<p class="text-danger">Brand name is required</p>');
			$("#BrandName").closest('.form-group').addClass('has-error');
		}else{
			$("#BrandName").find('.text-danger').remove();
			$("#BrandName").closest('.form-group').addClass('has-success');
		}

		if (companyName=="") {
			$("#company").after('<p class="text-danger">Company name is required</p>');
			$("#company").closest('.form-group').addClass('has-error');
		}else{
			$("#company").find('.text-danger').remove();
			$("#company").closest('.form-group').addClass('has-success');
		}

		if (status=="") {
			$("#status").after('<p class="text-danger">Status is required</p>');
			$("#status").closest('.form-group').addClass('has-error');
		}else{
			$("#status").find('.text-danger').remove();
			$("#status").closest('.form-group').addClass('has-success');
		}

		if (brandName && companyName && status) {
			var form =$(this);
			$("#createBrandBtn").button('loading');
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data:form.serialize(),
				dataType: 'json',
				success:function(response){
					$("#createBrandBtn").button('reset');
					if (response.success==true) {
						manageBrandTable.ajax.reload(null,false);
						$("#submitBrandForm")[0].reset();
						$(".text-danger").remove();
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".message").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong>'+response.messages+'</div>');
					}
				}
			});
		}
		return false;
	});
});
function removeBrand(brand_id=null) {
	if (brand_id) {
		$("#removeBrandBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: 'action/deleteBrand.php',
				type: 'POST',
				data: {brand_id:brand_id},
				dataType: 'json',
				success:function (response) {
					if (response.success==true) {
						$("#removeBrandModal").modal('hide');
						manageBrandTable.ajax.reload(null,false);
						$(".brandRemoveMessage").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong>'+response.messages+'</div>');
					}
				}
				
			});
			
		});
	}
}
function editBrand(brand_id=null) {
	if (brand_id) {
		// remove hidden brand id text
		$('#brand_id').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-brand-result').addClass('div-hide');
		// modal footer
		$('.editBrandFooter').addClass('div-hide');
		$.ajax({
			url: 'action/selectBrand.php',
			type: 'POST',
			data: {brand_id : brand_id},
			dataType: 'json',
			success:function (response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-brand-result').removeClass('div-hide');
				// modal footer
				$('.editBrandFooter').removeClass('div-hide');

				$("#editBrandName").val(response.brand_name);
				$("#editCompanyName").val(response.company);
				$("#status").val(response.status);
				$(".editBrandFooter").after('<input type="hidden" name="brand_id" id="brand_id" value="'+response.brand_id+'" />');
				// update brand form 
				$('#editBrandForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var brandName = $('#editBrandName').val();
					var companyName=$('#editCompanyName').val();
					var status = $('#status').val();
					

					if(brandName == "") {
						$("#editBrandName").after('<p class="text-danger">Brand Name field is required</p>');
						$('#editBrandName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editBrandName").find('.text-danger').remove();
						// success out for form 
						$("#editBrandName").closest('.form-group').addClass('has-success');	  	
					}

					if(companyName == "") {
						$("#editCompanyName").after('<p class="text-danger">Company Name field is required</p>');
						$('#editCompanyName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editCompanyName").find('.text-danger').remove();
						// success out for form 
						$("#editCompanyName").closest('.form-group').addClass('has-success');	  	
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

					if(brandName && companyName && status) {
						var form = $(this);

						$('#editBrandBtn').button('loading');
						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editBrandBtn').button('reset');

									// reload the manage member table 
									manageBrandTable.ajax.reload(null, false);								  	  										
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
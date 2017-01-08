$(document).ready(function() {
	$('#createCategoryForm').unbind('submit').bind('submit', function() {
		var cat_name=$('#cat_name').val();
		var status=$('#brandStatus').val();
		if (cat_name=="") {
			$('#cat_name').after('<p class="text-danger">Category name is required</p>');
			$('#cat_name').closest('.form-group').addClass('has-error');
			$('#cat_name').closest('.form-group').removeClass('has-success');
		}else{
			$('#cat_name').find('.text-danger').remove();
			$('#cat_name').closest('.form-group').removeClass('has-error');
			$('#cat_name').closest('.form-group').addClass('has-success');
		}

		if (status=="") {
			$('#status').after('<p class="text-danger">Select a status</p>');
			$('#status').closest('.form-group').addClass('has-error');
			$('#status').closest('.form-group').removeClass('has-success');
		}else{
			$('#status').find('.text-danger').remove();
			$('#status').closest('.form-group').removeClass('has-error');
			$('#status').closest('.form-group').addClass('has-success');
		}
		if (cat_name && status) {
			var form=$(this);
			$('#createCategoryBtn').button('loading');
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data:form.serialize(),
				dataType: 'json',
				success:function(response){
					$("#createCategoryBtn").button('reset');
					if (response.success==true) {
						$("#createCategoryForm")[0].reset();
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".msg").html(response.messages);
					}
				}
			});
		}

		return false;
	});
});
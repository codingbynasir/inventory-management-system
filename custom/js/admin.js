$(document).ready(function() {
	$("#submitAdminForm").unbind('submit').bind('submit', function() {
		$(".text-danger").remove();
		$(".form-group").removeClass('has-error');
		var name = $("#name").val();
		var username=$("#username").val();
		var email=$("#email").val();
		var password=$("#password").val();
		if (name=="" || username=="" || email=="" || password=="") {
			$(".msg").html('<div class="empty_message"><div class="alert alert-warning alert-dismissible text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-exclamation-triangle"></i> </strong>Following field must not be empty</div></div>');
		}else{
			$(".msg").removeClass('empty_message');
		}
		if (name=="") {
			$("#name").after('<p class="text-danger">Name is required</p>');
			$("#name").closest('.form-group').addClass('has-error');
			$("#name").closest('.form-group').removeClass('has-success');
		}else{
			$(".text-danger").remove();
			$("#name").closest('.form-group').addClass('has-success');
			$("#name").closest('.form-group').removeClass('has-error');	
		}
		if (username=="") {
			$("#username").after('<p class="text-danger">Username is required</p>');
			$("#username").closest('.form-group').addClass('has-error');
			$("#username").closest('.form-group').removeClass('has-success');
		}else{
			$(".text-danger").remove();
			$("#username").closest('.form-group').addClass('has-success');
			$("#username").closest('.form-group').removeClass('has-error');	
		}
		if (email=="") {
			$("#email").after('<p class="text-danger">Email is required</p>');
			$("#email").closest('.form-group').addClass('has-error');
			$("#email").closest('.form-group').removeClass('has-success');
		}else{
			$(".text-danger").remove();
			$("#email").closest('.form-group').addClass('has-success');
			$("#email").closest('.form-group').removeClass('has-error');	
		}
		if (password=="") {
			$("#password").after('<p class="text-danger">Password is required</p>');
			$("#password").closest('.form-group').addClass('has-error');
			$("#password").closest('.form-group').removeClass('has-success');
		}else{
			$(".text-danger").remove();
			$("#password").closest('.form-group').addClass('has-success');
			$("#password").closest('.form-group').removeClass('has-error');	
		}
		if (name && username && email && password) {
			var form =$(this);
			$("#newAdminBtn").button('loading');
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data:form.serialize(),
				dataType: 'json',
				success:function(response){
					$("#newAdminBtn").button('reset');
					if (response.success==true) {
						$("#submitAdminForm")[0].reset();
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".msg").html(response.messages);
					}
				}
			});
		}
		return false;
	});
});
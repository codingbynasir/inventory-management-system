$(document).ready(function() {
	$("#submitRegisterForm").unbind('submit').bind('submit', function() {
		var name=$("#name").val();
		var username=$("#username").val();
		var email=$("#email").val();
		var password=$("#password").val();
		var mobile=$("#mobile").val();
		if (name=="") {
			$("#name").closest('.form-group').addClass('has-error');
		}else{
			$("#name").closest('.form-group').removeClass('has-error');
			$("#name").closest('.form-group').addClass('has-success');
		}
		if (username=="") {
			$("#username").closest('.form-group').addClass('has-error');
		}else{
			$("#username").closest('.form-group').removeClass('has-error');
			$("#username").closest('.form-group').addClass('has-success');
		}

		if (email=="") {
			$("#email").closest('.form-group').addClass('has-error');
		}else{
			$("#email").closest('.form-group').removeClass('has-error');
			$("#email").closest('.form-group').addClass('has-success');
		}

		if (password=="") {
			$("#password").closest('.form-group').addClass('has-error');
		}else{
			$("#password").closest('.form-group').removeClass('has-error');
			$("#password").closest('.form-group').addClass('has-success');
		}

		if (mobile=="") {
			$("#mobile").closest('.form-group').addClass('has-error');
		}else{
			$("#mobile").closest('.form-group').removeClass('has-error');
			$("#mobile").closest('.form-group').addClass('has-success');
		}

		if (name && username && email && password && mobile) {
			var form =$(this);
			$("#registerFormBtn").button('loading');
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response){
					$("#registerFormBtn").button('reset');
					if (response.success==true) {
						$("#submitRegisterForm")[0].reset();
						$(".form-group").removeClass('has-error')
						$(".form-group").removeClass('has-success');
						$("#msg").html(response.messages);
					}
				}
			});
		}
		return false;

	});
});
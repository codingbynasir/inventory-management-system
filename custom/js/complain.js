$(document).ready(function() {
	$('#createComplainForm').unbind('submit').bind('submit', function() {
		$('.form-group').removeClass('has-error');
		$('.form-group').removeClass('has-success');
		$('.text-danger').remove();
		var username= $('#username').val();
		var email= $('#email').val();
		var website= $('#website').val();
		var title= $('#title').val();
		var complain= $('#complain').val();
		if (username=="") {
			$('#username').after('<p class="text-danger">Name is required</p>');
			$('#username').closest('.form-group').addClass('has-error');
		}else{
			$('.text-danger').remove();
			$('#username').closest('.form-group').removeClass('has-error');
			$('#username').closest('.form-group').addClass('has-success');
		}
		if (email=="") {
			$('#email').after('<p class="text-danger">Email is required</p>');
			$('#email').closest('.form-group').addClass('has-error');
		}else{
			$('.text-danger').remove();
			$('#email').closest('.form-group').removeClass('has-error');
			$('#email').closest('.form-group').addClass('has-success');
		}
		if (title=="") {
			$('#title').after('<p class="text-danger">Title is required</p>');
			$('#title').closest('.form-group').addClass('has-error');
		}else{
			$('.text-danger').remove();
			$('#title').closest('.form-group').removeClass('has-error');
			$('#title').closest('.form-group').addClass('has-success');
		}
		if (complain=="") {
			$('#complain').after('<p class="text-danger">Complain is required</p>');
			$('#complain').closest('.form-group').addClass('has-error');
		}else{
			$('.text-danger').remove();
			$('#complain').closest('.form-group').removeClass('has-error');
			$('#complain').closest('.form-group').addClass('has-success');
		}
		if (username && title && complain) {
			var form=$(this);
			$("#createComplainBtn").button('loading');
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					$("#createComplainBtn").button('reset');
					if (response.success==true) {
						$("#createComplainForm")[0].reset();
						$('.text-danger').remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');
						$(".message").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong>'+response.messages+'</div>');
					}
				}

			});
			
		}
		return false;
	});
});
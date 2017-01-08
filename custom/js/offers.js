$(document).ready(function() {
	$("#submitOfferForm").unbind('submit').bind('submit', function() {
		var sku = $("#sku").val();
		var offer_type=$("#offer_type").val();
		var amount=$("#amount").val();
		var status=$("#status").val();
		if (sku=="" || offer_type=="" || amount=="" || status=="") {
			$(".msg").html('<div class="empty_message"><div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-exclamation-triangle"></i> </strong>Following field must not be empty</div></div>');
		}else{
			$(".msg").removeClass('empty_message');
		}
		if (sku=="") {
			$("#sku").closest('.form-group').addClass('has-error');
			$("#sku").closest('.form-group').removeClass('has-success');
		}else{
			$("#sku").closest('.form-group').addClass('has-success');
			$("#sku").closest('.form-group').removeClass('has-error');	
		}
		if (offer_type=="") {
			$("#offer_type").closest('.form-group').addClass('has-error');
			$("#offer_type").closest('.form-group').removeClass('has-success');
		}else{
			$("#offer_type").closest('.form-group').addClass('has-success');
			$("#offer_type").closest('.form-group').removeClass('has-error');	
		}
		if (amount=="") {
			$("#amount").closest('.form-group').addClass('has-error');
			$("#amount").closest('.form-group').removeClass('has-success');
		}else{
			$("#amount").closest('.form-group').addClass('has-success');
			$("#amount").closest('.form-group').removeClass('has-error');	
		}
		if (status=="") {
			$("#status").closest('.form-group').addClass('has-error');
			$("#status").closest('.form-group').removeClass('has-success');
		}else{
			$("#status").closest('.form-group').addClass('has-success');
			$("#status").closest('.form-group').removeClass('has-error');	
		}
		if (sku && offer_type && amount && status) {
			var form =$(this);
			$("#offerSubmitBtn").button('loading');
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data:form.serialize(),
				dataType: 'json',
				success:function(response){
					$("#offerSubmitBtn").button('reset');
					if (response.success==true) {
						$("#submitOfferForm")[0].reset();
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".msg").html(response.messages);
					}
				}
			});
		}
		return false;
	});


	$("#updateOfferForm").unbind('submit').bind('submit', function() {
		var sku = $("#sku").val();
		var offer_type=$("#offer_type").val();
		var amount=$("#amount").val();
		var status=$("#status").val();
		if (sku=="" || offer_type=="" || amount=="" || status=="") {
			$(".msg").html('<div class="empty_message"><div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="fa fa-exclamation-triangle"></i> </strong>Following field must not be empty</div></div>');
		}else{
			$(".msg").removeClass('empty_message');
		}
		if (sku=="") {
			$("#sku").closest('.form-group').addClass('has-error');
			$("#sku").closest('.form-group').removeClass('has-success');
		}else{
			$("#sku").closest('.form-group').addClass('has-success');
			$("#sku").closest('.form-group').removeClass('has-error');	
		}
		if (offer_type=="") {
			$("#offer_type").closest('.form-group').addClass('has-error');
			$("#offer_type").closest('.form-group').removeClass('has-success');
		}else{
			$("#offer_type").closest('.form-group').addClass('has-success');
			$("#offer_type").closest('.form-group').removeClass('has-error');	
		}
		if (amount=="") {
			$("#amount").closest('.form-group').addClass('has-error');
			$("#amount").closest('.form-group').removeClass('has-success');
		}else{
			$("#amount").closest('.form-group').addClass('has-success');
			$("#amount").closest('.form-group').removeClass('has-error');	
		}
		if (status=="") {
			$("#status").closest('.form-group').addClass('has-error');
			$("#status").closest('.form-group').removeClass('has-success');
		}else{
			$("#status").closest('.form-group').addClass('has-success');
			$("#status").closest('.form-group').removeClass('has-error');	
		}
		if (sku && offer_type && amount && status) {
			var form =$(this);
			$("#updateOfferBtn").button('loading');
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data:form.serialize(),
				dataType: 'json',
				success:function(response){
					$("#updateOfferBtn").button('reset');
					if (response.success==true) {
						$("#updateOfferForm")[0].reset();
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".msg").html(response.messages);
					}
				}
			});
		}
		return false;
	});
});

function deleteOffer(offer_id=null) {
	if (offer_id) {
		$("#deleteOfferBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: 'action/deleteOffer.php',
				type: 'POST',
				data: {offer_id:offer_id},
				dataType: 'json',
				success:function (response) {
					if (response.success==true) {
						$("#deleteOfferModal").modal('hide');
						location.reload();
						$(".offerRemoveMessage").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong>'+response.messages+'</div>');
					}
				}
				
			});
			
		});
	}
}

function deleteProduct (sku=null){
	if (sku) {
		$("#deleteProductBtn").unbind('click').bind('click',function() {
			$.ajax({
				url: 'action/deleteProduct.php',
				type: 'POST',
				data: {sku : sku},
				dataType: 'json',
				success:function (response) {
					if (response.success==true) {
						$("#deleteProductModal").modal('hide');
						location.reload();
						$(".productRemoveMessage").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok-sign"></i></strong>'+response.messages+'</div>');
					}
				}	
			});
		});
	}	
}
function editProduct(sku=null) {
	if (sku) {
		
	}
}
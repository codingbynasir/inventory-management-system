$(document).ready(function() {
	
$("#editOrderForm").unbind('submit').bind('submit', function() {
		var date=$("#date").val();
		var customer_name=$("#customer_name").val();
		var contact=$("#contact").val();
		var product=$("#product").val();
		var price=$("#price").val();
		var quantity=$("#quantity").val();
		var subTotal=$("#subTotal").val();
		var vat=$("#vat").val();
		var total=$("#total").val();
		var discount=$("#discount").val();
		var grand_total=$("#grand_total").val();
		var paid_amount=$("#paid_amount").val();
		var due_amount=$("#due_amount").val();
		var payment_type=$("#payment_type").val();
		var payment_status=$("#payment_status").val();
		if (date=="") {
			$("#date").after('<p class="text-danger">Date is required</p>');
			$("#date").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#date").closest('.form-group').removeClass('has-error');
			$("#date").closest('.form-group').addClass('has-success');
		}
		if (customer_name=="") {
			$("#customer_name").after('<p class="text-danger">Customer username is required</p>');
			$("#customer_name").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#customer_name").closest('.form-group').removeClass('has-error');
			$("#customer_name").closest('.form-group').addClass('has-success');
		}
		if (contact=="") {
			$("#contact").after('<p class="text-danger">Contact number is required</p>');
			$("#contact").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#contact").closest('.form-group').removeClass('has-error');
			$("#contact").closest('.form-group').addClass('has-success');
		}
		if (product=="") {
			$("#product").after('<p class="text-danger">Product is required</p>');
			$("#product").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#product").closest('.form-group').removeClass('has-error');
			$("#product").closest('.form-group').addClass('has-success');
		}
		if (price=="") {
			$("#price").after('<p class="text-danger">Price is required</p>');
			$("#price").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#price").closest('.form-group').removeClass('has-error');
			$("#price").closest('.form-group').addClass('has-success');
		}
		if (quantity=="") {
			$("#quantity").after('<p class="text-danger">Quantity is required</p>');
			$("#quantity").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#quantity").closest('.form-group').removeClass('has-error');
			$("#quantity").closest('.form-group').addClass('has-success');
		}
		if (subTotal=="") {
			$("#subTotal").after('<p class="text-danger">Sub total is required</p>');
			$("#subTotal").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#subTotal").closest('.form-group').removeClass('has-error');
			$("#subTotal").closest('.form-group').addClass('has-success');
		}
		if (vat=="") {
			$("#vat").after('<p class="text-danger">Vat is required</p>');
			$("#vat").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#vat").closest('.form-group').removeClass('has-error');
			$("#vat").closest('.form-group').addClass('has-success');
		}
		if (total=="") {
			$("#total").after('<p class="text-danger">Total is required</p>');
			$("#total").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#total").closest('.form-group').removeClass('has-error');
			$("#total").closest('.form-group').addClass('has-success');
		}
		if (discount=="") {
			$("#discount").after('<p class="text-danger">Discount is required</p>');
			$("#discount").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#discount").closest('.form-group').removeClass('has-error');
			$("#discount").closest('.form-group').addClass('has-success');
		}
		if (grand_total=="") {
			$("#grand_total").after('<p class="text-danger">Grand total is required</p>');
			$("#grand_total").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#grand_total").closest('.form-group').removeClass('has-error');
			$("#grand_total").closest('.form-group').addClass('has-success');
		}
		if (paid_amount=="") {
			$("#paid_amount").after('<p class="text-danger">Paid amount is required</p>');
			$("#paid_amount").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#paid_amount").closest('.form-group').removeClass('has-error');
			$("#paid_amount").closest('.form-group').addClass('has-success');
		}
		if (due_amount=="") {
			$("#due_amount").after('<p class="text-danger">Due amount is required</p>');
			$("#due_amount").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#due_amount").closest('.form-group').removeClass('has-error');
			$("#due_amount").closest('.form-group').addClass('has-success');
		}
		if (payment_type=="") {
			$("#payment_type").after('<p class="text-danger">Payment type is required</p>');
			$("#payment_type").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#payment_type").closest('.form-group').removeClass('has-error');
			$("#payment_type").closest('.form-group').addClass('has-success');
		}
		if (payment_status=="") {
			$("#payment_status").after('<p class="text-danger">Payment status is required</p>');
			$("#payment_status").closest('.form-group').addClass('has-error');
		}else{
			$(".text-danger").remove();
			$("#payment_status").closest('.form-group').removeClass('has-error');
			$("#payment_status").closest('.form-group').addClass('has-success');
		}
		if (date && customer_name && contact && price) {
			var form =$(this);
			$("#editOrderBtn").button('loading');
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data:form.serialize(),
				dataType: 'json',
				success:function(response){
					$("#orderBtn").button('reset');
					if (response.success==true) {
						$("#editOrderForm")[0].reset();
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".msg").html(response.messages);
					}
				}
			});
		}
		return false;
	});
});
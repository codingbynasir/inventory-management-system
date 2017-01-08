<?php
	require 'db_connection.php';
	$valid['success'] = array('success' => false, 'messages' => array());
	if ($_POST) {
		$date=$_POST['date'];
		$customer_name=$_POST['customer_name'];
		$contact=$_POST['contact'];
		$product=$_POST['product'];
		$price=$_POST['price'];
		$quantity=$_POST['quantity'];
		$subTotal=$_POST['subTotal'];
		$vat=$_POST['vat'];
		$total=$_POST['total'];
		$discount=$_POST['discount'];
		$grand_total=$_POST['grand_total'];
		$paid_amount=$_POST['paid_amount'];
		$due_amount=$_POST['due_amount'];
		$payment_type=$_POST['payment_type'];
		$payment_status=$_POST['payment_status'];
		$sql = "INSERT INTO `orders` (`order_id`, `order_date`, `name`, `contact`, `sku`, `quantity`, `sub_total`, `vat`, `total_price`, `grand_total`, `payment_type`, `order_status`) VALUES (NULL,'$date', '$customer_name', '$contact', '$product', '$quantity', '$subTotal', '$vat', '$total', '$grand_total', '$payment_type', '$payment_status')";
		// $sql="INSERT INTO orders(order_id, order_date, name, contact, sku, quantity, sub_total, vat, total, grand_total,payment_type, order_status) VALUES('',$date','$customer_name',$contact,'$product','$quantity','$subTotal','$vat','$total','$grand_total','$payment_type','$payment_status')";
			if ($connection->query($sql)==true) {
				$valid['success']=true;
				$valid['messages']='<div class="alert alert-success alert-dismissible text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="glyphicon glyphicon-ok-sign"></i> </strong>Order added successfully</div>';
			}else{
				$valid['success']=true;
				$valid['messages']='<div class="alert alert-error alert-dismissible text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><span class="glyphicon glyphicon-remove"></span> </strong>Sorry, Order is not completely added</div>';
			}
		$connection->close();
		echo json_encode($valid);
	}

?>
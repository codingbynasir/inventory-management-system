<?php require 'db_connection.php';
$valid['success'] = array('success' => true, 'messages'=>array() );
if ($_POST) {
	$username=$_POST['username'];
	$website=$_POST['website'];
	$title=$_POST['title'];
	$complain=$_POST['complain'];
	$date=date("F j, Y");
	$time= date("h:i:sa");
	$sql="INSERT INTO complain(username,website,title,complain, time, date) VALUES('$username','$website','$title','$complain','$time','$date')";
	if ($connection->query($sql)==true) {
		$valid['success']=true;
		$valid['messages']="Complain is added successfully";
	}else{
		$valid['success']=true;
		$valid['messages']="Complain is not added";
	}
	$connection->close();
	echo json_encode($valid);
}
 ?>
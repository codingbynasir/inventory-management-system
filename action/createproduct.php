<?php 
class product
{
	
	function __construct(){}
	public function createProduct($product_name,$description,$filename,$destination,$brand_name,$cat_name,$quantity,$price,$expire_date,$sku_code,$status){
		if (move_uploaded_file($filename, $destination)){
			$connection= new mysqli("localhost","root","","inventory");
			$insert_sql="INSERT INTO product(product_name,description,product_images,brand_name,cat_name,quantity,price,sku,expire_date,status) VALUES('$product_name','$description','$destination','$brand_name','$cat_name','$quantity','$price','$sku_code','$expire_date','$status')";
				if ($connection->query($insert_sql)) {
					return TRUE;
				}else{
					return FALSE;
				}
		}else{
			return FALSE;
		}
	}
}


?>
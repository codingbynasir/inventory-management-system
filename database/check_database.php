<?php require 'require/style.php'; ?>
<?php 

class createDatabase
{
	
	function __construct(){}
	public function create_db(){
		$conn= new mysqli('localhost','root','');
		$dbSql="CREATE DATABASE inventory";
		if ($conn->query($dbSql)) {
			$connection=new mysqli('localhost','root','','inventory');
			$adminSql="CREATE TABLE admin(
				name VARCHAR(50) NOT NULL,
				username VARCHAR(50) NOT NULL,
				email VARCHAR(50) NOT NULL,
				password VARCHAR(50) NOT NULL,
				PRIMARY KEY(username)
			)";
			$password=md5("password");
			$adminInsert="INSERT INTO admin(name,username,email,password) VALUES('admin','admin','admin@gmail.com','$password')";
			$customerSql="CREATE TABLE customer(
				name VARCHAR(50) NOT NULL,
				username VARCHAR(50) NOT NULL,
				email VARCHAR(100) NOT NULL,
				password VARCHAR(50) NOT NULL,
				mobile VARCHAR(15),
				shipping_location VARCHAR(200),
				billing_method VARCHAR(100),
				PRIMARY KEY(username)
			)";
			$brandSql= "CREATE TABLE brand(
				brand_id int NOT NULL AUTO_INCREMENT ,
				brand_name VARCHAR(50) NOT NULL,
				company VARCHAR(50) NOT NULL,
				status int NOT NULL,
				UNIQUE(brand_id),
				PRIMARY KEY(brand_name)
			)";
			$categorySql= "CREATE TABLE category(
				cat_id int not null AUTO_INCREMENT,
				cat_name VARCHAR(60) NOT NULL,
				status int NOT NULL,
				UNIQUE(cat_id),
				PRIMARY KEY(cat_name)
				-- CONSTRAINT FOREIGN KEY(brand_name) references brand(brand_name)
				-- ON DELETE CASCADE
			)";
			$productSql="CREATE TABLE product(
				sku VARCHAR(10) NOT NULL,
				product_name VARCHAR(100) NOT NULL,
				description VARCHAR(200) NOT NULL,
				product_images VARCHAR(200) NOT NULL,
				brand_name VARCHAR(50) NOT NULL,
				cat_name VARCHAR(60) NOT NULL,
				quantity INT NOT NULL,
				price NUMERIC(7,2) NOT NULL,
				expire_date VARCHAR(20),
				status int NOT NULL,
				PRIMARY KEY(sku),
				CONSTRAINT FOREIGN KEY(brand_name) REFERENCES brand(brand_name)
				ON DELETE CASCADE,
				CONSTRAINT FOREIGN KEY(cat_name) REFERENCES category(cat_name)
				ON DELETE CASCADE
			)";
			$offersSql="CREATE TABLE offers(
				offer_id int not null AUTO_INCREMENT,
				sku VARCHAR(10) NOT NULL,
				type VARCHAR(20) NOT NULL,
				active_status VARCHAR(15),
				amount int,
				PRIMARY KEY(offer_id),
				CONSTRAINT FOREIGN KEY(sku) REFERENCES product(sku)
				ON DELETE CASCADE
			)";
			$complainSql="CREATE TABLE complain(
				complain_id int not null AUTO_INCREMENT,
    			cus_username VARCHAR(60),
				type VARCHAR(50),
				message VARCHAR(200),
				PRIMARY KEY(complain_id),
    			CONSTRAINT FOREIGN KEY(cus_username) REFERENCES customer(username)
    			ON DELETE CASCADE
			)";
			$orderSql="CREATE TABLE orders(
				date VARCHAR(20) NOT NULL,
				order_id int not null AUTO_INCREMENT,
				name VARCHAR(60),
				sku VARCHAR(10),
				quantity int,
				sub_total NUMERIC(10,2),
				vat NUMERIC(6,2),
				total_price NUMERIC(10,2),
				PRIMARY KEY(order_id),
				CONSTRAINT FOREIGN KEY(sku) REFERENCES product(sku)
				ON DELETE SET NULL

			)";

			if ($connection->query($adminSql) && $connection->query($adminInsert) && $connection->query($customerSql) && $connection->query($brandSql) && $connection->query($categorySql) && $connection->query($productSql) && $connection->query($offersSql) && $connection->query($complainSql) && $connection->query($orderSql)) {
				echo '<h2 class="container alert alert-success" role="alert">Database is created successfully. Wait for redirecting</h2>
				<p class="container text-center alert alert-info" role="alert">Use default username "admin" and password "password"</p>';
				header( "refresh:5; url=http://localhost/inventory/login.php" );
			}else{
				die('<h2 class="container alert alert-danger" role="alert">All the tables in database is not created successfully!!</h2>');
			}
		}
	}
}
 ?>
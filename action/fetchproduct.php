
<?php 
	$connection= new mysqli("localhost","root","","inventory");
	if ($_POST) {
		$search=$_POST['search'];
		$sql="SELECT * FROM product WHERE product_name LIKE '%$search%'";
		$result=$connection->query($sql);
		$count=$result->num_rows;
		if ($count>0) {
			while ($row=$result->fetch_assoc()) {
				echo '<<table>
					<thead>
						<tr>
							<th>header</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>data</td>
						</tr>
					</tbody>
				</table>';
			}
		}else{
			echo "No product found";
		}
	}
 ?>
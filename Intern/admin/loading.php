 <?php
	session_start();
	include 'Mysql_connect.php';
	$sql = "SELECT * FROM inventory ";
	$result = $conn->query($sql);
	$str='"select Spare Part",';
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$str=$str.'"'.$row['inventory_id'].' | '.$row['Name'].' | '.$row['Current price'].'",';
		}
	}
	$str=substr($str, 0, -1);
	$_SESSION['inventoryALL']=$str;
	header("Location: addJob.php");	
 ?>
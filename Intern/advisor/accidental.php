 <?php
	session_start();
	include 'Mysql_connect.php';
	$sql = "SELECT * FROM job ";
	$result = $conn->query($sql);
	$str='"select JOB",';
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$str=$str.'"'.$row['job_id'].' | '.$row['job_name'].' | '.$row['total_price'].'",';
		}
	}
	$str=substr($str, 0, -1);
	$_SESSION['jobALL']=$str;
	header("Location: accidental2.php");	
 ?>
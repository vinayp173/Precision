<?php
session_start();?>
<?php
if(isset($_POST['cancel'])){
	header("Location: Adminhp.php");
}
?>
<html>
<head>
<title>
Job Details
</title>
<style>
table {
    border:1px solid black;
    width: 100%;
}

th, td {
    text-align: left;
	border:1px solid black;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
tfoot {color:red;}

</style>
</head>
<body>
<form method="POST" action="jobDetails.php">
<Table>
<tr><td colspan="2"><center>Job Details</center></td></tr>
<tr><td>Job id</td><td><input type="number" name="jzid" style="width:80%;"></td></tr>
<tr><td colspan="2"><center><input type="submit" style="width:40%;"name="submit" value="Search"><input type="submit" style="width:40%;" name="cancel" value="Back" ></center></td></tr>
</table>
<?php
	if(isset($_POST['submit'])){
		include 'Mysql_connect.php';
		$sql="SELECT job_name,total_price from job where job_id=".$_POST['jzid'];
		$result1 = $conn->query($sql);		
		echo '<br><br><table> ';
		if($result1->num_rows>0){
			$row= $result1->fetch_assoc();
			echo '<tr><td colspan="2">Job Name</td><td colspan ="2">'.$row['job_name'].'</td></tr>';
			echo '<tr><td colspan="2">Total Price</td><td colspan ="2">'.$row['total_price'].'</td></tr>';
		}

		
		$s="select inventory.inventory_id,inventory.name,inventory.`Current price`,quantity from inventory where inventory.inventory_id in (select inventory_id from inventory_list where list_id=(SELECT list_id from job where job_id=".$_POST['jzid']."))";
		$result1 = $conn->query($s);
		$num1=$result1->num_rows;
		
		echo '<tr><td colspan="4"><center>Spare Part List</center></td></tr>';
		echo '<tr><td>ID</td><td>Name</td><td>Price</td><td>Quantity</td></tr> ';
		if ( $num1> 0) {
			while($row= $result1->fetch_assoc()){
				echo '<tr><td>'.$row['inventory_id'].'</td><td>'.$row['name'].'</td><td>'.$row['Current price'].'</td><td>'.$row['quantity'].'</td></tr>';
			}
		}
		echo '</table>';
	}
?>
</form>
</body>
</html>
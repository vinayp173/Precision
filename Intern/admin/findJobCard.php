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
<form method="POST" action="findJobCard.php">
<Table>
<tr><td colspan="3"><input type="submit" style="width:20%;" name="cancel" value="Back" ><center>JOB CARD SEARCH</center></td></tr>
<tr><td>customer ID</td><td><input type="number" name="custid"style="width:80%;"></td><td><input type="submit" value="find" style="width:80%;"name="scustid"></td></tr>
<tr><td>customer mobile number</td><td><input type="number" name="mob"style="width:80%;"></td><td><input type="submit"value="find"style="width:80%;" name="smob"></td></tr>
<tr><td>Chassis number</td><td><input type="text" name="chassis"style="width:80%;"></td><td><input type="submit"value="find"style="width:80%;" name="schassis"></td></tr>
<tr><td>license number </td><td><input type="text" name="license"style="width:80%;"></td><td><input type="submit"value="find"style="width:80%;" name="slicense"></td></tr>
<tr><td>start Date</td><td><input type="date" name="start"style="width:80%;"></td><td><input type="submit"value="find"style="width:80%;" name="ssdate"></td></tr>
<tr><td>end Date</td><td><input type="date" name="end"style="width:80%;"></td><td><input type="submit"value="find"style="width:80%;" name="sedate"></td></tr>
</table>

<?php
	if(isset($_POST['scustid'])){
		include 'Mysql_connect.php';
		$sql="SELECT card_id,customer_id,chassis_no,start_date,delivery_date,license_no from job_card where customer_id=".$_POST['custid'];
		$result = $conn->query($sql);		
		echo '<br><br><table> ';
		echo '<tr><td>card Id</td><td>customer id</td><td>chassis no</td><td>start date</td><td>delivery date</td><td>license no</td></tr>';
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				echo '<tr><td>'.$row['card_id'].'</td><td>'.$row['customer_id'].'</td><td>'.$row['chassis_no'].'</td><td>'.$row['start_date'].'</td><td>'.$row['delivery_date'].'</td><td>'.$row['license_no'].'</td></tr>';
			}
		}
	}
	if(isset($_POST['smob'])){
		include 'Mysql_connect.php';
		$sql="SELECT card_id,customer_id,chassis_no,start_date,delivery_date,license_no from job_card where customer_id in (select id from customer where number=".$_POST['mob'].")";
		$result = $conn->query($sql);		
		echo '<br><br><table> ';
		echo '<tr><td>card Id</td><td>customer id</td><td>chassis no</td><td>start date</td><td>delivery date</td><td>license no</td></tr>';
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				echo '<tr><td>'.$row['card_id'].'</td><td>'.$row['customer_id'].'</td><td>'.$row['chassis_no'].'</td><td>'.$row['start_date'].'</td><td>'.$row['delivery_date'].'</td><td>'.$row['license_no'].'</td></tr>';
			}
		}
	}
	if(isset($_POST['schassis'])){
		include 'Mysql_connect.php';
		$sql="SELECT card_id,customer_id,chassis_no,start_date,delivery_date,license_no from job_card where chassis_no=".$_POST['chassis'];
		$result = $conn->query($sql);		
		echo '<br><br><table> ';
		echo '<tr><td>card Id</td><td>customer id</td><td>chassis no</td><td>start date</td><td>delivery date</td><td>license no</td></tr>';
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				echo '<tr><td>'.$row['card_id'].'</td><td>'.$row['customer_id'].'</td><td>'.$row['chassis_no'].'</td><td>'.$row['start_date'].'</td><td>'.$row['delivery_date'].'</td><td>'.$row['license_no'].'</td></tr>';
			}
		}
	}
	if(isset($_POST['slicense'])){
		include 'Mysql_connect.php';
		$sql="SELECT card_id,customer_id,chassis_no,start_date,delivery_date,license_no from job_card where license_no=".$_POST['license'];
		$result = $conn->query($sql);		
		echo '<br><br><table> ';
		echo '<tr><td>card Id</td><td>customer id</td><td>chassis no</td><td>start date</td><td>delivery date</td><td>license no</td></tr>';
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				echo '<tr><td>'.$row['card_id'].'</td><td>'.$row['customer_id'].'</td><td>'.$row['chassis_no'].'</td><td>'.$row['start_date'].'</td><td>'.$row['delivery_date'].'</td><td>'.$row['license_no'].'</td></tr>';
			}
		}
	}
	if(isset($_POST['ssdate'])){
		$del=date("Y-m-d",strtotime($_POST['start']));
		include 'Mysql_connect.php';
		$sql="SELECT card_id,customer_id,chassis_no,start_date,delivery_date,license_no from job_card where start_date='".$del."'";

		$result = $conn->query($sql);		
		echo '<br><br><table> ';
		echo '<tr><td>card Id</td><td>customer id</td><td>chassis no</td><td>start date</td><td>delivery date</td><td>license no</td></tr>';
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				echo '<tr><td>'.$row['card_id'].'</td><td>'.$row['customer_id'].'</td><td>'.$row['chassis_no'].'</td><td>'.$row['start_date'].'</td><td>'.$row['delivery_date'].'</td><td>'.$row['license_no'].'</td></tr>';
			}
		}
	}
	if(isset($_POST['sedate'])){
		$del=date("Y-m-d",strtotime($_POST['end']));
		include 'Mysql_connect.php';
		$sql="SELECT card_id,customer_id,chassis_no,start_date,delivery_date,license_no from job_card where delivery_date='".$del."'";
		
		$result = $conn->query($sql);		
		echo '<br><br><table> ';
		echo '<tr><td>card Id</td><td>customer id</td><td>chassis no</td><td>start date</td><td>delivery date</td><td>license no</td></tr>';
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				echo '<tr><td>'.$row['card_id'].'</td><td>'.$row['customer_id'].'</td><td>'.$row['chassis_no'].'</td><td>'.$row['start_date'].'</td><td>'.$row['delivery_date'].'</td><td>'.$row['license_no'].'</td></tr>';
			}
		}
	}
?>
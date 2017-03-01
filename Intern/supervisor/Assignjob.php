<?php
session_start();
?>
<html>
<style>
input{
	width:10%;
}
table,tr,td,th{
	border:1px solid black;
	border-collapse: collapse;
}

</style>
<body>
<form action='jobpro.php' method='post'>
<table style='width:50%;'>
<tr>
<th>Job card</th><th>Job Status</th><th>Select</th>
</tr>

<?php
include 'Mysql_connect.php';
		$i=0;
		$Tno=0;
		$sql='select card_id,chassis_no from job_card where stage2="'.$_SESSION['id'].'"';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
		$card_id=$row['card_id'];
		$chassis_no=$row['chassis_no'];
		$sql='SELECT count(Status) FROM `job_card_details` where card_id="'.$card_id.'"';
		$result1 = $conn->query($sql);
		$row1 = $result1->fetch_assoc();
		$Tno=$row1['count(Status)'];
		$sql='select Status from job_card_details where card_id="'.$card_id.'"';
		$result2 = $conn->query($sql);
		if ($result2->num_rows > 0) {
			while($row2 = $result2->fetch_assoc()){
					if($row2['Status']==true){
							$Tno--;
					}else{
							
					}
				}
		}
		if($Tno==0){
			$Aj='All jobs are Completed';
			echo'<tr><td><h2>Job Card:'.$card_id.'</h2></td><td><br>'.$Aj.'</td></td>';
		}else{
			$Rj='Jobs Remaining:'.$Tno;
			echo'<tr><td><h2>Job Card:'.$card_id.'</h2></td><td><br>'.$Rj.'</td></td>';
		}
		//	echo'Total jobs Remaining'.$Tno;
		//echo $card_id.'  '.$chassis_no.'<br>';
		echo '<td ><input type="submit" name="bt[]" value="'.$card_id.'" style="width:30em;height:5.3em;"></td></tr><br>';
			}
		}

?>
<br><br>
	
	</table><br><br>
	
</form>
<button style='width:10%;height:5%;margin-left:90px;'><a href='Supervisorhp.php' style='text-decoration: none; color:black;'>Back</a></Button>	


</body>
</html>